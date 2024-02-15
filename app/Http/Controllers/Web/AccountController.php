<?php

namespace App\Http\Controllers\Web;

class AccountController extends BaseController
{
    public function accountDetails()
    {
        return $this->view('account.account_details');
    }
    public function accountAddress()
    {
        return $this->view('account.account_address');
    }
    public function accountOrder()
    {
        return $this->view('account.account_order');
    }
    public function accountOrderDetail()
    {
        return $this->view('account.account_order_detail');
    }
}
