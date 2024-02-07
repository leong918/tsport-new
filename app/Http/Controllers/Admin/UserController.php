<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\user\CreateUserRequest;
use App\Http\Requests\Form\user\UpdateUserRequest;
use App\Repositories\userRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->userRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.user.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('user.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('user.index');
    }

    public function create()
    {
        return $this->view('user.create');
    }

    public function store(CreateUserRequest $request)
    {
        $this->userRepository->createUser($request->all());
        return redirect(route('admin.user.index'))->with('success', "Successfully create user {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->userRepository->find($id);
        return $this->view('user.update', compact('model'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $this->userRepository->updateUser($request->all(), $id);
        return redirect(route('admin.user.index'))->with('success', "Successfully update user {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->userRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->userRepository->toggleStatus($id);
    }

    public function getuserComment(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->userRepository->getListing();
            return DataTables::of($model)
                ->make(true);
        }
    }
}
