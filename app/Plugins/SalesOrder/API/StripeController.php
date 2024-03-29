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
        SalesOrderRepository $salesOrderRepository,
    ) {
        $this->salesOrderRepository = $salesOrderRepository;
    }

    public function webhook(Request $request) {
        $payload = $request->getContent();

        try {
            $event = Event::constructFrom(
                json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                try {
                    $this->paymentSucceed($event->data->object);
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
            default:
                return $this->response(['status' => 'fail', 'msg' => 'Received unknown event type ' . $event->type], 'ERROR');
        }

        return $this->response(['status' => 'success']);
    }

    public function paymentSucceed($object) 
    {
        $this->salesOrderRepository->updateStripeSalesOrder($object->client_secret, 1);
    }

    public function paymentFailed($event)
    {
        $this->salesOrderRepository->updateStripeSalesOrder($event->data->client_secret, -1);
    }
}
?>

