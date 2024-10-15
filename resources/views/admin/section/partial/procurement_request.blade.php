@can('view_client_list')
<li class="nav-item {{ request()->routeIs('admin.clients.*')  ? 'active' : '' }}">
    <a
        href="{{ route('admin.procurement_request.index') }}"
        data-href="{{ route('admin.procurement_request.index') }}"
        class="nav-link">
        <i class="link-icon" data-feather="heart"></i>
        <span class="link-title">Requests</span>
    </a>
</li>
@endcan