<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Form\ContactUs\CreateContactRequest;
use App\Models\Event;
use App\Repositories\BlogRepository;
use App\Mail\ContactMail;

class AppController extends BaseController
{
    private BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

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

    public function ourPartner()
    {
        return $this->view('our-partner');
    }

    public function founder()
    {
        return $this->view('founder');
    }

    public function whatDoWeDo()
    {
        return $this->view('what-do-we-do');
    }

    public function event()
    {
        $events = Event::getAllEvents();

        return $this->view('event', compact('events'));
    }

    public function eventDetails($slug)
    {

        $event = Event::getEventBySlug($slug);

        if (!$event) {
            abort(404);
        }

        $files = File::files(public_path('assets/web/assets/img/event-details/' . $slug));
        $images = [];


        foreach ($files as $file) {
            $images[] = asset('assets/web/assets/img/event-details/' . $slug . '/' . $file->getRelativePathname());
        }

        return $this->view('event_details', compact('event', 'images'));
    }

    public function contactUs()
    {
        return $this->view('contact-us');
    }

    public function sendContact(CreateContactRequest $request)
    {
        try {
            Mail::to('hellosmilehk@gmail.com')->send(new ContactMail($request->first_name, $request->last_name, $request->email, $request->message));

            return response()->json(['type' => 'success', 'message' => 'Form submitted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'Failed to send email. Please try again later.']);
        }
    }

    public function programme()
    {
        return $this->view('programme.programme-1');
    }

    public function blog()
    {
        $knowledges = $this->blogRepository->getBlogByCategory(1);
        $interviews = $this->blogRepository->getBlogByCategory(2);
        $first_interview = $this->blogRepository->getFirstBlogByCategory(2);
        return $this->view('blog.blog', compact('knowledges', 'interviews', 'first_interview'));
    }

    public function blogDetails(Request $request, $id)
    {
        $blog = $this->blogRepository->getActiveBlog($id);

        return $this->view('blog.blog-details', compact('blog'));
    }
}
