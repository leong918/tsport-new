<?php

namespace App\Plugins\SalesOrder\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderProductRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AnalyticController extends Controller
{
    private SalesOrderRepository $salesOrderRepository;
    private SalesOrderProductRepository $salesOrderProductRepository;
    private ProductRepository $productRepository;

    public function __construct(SalesOrderRepository $salesOrderRepository, SalesOrderProductRepository $salesOrderProductRepository, ProductRepository $productRepository) {
        $this->salesOrderRepository = $salesOrderRepository;
        $this->salesOrderProductRepository = $salesOrderProductRepository;
        $this->productRepository = $productRepository;
    }

    public function product(Request $request)
    {
        $end_date = Carbon::now();
        $start_date = Carbon::now()->startOfMonth();
        $productDropdown = $this->productRepository->dropdown();

        if ($request->ajax()) {
            $form_data = $request->form_data;
            $model = $this->salesOrderProductRepository->getListing($form_data);

            return DataTables::of($model)
                ->editColumn('net_sales', function ($model) {
                    return '$' . $model->net_sales;
                })
                ->make(true);
        }

        return view('sales_order::admin.analytic.product', compact('start_date', 'end_date', 'productDropdown'));
    }

    public function getProductDataByDateRange(Request $request)
    {
        $form_data = $request->form_data;
        $product_data_current = $this->salesOrderProductRepository->getSalesOrderProductByMonth($form_data, false);
        $product_data_previous = $this->salesOrderProductRepository->getSalesOrderProductByMonth($form_data, true);
        
        return response()->json(['product_data_current' => $product_data_current, 'product_data_previous' => $product_data_previous]);
    }

    public function order(Request $request)
    {
        $end_date = Carbon::now();
        $start_date = Carbon::now()->startOfMonth();
        $productDropdown = $this->productRepository->dropdown();

        if ($request->ajax()) {
            $form_data = $request->form_data;
            $model = $this->salesOrderRepository->getOrderListing($form_data);
            $order_status = $this->salesOrderRepository->getOrderStatus();

            return DataTables::of($model)
                ->rawColumns(['product_sku'])
                ->editColumn('status', function($model) use ($order_status){
                    $status = array_key_exists($model->status, $order_status) ? ucfirst(strtolower($order_status[$model->status])) : null;

                    return $status;
                })
                ->editColumn('product_sku', function ($model) {
                    $product_list = '';
                    foreach ($model->salesOrderProduct as $sales_order_product) {
                        $product_list .= $sales_order_product->product->sku . ' x ' . $sales_order_product->quantity . '<br>';
                    }
                    return $product_list;
                })
                ->editColumn('net_sales', function ($model) {
                    return '$' . $model->net_sales;
                })
                ->make(true);
        }

        return view('sales_order::admin.analytic.order', compact('start_date', 'end_date', 'productDropdown'));
    }

    public function getOrderDataByDateRange(Request $request)
    {
        $form_data = $request->form_data;
        $order_data_current = $this->salesOrderRepository->getSalesOrderByMonth($form_data, false);
        $order_data_previous = $this->salesOrderRepository->getSalesOrderByMonth($form_data, true);

        return response()->json(['order_data_current' => $order_data_current, 'order_data_previous' => $order_data_previous]);
    }

    public function category(Request $request)
    {
        $end_date = Carbon::now();
        $start_date = Carbon::now()->startOfMonth();
        $productDropdown = $this->productRepository->dropdown();

        if ($request->ajax()) {
            $form_data = $request->form_data;
            $model = $this->salesOrderProductRepository->getCategoryListing($form_data);

            return DataTables::of($model)
                ->editColumn('net_sales', function ($model) {
                    return '$' . $model->net_sales;
                })
                ->make(true);
        }

        return view('sales_order::admin.analytic.category', compact('start_date', 'end_date', 'productDropdown'));
    }

    public function getCategoryDataByDateRange(Request $request)
    {
        $form_data = $request->form_data;
        $category_data_current = $this->salesOrderProductRepository->getSalesOrderCategoryByMonth($form_data, false);
        $category_data_previous = $this->salesOrderProductRepository->getSalesOrderCategoryByMonth($form_data, true);
        
        return response()->json(['category_data_current' => $category_data_current, 'category_data_previous' => $category_data_previous]);
    }
}
