<?php

namespace App\Plugins\SalesOrder\Admin;

use App\Http\Controllers\Controller;
use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderProductRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderTotalRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Plugins\SalesOrder\Export\SalesOrderExport;
use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrackingNumberMail;
use App\Mail\ShippingFeeMail;
use App\Mail\NewOrderMail;
use App\Mail\OrderReceivedMail;
use Carbon\Carbon;
class SalesOrderController extends Controller
{
    private SalesOrderRepository $salesOrderRepository;
    private SalesOrderProductRepository $salesOrderProductRepository;
    private SalesOrderTotalRepository $salesOrderTotalRepository;
    private ProductRepository $productRepository;
    private CountryRepository $countryRepository;
    private SettingRepository $settingRepository;

    public function __construct(
        SalesOrderRepository $salesOrderRepository,
        SalesOrderProductRepository $salesOrderProductRepository,
        SalesOrderTotalRepository $salesOrderTotalRepository,
        ProductRepository $productRepository,
        CountryRepository $countryRepository,
        SettingRepository $settingRepository
    ) {
        $this->salesOrderRepository = $salesOrderRepository;
        $this->salesOrderProductRepository = $salesOrderProductRepository;
        $this->salesOrderTotalRepository = $salesOrderTotalRepository;
        $this->productRepository = $productRepository;
        $this->countryRepository = $countryRepository;
        $this->settingRepository = $settingRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $form_data = $request->form_data;
            $model = $this->salesOrderRepository->getListing($form_data);
            return DataTables::of($model)
                ->editColumn('product', function ($model) {
                    $product_list = '';
                    foreach ($model->salesOrderProduct as $sales_order_product) {
                        $product_list .= $sales_order_product->product_name . ' x ' . $sales_order_product->quantity . '<br>';
                    }
                    return $product_list;
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.sales_order.update.put', ["id" => $model->id]);
                    $status = $model->status;
                    return view("sales_order::admin.sales_order.status", compact('route', 'status'));
                })
                ->addColumn('action', function ($model) {
                    return view("sales_order::admin.sales_order.action", compact('model'));
                })
                ->addColumn('checkbox', function ($model) {
                    return view("sales_order::admin.sales_order.checkbox", compact('model'));
                })
                ->rawColumns(['product', 'checkbox'])
                ->make(true);
        }

        return view("sales_order::admin.sales_order.index");
    }

    public function edit(int $id)
    {
        $model = $this->salesOrderRepository->find($id);
        $productListDropdown = $this->productRepository->dropdownForSalesOrder('HKD');
        $countryDropdown = $this->countryRepository->dropdown();
        return view("sales_order::admin.sales_order.update", compact('model', 'productListDropdown', 'countryDropdown'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();
        try {

            $admin = auth()->guard('admin')->user();
            $level_change = $this->salesOrderRepository->updateSalesOrder($request->all(), $id, $admin);
            DB::commit();
            return response()->json(['level_change' => $level_change]);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.sales_order.index'))->with('success', "Successfully update sales order {$request->name}");
    }

    public function updateProduct(Request $request, int $id, int $product_id = null)
    {
        DB::beginTransaction();
        try {
            if ($product_id) {
                $admin_id = auth()->guard('admin')->user()->id;
                $this->salesOrderProductRepository->updateSalesOrderProduct($request->all(), $id, $product_id, $admin_id);
            } else {
                $this->salesOrderProductRepository->createSalesOrderProduct($request->all(), $id);
            }
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.sales_order.index'))->with('success', "Successfully update sales order {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->salesOrderRepository->delete($id);
        $this->salesOrderProductRepository->deleteProductBySalesOrderId($id);
    }

    public function destroySalesOrderProduct(int $id, int $product_id)
    {
        $sales_order_product = $this->salesOrderProductRepository->find($product_id);
        $this->salesOrderTotalRepository->updateSubtotalAndTotal($id, $sales_order_product->total_price, "minus");
        $sales_order_product->delete();
    }

    public function toggleStatus(int $id)
    {
        $this->salesOrderRepository->toggleStatus($id);
    }

    public function destroyByList(Request $request)
    {
        $data = $request->all();
        foreach ($data['selectedList'] as $selectedID) {
            $this->salesOrderRepository->delete($selectedID);
            $this->salesOrderProductRepository->deleteProductBySalesOrderId($selectedID);
        }
    }

    public function exportByList(Request $request)
    {
        $sales_order_list = null;
        $form_data = $request->all();
        if (isset($form_data['selectedList']) && $form_data['selectedList'] != null) {
            $data = explode(",", $form_data['selectedList']);
            $sales_order_list = $this->salesOrderRepository->getListingByID($data);
        } else {
            $form_data['sales_order.sales_order_id'] = $form_data['sales_order_sales_order_id'];
            $form_data['sales_order.status'] = $form_data['sales_order_status'];
            unset($form_data['sales_order_sales_order_id'], $form_data['sales_order_status']);
            $sales_order_list = $this->salesOrderRepository->getExportListing($form_data);
        }

        $senderInfoList = $this->settingRepository->getSenderInfo();
        $senderData = array();

        foreach ($senderInfoList as $senderInfo) {
            $senderData[$senderInfo->key] = $senderInfo->value;
        }

        $filename = "Sales Order Export.xlsx";

        return Excel::download(new SalesOrderExport($sales_order_list, $senderData), $filename);
    }

    public function sendMail(Request $request, int $id)
    {
        $selectedMail = $request->input('selectedMail');
        $sales_order = $this->salesOrderRepository->find($id);
        $date = Carbon::now();
        $formattedDate = $date->format('F j, Y');
        if($selectedMail == 'tracking_number'){
            $image = $this->settingRepository->getValueByKey('tracking_number_email_image');
            Mail::to($sales_order->user->email)->send(new TrackingNumberMail($sales_order, $image, $formattedDate));
        }elseif($selectedMail == 'shipping_fee'){
            $image = $this->settingRepository->getValueByKey('shipping_fee_email_image');
            Mail::to($sales_order->user->email)->send(new ShippingFeeMail($sales_order, $image, $formattedDate));
        }elseif($selectedMail == 'new_order'){
            $image = $this->settingRepository->getValueByKey('new_order_email_image');
            Mail::to($sales_order->user->email)->send(new NewOrderMail($sales_order, $image, $formattedDate));
        }elseif($selectedMail == 'order_received'){
            $image = $this->settingRepository->getValueByKey('order_received_email_image');
            Mail::to($sales_order->user->email)->send(new OrderReceivedMail($sales_order, $image, $formattedDate));
        }

        return response()->json();
    }
}
