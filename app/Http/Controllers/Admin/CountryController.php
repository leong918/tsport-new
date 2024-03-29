<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GeneralException;
use App\Http\Requests\Form\Country\CreateCountryRequest;
use App\Http\Requests\Form\Country\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends BaseController
{
    private CountryRepository $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->countryRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.country.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return $this->view('country.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('country.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('country.index');
    }

    public function create()
    {
        return $this->view('country.create');
    }

    public function store(CreateCountryRequest $request)
    {
        $this->countryRepository->createCountry($request->all());
        return redirect(route('admin.country.index'))->with('success', "Successfully create country {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->countryRepository->find($id);

        return $this->view('country.update', compact('model'));
    }

    public function update(UpdateCountryRequest $request, int $id)
    {
        $this->countryRepository->updateCountry($request->all(), $id);
        return redirect(route('admin.country.index'))->with('success', "Successfully update country {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->countryRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->countryRepository->toggleStatus($id);
    }
}
