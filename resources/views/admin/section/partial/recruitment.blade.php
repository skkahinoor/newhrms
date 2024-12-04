@can('view_requirement_list')
    <li class="nav-item {{ request()->routeIs('admin.recruitment.*')  ? 'active' : '' }}">
        <a
            href="{{ route('admin.recruitment.manageRecruitment') }}"
            data-href="{{ route('admin.recruitment.manageRecruitment') }}"
            class="nav-link">
            <i class="link-icon" data-feather="send"></i>
            <span class="link-title">Recruitment</span>
        </a>
</li>
@endcan
