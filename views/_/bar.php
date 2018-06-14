<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a href="/" class="navbar-brand col-sm-12 col-md-3 col-lg-2 mr-0 text-center"><span class="logo">TFG</span> <span class="logo logo-red">Backups</span></a>
    <ul class="navbar-nav px-3 col-md-2 col-sm-12">
        <li class="nav-item text-nowrap" style="position: relative;">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle col-sm-12" id="userDropdownMenu" data-toggle="dropdown">
                <?= get_actual_user()->username ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="userDropdownMenu" style="position: absolute; right: 0;">
                <span class="d-xs-block d-md-none">
                    <?php foreach (get_menu_items()['base_menu'] as $menu_item): ?>
                        <a class="dropdown-item" href="<?= $menu_item['url'] ?>">
                            <span data-feather="<?= $menu_item['icon'] ?>"></span> <?= $menu_item['label'] ?>
                        </a>
                    <?php endforeach; ?>
                    <hr/>
                    <?php foreach (get_menu_items()['backups_menu'] as $menu_item): ?>
                        <a class="dropdown-item" href="<?= $menu_item['url'] ?>">
                            <span data-feather="<?= $menu_item['icon'] ?>"></span> <?= $menu_item['label'] ?>
                        </a>
                    <?php endforeach; ?>
                    <?php if(check_perm('ADMIN')): ?>
                        <hr/>
                        <?php foreach (get_menu_items()['admin_menu'] as $menu_item): ?>
                            <a class="dropdown-item" href="<?= $menu_item['url'] ?>">
                                <span data-feather="<?= $menu_item['icon'] ?>"></span> <?= $menu_item['label'] ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif ?>
                </span>
                <hr/>
                <a class="dropdown-item" href="/Users/user/<?= get_actual_user()->id ?>">Perfil</a>
                <a class="dropdown-item" href="/Users/user_config/<?= get_actual_user()->id ?>">Preferencias</a>
                <hr>
                <a class="dropdown-item" href="/Users/logout"><span data-feather="log-out"></span> Cerrar sesión</a>
            </div>
        </li>
    </ul>
</nav>
