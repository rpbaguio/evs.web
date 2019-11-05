<nav id="sidebar" class="sidebar sidebar-sticky">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= base_url() ?>">
            <i class="align-middle" data-feather="check-circle"></i>
            <span class="align-middle">EVS WEB</span>
        </a>
		<ul class="sidebar-nav">
            <li class="sidebar-header">Main</li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/persons') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Persons</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/groups') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Groups</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/candidates') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="circle"></i> <span class="align-middle">Candidates</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/positions') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="circle"></i> <span class="align-middle">Positions</span>
                </a>
            </li>
            <li class="sidebar-header">Report</li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/tally') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Tally</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/results') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Results</span>
                </a>
            </li>
            <li class="sidebar-header">Site</li>
            <li class="sidebar-item">
                <a href="<?= base_url('admin/settings') ?>" class="sidebar-link">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                </a>
            </li>
        </ul>
	</div>
</nav>