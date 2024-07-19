<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Form\ContactUs\CreateContactRequest;

class AppController extends BaseController
{

    public function __construct() {}

    public function index()
    {
        return $this->view('index');
    }

    public function aboutUs()
    {
        return $this->view('about-us');
    }

    public function mission()
    {
        return $this->view('mission');
    }

    public function event()
    {
        return $this->view('event');
    }

    public function eventDetails($slug)
    {
        /*
        $folderPath = asset('assets/web/assets/img/event-details/' . $slug);
        $images = [];


        $images = array_diff(scandir($folderPath), ['..', '.']); // Get all files except '.' and '..'

        $imageUrls = array_map(function ($image) use ($slug) {
            return asset('assets/web/assets/img/event-details/' . $slug . '/' . $image);
        }, $images);
*/
        return $this->view('event_details');
    }

    public function contactUs()
    {
        return $this->view('contact-us');
    }

    public function sendContact(CreateContactRequest $request)
    {
        $data = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'messages' => $request->message,
        );
        try {
            Mail::send('web.mail', $data, function ($message) use ($request) {
                $message->to('hellosmilehk@gmail.com', 'Hello Smile')->subject('Contact Us');
                $message->from($request->email, $request->first_name);
            });

            return response()->json(['type' => 'success', 'message' => 'Form submitted successfully.']);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['type' => 'error', 'message' => 'Failed to send email. Please try again later.']);
        }
    }
}
