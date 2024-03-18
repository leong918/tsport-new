<?php

namespace App\Plugins\SalesOrder\Admin;

use App\Http\Controllers\Controller;
use App\Plugins\ProductReview\Repositories\ProductReviewRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SalesOrderController extends Controller
{
    private ProductReviewRepository $productReviewRepository;

    public function __construct(ProductReviewRepository $productReviewRepository)
    {
        $this->productReviewRepository = $productReviewRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->productReviewRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.product_review.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view("product_review::admin.status", compact('route', 'status'));
                })
                ->addColumn('action', function ($model) {
                    return view("product_review::admin.action", compact('model'));
                })
                ->make(true);
        }

        return view("product_review::admin.index");
    }

    public function destroy(int $id)
    {
        $this->productReviewRepository->delete($id);
    }

    public function toggleStatus(int $id)
    {
        $this->productReviewRepository->toggleStatus($id);
    }
}
