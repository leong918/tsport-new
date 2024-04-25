<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\EmailContent\UpdateEmailContentRequest;
use App\Http\Requests\Form\EmailContent\CreateEmailContentRequest;
use App\Repositories\EmailContentRepository;
use App\Repositories\ProcessedJobRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessSendSubscriberMail; 
class EmailContentController extends BaseController
{
    private EmailContentRepository $emailContentRepository;
    private ProcessedJobRepository $processedJobRepository;

    public function __construct(EmailContentRepository $emailContentRepository, ProcessedJobRepository $processedJobRepository)
    {
        $this->emailContentRepository = $emailContentRepository; 
        $this->processedJobRepository = $processedJobRepository; 
    }

    public function index(Request $request)
    {
        $subscriberMailRunning = $this->processedJobRepository->getLatestJobByName('ProcessSendSubscriberMail');
        $lastSubscriberMailRan = $this->processedJobRepository->getLastRunningJobByName('ProcessSendSubscriberMail');
        if ($request->ajax()) {
            $model = $this->emailContentRepository->getListing();
            return DataTables::of($model)
                ->editColumn('last_sent_on', function ($model) use ($lastSubscriberMailRan) {
                    return isset($lastSubscriberMailRan) && $lastSubscriberMailRan->end_at ? $lastSubscriberMailRan->end_at : 'None';
                })
                ->addColumn('action', function ($model) use ($subscriberMailRunning){
                    return $this->view('email_content.action', compact('model','subscriberMailRunning'));
                })
                ->make(true);
        }

        return $this->view('email_content.index');
    }

    public function create()
    {
        return $this->view('email_content.create');
    }

    public function store(CreateEmailContentRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->emailContentRepository->create($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.tag.index'))->with('success', "Successfully create email {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->emailContentRepository->find($id);

        return $this->view('email_content.update', compact('model'));
    }

    public function update(UpdateEmailContentRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->emailContentRepository->update($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.email_content.index'))->with('success', "Successfully update email {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->emailContentRepository->delete($id);
        return $this->response();
    }

    public function sendMail(int $id)
    {
        //process job data
        $data['name'] = "ProcessSendSubscriberMail";

        //create process job record
        $processedJob = $this->processedJobRepository->create($data);
        ProcessSendSubscriberMail::dispatch($id, $processedJob->id);
    }
}