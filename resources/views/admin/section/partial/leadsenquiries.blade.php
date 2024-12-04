@can('view_leadsenquiries_list')
    <li class="nav-item {{ request()->routeIs('admin.leadsenquiries.*')  ? 'active' : '' }}">
        <a
            href="{{ route('admin.leadsenquiries.index') }}"
            data-href="{{ route('admin.leadsenquiries.index') }}"
            class="nav-link">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Leads Enquiry</span>
        </a>
</li>
@endcan
