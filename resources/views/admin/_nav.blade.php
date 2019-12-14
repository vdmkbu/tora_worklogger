<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $page === 'users' ? ' active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $page === 'positions' ? ' active' : '' }}" href="{{ route('admin.positions.index') }}">Positions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $page === 'projects' ? ' active' : '' }}" href="{{ route('admin.projects.index') }}">Projects</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $page === 'reports' ? ' active' : '' }}" href="{{ route('admin.reports.index') }}">Reports</a>
    </li>
</ul>