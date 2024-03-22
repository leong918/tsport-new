@php
    $adminMenuRepository = new \App\Repositories\AdminMenuRepository(new \Illuminate\Container\Container);
    $sidebar_item = $adminMenuRepository->getMenuByType();
@endphp

<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        VVinners
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-chart-bar nav-icon"></i>
             Dashboard<span class="badge bg-info-gradient ms-auto">NEW</span></a></li>
        <li class="nav-title">Shop</li>
        @foreach($sidebar_item['shop'] as $parent_item)
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <i class="{{ $parent_item->icon }} nav-icon"></i> {{ $parent_item->title }}</a>
            <ul class="nav-group-items">
                @foreach($parent_item->child_item as $child_item)
                @if(($child_item->key && file_exists(app_path('plugins/' . $child_item->key))) || !$child_item->key)
                <li class="nav-item"><a class="nav-link" href="{{ route($child_item->url) }}"><span class="nav-icon"></span> {{ $child_item->title }}</a></li>
                @endif
                @endforeach
            </ul>
        </li>
        @endforeach
        <li class="nav-title">Marketing</li>
        @foreach($sidebar_item['marketing'] as $parent_item)
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <i class="{{ $parent_item->icon }} nav-icon"></i> {{ $parent_item->title }}</a>
            <ul class="nav-group-items">
                @foreach($parent_item->child_item as $child_item)
                @if(($child_item->key && file_exists(app_path('plugins/' . $child_item->key))) || !$child_item->key)
                <li class="nav-item"><a class="nav-link" href="{{ route($child_item->url) }}"><span class="nav-icon"></span> {{ $child_item->title }}</a></li>
                @endif
                @endforeach
            </ul>
        </li>
        @endforeach
        <li class="nav-title">System Config</li>
        @foreach($sidebar_item['system_config'] as $parent_item)
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <i class="{{ $parent_item->icon }} nav-icon"></i> {{ $parent_item->title }}</a>
            <ul class="nav-group-items">
                @foreach($parent_item->child_item as $child_item)
                @if(($child_item->key && file_exists(app_path('plugins/' . $child_item->key))) || !$child_item->key)
                <li class="nav-item"><a class="nav-link" href="{{ route($child_item->url) }}"><span class="nav-icon"></span> {{ $child_item->title }}</a></li>
                @endif
                @endforeach
            </ul>
        </li>
        @endforeach
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.plugin.index') }}">
                <i class="fa-solid fa-download nav-icon"></i> Plugin
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>