@extends('admin.layout.app')

@section('breadcrumb')
<li class="breadcrumb-item active"><span>Dashboard</span></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in text-dark">
            <h1> <span style="font-weight: bold;">WELCOME</span> {{ auth()->guard('admin')->user()->name  }} </h1>
        </div>
    </div>
@endsection
