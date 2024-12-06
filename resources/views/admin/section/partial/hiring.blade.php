@canany(['hiring'])
    <li
        class="nav-item {{ request()->routeIs('admin.recruitment.manageRecruitment.*') || request()->routeIs('admin.jobapplication.index.*') ? 'active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#setting" role="button" aria-expanded="{{ request()->routeIs('admin.recruitment.manageRecruitment.*') || request()->routeIs('admin.jobapplication.index.*') ? 'true' : 'false' }}" aria-controls="setting">
            <i class="link-icon" data-feather="send"></i>
            <span class="link-title">Hiring</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="{{ request()->routeIs('admin.recruitment.manageRecruitment.*') || request()->routeIs('admin.jobapplication.index.*') ? '' : 'collapse' }}" id="setting">
            <ul class="nav sub-menu">
                @can('recruitment')
                    <li class="nav-item {{ request()->routeIs('admin.recruitment.manageRecruitment.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.recruitment.manageRecruitment') }}" class="nav-link {{ request()->routeIs('admin.recruitment.manageRecruitment.*') ? 'active' : '' }}">
                            Recruitment
                        </a>
                    </li>
                @endcan
 
                @can('jobapplication')
                    <li class="nav-item {{ request()->routeIs('admin.jobapplication.index.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.jobapplication.index') }}" class="nav-link {{ request()->routeIs('admin.jobapplication.index.*') ? 'active' : '' }}">
                            Job Applications
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcanany
