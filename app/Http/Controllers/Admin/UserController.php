<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->orderBy('created_at', 'desc');
            
            return DataTables::of($users)
                ->addColumn('status', function ($user) {
                    $route = route('admin.user.toggle-status', ['id' => $user->id]);
                    $status = $user->status;
                    return $this->view('user.status', compact('route', 'status', 'user'));
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at;
                })
                ->addColumn('action', function ($user) {
                    return $this->view('user.action', compact('user'));
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return $this->view('user.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $this->view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_no' => 'nullable|string|max:20',
            'status' => 'required|in:0,1',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->update($request->only(['name', 'email', 'phone_no', 'status']));

            DB::commit();
            return redirect()->route('admin.user.index')
                ->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something Went Wrong! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();
            return response()->json(['success' => 'User deleted successfully!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->status = $user->status == 1 ? 0 : 1;
            $user->save();

            DB::commit();
            return response()->json(['success' => 'User status updated successfully!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
