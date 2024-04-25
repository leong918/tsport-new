<?php

namespace App\Http\Controllers\Admin;

use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    private SalesOrderRepository $salesOrderRepository;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;

    public function __construct(SalesOrderRepository $salesOrderRepository, UserRepository $userRepository, ProductRepository $productRepository)
    {
        $this->salesOrderRepository = $salesOrderRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $current_date = Carbon::now();
        $productDropdown = $this->productRepository->dropdown();
        $summary_data_current = $this->salesOrderRepository->getOverviewData($current_date, false);
        $summary_data_prev = $this->salesOrderRepository->getOverviewData($current_date, true);
        $order_data['monthly'] = $this->salesOrderRepository->getMonthlyOrder($current_date);
        $order_data['yearly'] = $this->salesOrderRepository->getYearlyOrder($current_date);
        $date_array = $this->getDateArray();
        $order_status = $this->salesOrderRepository->getOrderStatus();

        if($request->ajax()){

            $request->table_type == 'new_orders' ? $model = $this->salesOrderRepository->getNewOrders() : $model = $this->userRepository->getNewUsers();

            return DataTables::of($model)
                ->editColumn('status', function($model) use ($request, $order_status){

                    if($request->table_type == 'new_orders'){
                        $status = array_key_exists($model->status, $order_status) ? ucfirst(strtolower($order_status[$model->status])) : null;

                        return $status;
                    } else {
                        $status = $model->email_verified_at;

                        $status == null ? $status = 'Verified' : $status = 'Unverified';

                        return $status;
                    }
                })
                ->make(true);
            
        }

        return $this->view('dashboard.index', compact('summary_data_current', 'summary_data_prev', 'order_data', 'date_array'));
    }

    public function getDateArray()
    {
        $last_30_days_date = Carbon::now()->subDay(29);
        $last_12_months_date = Carbon::now()->subMonth(11);
        $date_arr['date_array'] = [];
        $date_arr['year_month_array'] = [];

        for ($i = 0; $i < 30; $i++) { 
            array_push($date_arr['date_array'], $last_30_days_date->format('m-d'));
            $last_30_days_date->addDay();
        }

        for ($i = 0; $i < 12; $i++) { 
            array_push($date_arr['year_month_array'], $last_12_months_date->format('m-d-Y'));
            $last_12_months_date->addMonth();
        }

        return $date_arr;
    }

}
