<?php

namespace App\Plugins\SalesOrder\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Stripe\Event;
use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;

class StripeController extends Controller
{
    private SalesOrderRepository $salesOrderRepository;

    public function __construct(
        SalesOrderRepository $salesOrderRepository
    ) {
        $this->salesOrderRepository = $salesOrderRepository;
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();

        try {
            $event = Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                try {
                    $sales_order = $this->paymentSucceed($event->data->object);

                    if ($sales_order) {
                        $request->session()->flush('cart-' . $sales_order->user_id);
                        $request->session()->flush('coupon-' . $sales_order->user_id);
                        $request->session()->flush('point-' . $sales_order->user_id);
                    }
                } catch (\Exception $e) {
                    return $this->response(['status' => 'fail', 'msg' => $e->getMessage()], 'ERROR');
                }

                break;
            case 'payment_intent.payment_failed':
                try {
                    $this->paymentFailed($event->data->object);
                } catch (\Exception $e) {
                    return $this->response(['status' => 'fail', 'msg' => $e->getMessage()], 'ERROR');
                }

                break;
            case 'payment_intent.canceled':
                try {
                    $this->paymentCanceled($event->data->object);
                } catch (\Exception $e) {
                    return $this->response(['status' => 'fail', 'msg' => $e->getMessage()], 'ERROR');
                }

                break;
            default:
                return $this->response(['status' => 'fail', 'msg' => 'Received unknown event type ' . $event->type], 'ERROR');
        }

        return $this->response(['status' => 'success']);
    }

    public function paymentSucceed($object)
    {
        return $this->salesOrderRepository->updateStripeSalesOrder($object->client_secret, 1);
    }

    public function paymentFailed($object)
    {
        $this->salesOrderRepository->updateStripeSalesOrder($object->client_secret, -1);
    }

    public function paymentCanceled($object)
    {
        $this->salesOrderRepository->updateStripeSalesOrder($object->client_secret, -2);
    }
}
