<div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">
        {{-- ** Master User --}}
        <div class="sidenav-menu-heading">Master</div>
        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
            data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
            <div class="nav-link-icon"><i data-feather="users"></i></div>
            Users
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                <a class="nav-link" href="{{ url('user/role') }}">
                    Role
                </a>
                <a class="nav-link" href="{{ url('user/permission') }}">Permission</a>
                <a class="nav-link" href="{{ url('user') }}">User</a>
            </nav>
        </div>
        {{-- ** End Master User --}}


        {{-- ** Presence --}}
        <!-- Sidenav Heading (Addons)-->
        <div class="sidenav-menu-heading">Presence</div>
        <!-- Sidenav Link (Charts)-->
        <a class="nav-link" href="charts.html">
            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
            In
        </a>
        <!-- Sidenav Link (Tables)-->
        <a class="nav-link" href="tables.html">
            <div class="nav-link-icon"><i data-feather="corner-down-left"></i></div>
            Out
        </a>
        {{-- ** End Presence --}}

    </div>
</div>
<!-- Sidenav Footer-->
<div class="sidenav-footer">
    <div class="sidenav-footer-content">
        <div class="sidenav-footer-subtitle">Logged in as:</div>
        <div class="sidenav-footer-title">Valerie Luna</div>
    </div>
</div>
