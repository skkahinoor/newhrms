<li class="nav-item {{ request()->routeIs('admin.procurement.*')  ? 'active' : '' }}">
    <a href="{{ route('admin.procurement.index') }}" data-href="{{ route('admin.procurement.index') }}" class="nav-link">
        <i class="link-icon" data-feather="box"></i>
        <span class="link-title">Procurements</span>
    </a>
</li>