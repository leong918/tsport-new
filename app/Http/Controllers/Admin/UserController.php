<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\user\CreateUserRequest;
use App\Http\Requests\Form\user\UpdateUserRequest;
use App\Repositories\LevelRepository;
use App\Repositories\userRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    private UserRepository $userRepository;
    private LevelRepository $levelRepository;

    public function __construct(UserRepository $userRepository, LevelRepository $levelRepository)
    {
        $this->userRepository = $userRepository;
        $this->levelRepository = $levelRepository;
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
        $data = $request->all();
        $data['level_id'] =  $this->levelRepository->getLowestLeveling()->id;

        if($data['referral_email'] && $data['referral_phone_no'])
        {
            $user = $this->userRepository->getUserByEmail($data['referral_email'],$data['referral_phone_no']);
            if(!$user || $user->level_id <= 1)
            {
                return redirect()->back()->with('error', "Referral User Not Found or Refferal User Level Not Compatible!");
            }
        }

        $this->userRepository->createUser($data);
        return redirect(route('admin.user.index'))->with('success', "Successfully create user {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->userRepository->find($id);
        return $this->view('user.update', compact('model'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->all();
        if($data['referral_email'] && $data['referral_phone_no'])
        {
            $user = $this->userRepository->getUserByEmail($data['referral_email'],$data['referral_phone_no']);
            if(!$user || $user->level_id <= 1)
            {
                return redirect()->back()->with('error', "Referral User Not Found or Refferal User Level Not Compatible!");
            }
        }

        $this->userRepository->updateUser($data, $id);
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
