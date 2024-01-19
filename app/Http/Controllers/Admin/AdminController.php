<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GeneralException;
use App\Http\Requests\Form\Admin\CreateAdminRequest;
use App\Http\Requests\Form\Admin\UpdateAdminRequest;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends BaseController
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->adminRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.admin.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return $this->view('admin.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('admin.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('admin.index');
    }

    public function create()
    {
        return $this->view('admin.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $this->adminRepository->createAccount($request->all());
        return redirect(route('admin.admin.index'))->with('success', "Successfully create admin {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->adminRepository->find($id);

        return $this->view('admin.update', compact('model'));
    }

    public function update(UpdateAdminRequest $request, int $id)
    {
        $this->adminRepository->updateAccount($request->all(), $id);
        return redirect(route('admin.admin.index'))->with('success', "Successfully update admin {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->authorizeForUser(Auth::guard('admin')->user(), 'self-deny', $id);
        $this->adminRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->authorizeForUser(Auth::guard('admin')->user(), 'self-deny', $id);
        $this->adminRepository->toggleStatus($id);
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->password !== $request->password_confirmation) {
                throw new GeneralException('Password not match');
            }

            // update password
            $id = Auth::guard('admin')->user()->id;
            $input = $request->only(['password']);
            $this->adminRepository->update($input, $id);

            return redirect()->back()->with('success', 'Successfully logged out');
        }

        return $this->view('admin.profile');
    }
}
