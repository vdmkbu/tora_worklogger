<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link{{ $report === 'projects' ? ' active' : '' }}" href="{{ route('admin.reports.projects') }}">By projects</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $report === 'positions' ? ' active' : '' }}" href="{{ route('admin.reports.positions') }}">By positions</a>
    </li>

    <li class="nav-item">
        <a class="nav-link{{ $report === 'users' ? ' active' : '' }}" href="{{ route('admin.reports.users') }}">By users</a>
    </li>

</ul>