@extends('admin.layout.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users</a></li>
    <li class="breadcrumb-item active"><span>User Details</span></li>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>User Details: {{ $user->name }}</strong>
                                <div class="float-end">
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary me-2">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="200">Name</th>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Username</th>
                                                <td>{{ $user->username }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $user->email ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $user->phone_no ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth</th>
                                                <td>{{ $user->dob ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    @if($user->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="200">Jersey Name</th>
                                                <td>{{ $user->jersey_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jersey Number</th>
                                                <td>{{ $user->jersey_number ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jersey Main Color</th>
                                                <td>{{ $user->jersey_main_color ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jersey Sec Color</th>
                                                <td>{{ $user->jersey_sec_color ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Referral Code</th>
                                                <td>{{ $user->referral_code ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created At</th>
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
