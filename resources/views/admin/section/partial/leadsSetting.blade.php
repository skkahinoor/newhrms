@can('view_leadsenquiries_list')
    <li class="nav-item {{ request()->routeIs('admin.leadenquiry.*')  ? 'active' : '' }}">
        <a
            href="{{ route('admin.leadenquiry.index') }}"
            data-href="{{ route('admin.leadenquiry.index') }}"
            class="nav-link">
            <i class="link-icon" data-feather="heart"></i>
            <span class="link-title">Leads Setting</span>
        </a>
</li>
@endcan
