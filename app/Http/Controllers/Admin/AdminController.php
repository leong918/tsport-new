<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GeneralException;
use App\Http\Requests\Form\Admin\CreateAdminRequest;
use App\Http\Requests\Form\Admin\UpdateAdminRequest;
use App\Http\Requests\Form\Admin\UpdatePasswordRequest;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $this->adminRepository->createAccount($request->all());
            
            DB::commit();
            return redirect(route('admin.admin.index'))->with('success', "Successfully create admin {$request->name}");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something Went Wrong! ' . $e->getMessage());
        }
    }

    public function edit(int $id)
    {
        $model = $this->adminRepository->find($id);

        return $this->view('admin.update', compact('model'));
    }

    public function update(UpdateAdminRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->adminRepository->updateAccount($request->all(), $id);

            DB::commit();
            return redirect(route('admin.admin.index'))->with('success', "Successfully update admin {$request->name}");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something Went Wrong! ' . $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        DB::beginTransaction();
        try {
            $this->authorizeForUser(Auth::guard('admin')->user(), 'self-deny', $id);
            $this->adminRepository->delete($id);

            DB::commit();
            return $this->response();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response($e->getMessage(), 'ERROR');
        }
    }

    public function toggleStatus(int $id)
    {
        DB::beginTransaction();
        try {
            $this->authorizeForUser(Auth::guard('admin')->user(), 'self-deny', $id);
            $this->adminRepository->toggleStatus($id);

            DB::commit();
            return $this->response();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response($e->getMessage(), 'ERROR');
        }
    }

    public function profile()
    {
        return $this->view('admin.profile');
    }

    public function updateProfile(UpdateAdminRequest $request)
    {
        DB::beginTransaction();
        try {
            $id = auth('admin')->user()->id;
            $this->adminRepository->updateAccount($request->all(), $id);

            DB::commit();
            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something Went Wrong! ' . $e->getMessage());
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!Hash::check($request->password, auth('admin')->user()->password)) {
                throw new \Exception('Wrong Current Password!');
            }

            $id = auth('admin')->user()->id;
            $this->adminRepository->updateAccount($request->all(), $id);

            DB::commit();
            return redirect()->back()->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something Went Wrong! ' . $e->getMessage());
        }
    }
}
