<nav class="col-lg-2 col-md-3 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <?php foreach (get_menu_items()['base_menu'] as $menu_item): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ! empty($menu_active) && $menu_active == $menu_item['id'] ? 'active' : '' ?>" href="<?= $menu_item['url'] ?>">
                        <span data-feather="<?= $menu_item['icon'] ?>"></span>
                        <?= $menu_item['label'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Backups</span>
        </h6>
        <ul class="nav flex-column">
            <?php foreach (get_menu_items()['backups_menu'] as $menu_item): ?>
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
                <?php foreach (get_menu_items()['admin_menu'] as $menu_item): ?>
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
        </h6>
        <ul class="nav flex-column mb-2">
            <?php $last_backups = get_last_backups(); ?>
            <?php if (count($last_backups) > 0): ?>
                <?php foreach (get_last_backups() as $backup): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $backup->download_link() ?>" style="background-color: #f0f0f0;margin:5px;">
                            <span class="badge badge-secondary" style="max-width:70%; text-overflow: ellipsis;overflow:hidden;" data-toggle="tooltip" data-placement="top" title="<?= $backup->backup->source_directory ?>"><?= $backup->backup->source_directory ?></span>
                            <span class="badge badge-info pull-right"><?= $backup->type ?></span>
                            <span class="badge badge-success" style="width:100%;margin-top:5px;"><?= $backup->created_at ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <span class="badge badge-info" style="margin:5px;">No existen backups recientes.</span>
            <?php endif; ?>
        </ul>
    </div>
</nav>
