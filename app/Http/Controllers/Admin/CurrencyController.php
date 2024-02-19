<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Currency\CreateCurrencyRequest;
use App\Http\Requests\Form\Currency\UpdateCurrencyRequest;
use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CurrencyController extends BaseController
{
    private CurrencyRepository $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->currencyRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.currency.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('currency.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('currency.index');
    }

    public function create()
    {
        return $this->view('currency.create');
    }

    public function store(CreateCurrencyRequest $request)
    {
        $this->currencyRepository->createCurrency($request->all());
        return redirect(route('admin.currency.index'))->with('success', "Successfully create currency {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->currencyRepository->find($id);

        return $this->view('currency.update', compact('model'));
    }

    public function update(UpdateCurrencyRequest $request, int $id)
    {
        $this->currencyRepository->updateCurrency($request->all(), $id);
        return redirect(route('admin.currency.index'))->with('success', "Successfully update currency {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->currencyRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->currencyRepository->toggleStatus($id);
    }
}
