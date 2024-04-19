<?php

namespace App\Plugins\SalesOrder\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\BrandRepository;
use App\Plugins\SalesOrder\Repositories\CartRuleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartRuleController extends Controller
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    private BrandRepository $brandRepository;
    private CartRuleRepository $cartRuleRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        BrandRepository $brandRepository,
        CartRuleRepository $cartRuleRepository,
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->cartRuleRepository = $cartRuleRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->cartRuleRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.cart_rule.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return view('sales_order::admin.cart_rule.action', compact('model'));
                })
                ->make(true);
        }

        return view('sales_order::admin.cart_rule.index');
    }

    public function create()
    {
        $productDropdown = $this->productRepository->dropdown();
        $categoryDropdown = $this->categoryRepository->dropdown();
        $brandDropdown = $this->brandRepository->dropdown();

        return view('sales_order::admin.cart_rule.create', compact('productDropdown', 'categoryDropdown', 'brandDropdown'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->cartRuleRepository->createCartRule($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.cart_rule.index'))->with('success', "Successfully create cart rule");
    }

    public function edit(int $id)
    {
        $model = $this->cartRuleRepository->find($id);
        $productDropdown = $this->productRepository->dropdown();
        $categoryDropdown = $this->categoryRepository->dropdown();
        $brandDropdown = $this->brandRepository->dropdown();
        $model->start_date = $model->start_date ? Carbon::parse($model->start_date)->format('Y-m-d g:i A') : null;
        $model->end_date = $model->end_date ? Carbon::parse($model->end_date)->format('Y-m-d g:i A') : null;

        return view('sales_order::admin.cart_rule.update', compact('model', 'productDropdown', 'categoryDropdown', 'brandDropdown'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->cartRuleRepository->updateCartRule($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }

        return redirect(route('admin.cart_rule.index'))->with('success', "Successfully create cart rule");
    }

    public function destroy(int $id)
    {
        $this->cartRuleRepository->delete($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->cartRuleRepository->toggleStatus($id);
    }
}
