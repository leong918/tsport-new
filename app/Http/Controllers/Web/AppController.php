<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class AppController extends BaseController
{
    public function index()
    {
        return $this->view('index');
    }

    public function sendContact(Request $request)
    {
        try {
            Mail::to('sample@gmail.com')->send(new ContactMail($request->first_name, $request->last_name, $request->email, $request->message));

            return response()->json(['type' => 'success', 'message' => 'Form submitted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'Failed to send email. Please try again later.']);
        }
    }
}
