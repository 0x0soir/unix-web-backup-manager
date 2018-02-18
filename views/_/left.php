<?php
$menu = array(
    array(
        'id' => 'dashboards_index',
        'url' => '/Dashboards/index',
        'icon' => 'home',
        'label' => 'Inicio'
    ),
    array(
        'id' => 'backups_index',
        'url' => '/Backups/index',
        'icon' => 'layers',
        'label' => 'Backups'
    )
);

$admin_menu = array(
    array(
        'id' => 'users_users',
        'url' => '/Users/users',
        'icon' => 'users',
        'label' => 'Usuarios'
    )
);
?>
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <?php foreach ($menu as $menu_item): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ! empty($menu_active) && $menu_active == $menu_item['id'] ? 'active' : '' ?>" href="<?= $menu_item['url'] ?>">
                        <span data-feather="<?= $menu_item['icon'] ?>"></span>
                        <?= $menu_item['label'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if(check_perm('ADMIN')): ?>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Administración</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <?php foreach ($admin_menu as $menu_item): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ! empty($menu_active) && $menu_active == $menu_item['id'] ? 'active' : '' ?>" href="<?= $menu_item['url'] ?>">
                            <span data-feather="<?= $menu_item['icon'] ?>"></span>
                            <?= $menu_item['label'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Últimos backups</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    Hace 2 días
                </a>
            </li>
        </ul>
    </div>
</nav>
