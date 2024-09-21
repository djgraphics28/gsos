<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <x-application-logo width="75px" class="w-24 h-24 fill-current text-gray-500" />
        <div class="sidebar-brand-text mx-3">GSOS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @can('access dashboard')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Navigation
    </div>

    @can('access users')
    <!-- Nav Item - Users Collapse Menu -->
    <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="{{ request()->is('users*') ? 'true' : 'false' }}" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse {{ request()->is('users*') ? 'show' : '' }}"
            aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Components:</h6>
                <a class="collapse-item {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users.index') }}">List of Users</a>
                <a class="collapse-item {{ request()->is('users/create') ? 'active' : '' }}" href="{{ route('users.create') }}">Create New User</a>
                {{-- <a class="collapse-item {{ request()->is('users/roles-and-permissions') ? 'active' : '' }}" href="{{ route('roles.permissions') }}">Roles & Permissions</a> --}}
            </div>
        </div>
    </li>
    @endcan

    @can('access roles')
    <!-- Nav Item - Roles & Permissions Collapse Menu -->
    <li class="nav-item {{ request()->is('roles-and-permissions*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('roles.permissions') }}">
            <i class="fas fa-fw fa-lock"></i>
            <span>Roles & Permissions</span></a>
    </li>
    @endcan

    @can('access buildings')
    <!-- Nav Item - Buildings Collapse Menu -->
    <li class="nav-item {{ request()->is('buildings*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBuildings"
            aria-expanded="true" aria-controls="collapseBuildings">
            <i class="fas fa-fw fa-building"></i>
            <span>Buildings</span>
        </a>
        <div id="collapseBuildings" class="collapse {{ request()->is('buildings*') ? 'show' : '' }}" aria-labelledby="headingBuildings" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Building Components:</h6>
                <a class="collapse-item {{ request()->is('buildings') ? 'active' : '' }}" href="{{ route('buildings.index') }}">List of Buildings</a>
                <a class="collapse-item {{ request()->is('buildings/create') ? 'active' : '' }}" href="{{ route('buildings.create') }}">Create New Building</a>
            </div>
        </div>
    </li>
    @endcan

    @can('access supply')
     <!-- Nav Item - Workflows Menu -->
     <li class="nav-item {{ request()->is('supply-and-equipments*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplyAndEquipments"
            aria-expanded="true" aria-controls="collapseSupplyAndEquipments">
            <i class="fas fa-fw fa-building"></i>
            <span>Supply & Equipments</span>
        </a>
        <div id="collapseSupplyAndEquipments" class="collapse {{ request()->is('supply-and-equipments*') ? 'show' : '' }}" aria-labelledby="headingSupplyAndEquipments" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header"></h6> --}}
                <a class="collapse-item {{ request()->is('supply-and-equipments') ? 'active' : '' }}" href="{{ route('supply-and-equipments.index') }}">Supply and Equipments</a>
                <a class="collapse-item {{ request()->is('supply-and-equipments/create') ? 'active' : '' }}" href="{{ route('supply-and-equipments.create') }}">Create New</a>
            </div>
        </div>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Other Navigation
    </div>

    @can('access tickets')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa fa-folder"></i>
            <span>Tickets</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Ticket Components:</h6>
                <a class="collapse-item" href="login.html">Submit Ticket</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="login.html">My Tickets</a>
                <a class="collapse-item" href="register.html">My Assignments</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Ticket Statuses:</h6>
                <a class="collapse-item" href="404.html">Open</a>
                <a class="collapse-item" href="blank.html">In progress</a>
                <a class="collapse-item" href="blank.html">Closed</a>
            </div>
        </div>
    </li>
    @endcan

    @can('access workflows')
    <!-- Nav Item - Workflows Menu -->
    <li class="nav-item {{ request()->is('workflows*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWorkflows"
            aria-expanded="true" aria-controls="collapseWorkflows">
            <i class="fas fa-fw fa-building"></i>
            <span>Workflows</span>
        </a>
        <div id="collapseWorkflows" class="collapse {{ request()->is('workflows*') ? 'show' : '' }}" aria-labelledby="headingWorkflows" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Workflow Components:</h6>
                <a class="collapse-item {{ request()->is('workflows') ? 'active' : '' }}" href="{{ route('workflows.index') }}">List of Workflows</a>
                <a class="collapse-item {{ request()->is('workflows/create') ? 'active' : '' }}" href="{{ route('workflows.create') }}">Create New Workflow</a>
            </div>
        </div>
    </li>
    @endcan

    @can('access forms')
     <!-- Nav Item - Forms Menu -->
     <li class="nav-item {{ request()->is('forms*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForms"
            aria-expanded="true" aria-controls="collapseForms">
            <i class="fas fa-fw fa-building"></i>
            <span>Forms</span>
        </a>
        <div id="collapseForms" class="collapse {{ request()->is('forms*') ? 'show' : '' }}" aria-labelledby="headingForms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Form Components:</h6>
                <a class="collapse-item {{ request()->is('forms') ? 'active' : '' }}" href="{{ route('forms.index') }}">List of Forms</a>
                <a class="collapse-item {{ request()->is('forms/create') ? 'active' : '' }}" href="{{ route('forms.create') }}">Create New Form</a>
            </div>
        </div>
    </li>
    @endcan

    @can('access reports')
    <!-- Nav Item - Reports -->
    <li class="nav-item {{ request()->is('reports') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('reports') ? 'active' : '' }}" href="{{ route('reports.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Reports</span></a>
    </li>
    @endcan

    @can('access faqs')
    <!-- Nav Item - FAQs Menu -->
    <li class="nav-item {{ request()->is('faqs*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFAQs"
            aria-expanded="true" aria-controls="collapseFAQs">
            <i class="fas fa-fw fa-building"></i>
            <span>FAQs</span>
        </a>
        <div id="collapseFAQs" class="collapse {{ request()->is('faqs*') ? 'show' : '' }}" aria-labelledby="headingFAQs" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">FAQs Components:</h6>
                <a class="collapse-item {{ request()->is('faqs') ? 'active' : '' }}" href="{{ route('faqs.index') }}">List of FAQs</a>
                <a class="collapse-item {{ request()->is('faqs/create') ? 'active' : '' }}" href="{{ route('faqs.create') }}">Create New FAQ</a>
            </div>
        </div>
    </li>
    @endcan

    @can('access app settings')
    <!-- Nav Item - App settings -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-cogs"></i>
            <span>App Settings</span></a>
    </li>
    @endcan

    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
