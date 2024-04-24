<?php

namespace App\Http\Controllers\Web;

use App\Repositories\UserRepository;
use App\Repositories\CountryRepository;
use App\Repositories\PointLogRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;
use App\Http\Requests\Form\User\UserUpdateInfoRequest;
use App\Http\Requests\Form\User\UserUpdateAddressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends BaseController
{
    private UserRepository $userRepository;
    private CountryRepository $countryRepository;
    private PointLogRepository $pointLogRepository;
    private SalesOrderRepository $salesOrderRepository;

    public function __construct(
        UserRepository $userRepository, 
        CountryRepository $countryRepository, 
        PointLogRepository $pointLogRepository,
        SalesOrderRepository $salesOrderRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->countryRepository = $countryRepository;
        $this->pointLogRepository = $pointLogRepository;
        $this->salesOrderRepository = $salesOrderRepository;
    }

    public function accountDetails()
    {
        $user_id = auth()->user()->id;
        $user = $this->userRepository->find($user_id);

        return $this->view('account.account_details', compact('user'));
    }
    public function accountAddress()
    {
        $user_id = auth()->user()->id;
        $user = $this->userRepository->find($user_id);
        $countryDropdown = $this->countryRepository->dropdown();
        return $this->view('account.account_address', compact('user','countryDropdown'));
    }
    public function accountOrder(Request $request)
    {
        $data = $request->all();
        $user_id = auth()->user()->id;

        $order_record = $this->salesOrderRepository->getSalesOrderByUserId($user_id)->get();
        $sales_order_list = $this->salesOrderRepository->getSalesOrderByUserId($user_id);
        $order_status_list = $this->salesOrderRepository->getOrderStatus();

        $pending_count = $order_record->where('status', 0)->count();
        $processing_count = $order_record->where('status', 2)->count();
        $completed_count = $order_record->where('status', 1)->count();
        $cancelled_count = $order_record->where('status', -2)->count();
        $all_count = $order_record->count();
        
        $currentStatus = array_key_exists('status', $data) ? $data['status'] : null;
        $order_list = array_key_exists('status', $data) ? 
            $sales_order_list->where('status', $data['status'])->paginate(5) 
            : $sales_order_list->paginate(5);

        return $this->view('account.account_order', compact('order_list', 'order_status_list', 'pending_count', 
        'processing_count', 'completed_count', 'cancelled_count', 'all_count', 'currentStatus'));
    }
    public function accountOrderDetail(int $id)
    {
        $sales_order = $this->salesOrderRepository->find($id);
        $order_status = $this->salesOrderRepository->getOrderStatus();

        return $this->view('account.account_order_detail', compact('sales_order', 'order_status'));
    }
    public function accountPoints()
    {
        $user_id = auth()->user()->id;
        $user = $this->userRepository->find($user_id);
        $point_list = $this->pointLogRepository->getListing()->where('user_id', $user->id)->paginate(5);

        return $this->view('account.account_point', compact('user', 'point_list'));
    }
    public function doUpdateUserAccount(UserUpdateInfoRequest $request, int $user_id)
    {
        $data = $request->all();
        $user = $this->userRepository->find($user_id);
        if ($data['current_password']) {
            if (!Hash::check($data['current_password'], $user->password)) {
                throw new \Exception('Password Incorrect!');
            }
            if (Hash::check($data['password'], $user->password)) {
                throw new \Exception('New Password Cannot Same With Current Password!');
            }
        }
        $this->userRepository->updateUser($data, $user->id);
    }
    public function doUpdateUserAddress(UserUpdateAddressRequest $request, int $user_id)
    {
        $data = $request->all();
        $country = $this->countryRepository->find($data['country_id']);
        $data['country'] = $country->name;
        $this->userRepository->updateUser($data, $user_id);
    }
}
