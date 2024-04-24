<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\FaqRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Form\Faq\CreateFaqRequest;
use App\Http\Requests\Form\Faq\UpdateFaqRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class FaqController extends BaseController
{
    private FaqRepository $faqRepository;
    private SettingRepository $settingRepository;

    public function __construct(FaqRepository $faqRepository, SettingRepository $settingRepository)
    {
        $this->faqRepository = $faqRepository;
        $this->settingRepository = $settingRepository;
    }

    public function index(Request $request)
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        if ($request->ajax()) {
            $model = $this->faqRepository->getListing();

            return DataTables::of($model)
                ->rawColumns(['question'])
                ->addColumn('status', function ($model) {
                    $route = route('admin.faq.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('faq.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('faq.index', compact('setting_model'));
    }

    public function create()
    {
        return $this->view('faq.create');
    }

    public function store(CreateFaqRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->faqRepository->createFaq($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.faq.index'))->with('success', "Successfully create point to cash programme");
    }

    public function edit(int $id)
    {
        $model = $this->faqRepository->find($id);

        return $this->view('faq.update', compact('model'));
    }

    public function update(UpdateFaqRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->faqRepository->updateFaq($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }

        return redirect(route('admin.faq.index'))->with('success', "Successfully update point to cash programme");
    }

    public function destroy(int $id)
    {
        $this->faqRepository->delete($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->faqRepository->toggleStatus($id);
    }
}
