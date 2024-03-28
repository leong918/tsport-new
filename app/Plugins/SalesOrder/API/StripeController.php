<?php

namespace App\Plugins\SalesOrder\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function webhook(Request $request) {
        return $this->response(['status' => 'success']);
    }

    public function paymentSucceed(Request $request) 
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $object = $request['data']['object'];
        $this->salesPaymentRepository->updateSalesPayment($object['client_secret'], 1, null, null);

        return $this->response(['status' => 'success']);
    }

    public function paymentFailed(Request $request) 
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $object = $request['data']['object'];
        $this->salesPaymentRepository->updateSalesPayment($object['metadata']['order_id'], 0, null, $object['last_payment_error']['message']);

        return $this->response(['status' => 'success']);
    }
}
?>

