<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a href="/" class="navbar-brand col-sm-3 col-md-2 mr-0 text-center"><span class="logo">TFG</span> <span class="logo logo-red">Backups</span></a>
    <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Buscar" aria-label="Buscar">-->
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap" style="position: relative;">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" id="userDropdownMenu" data-toggle="dropdown" >
                <?= get_actual_user()->username ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="userDropdownMenu" style="position: absolute; right: 0;margin-left: -100px;">
                <a class="dropdown-item" href="/Users/user/<?= get_actual_user()->id ?>">Perfil</a>
                <a class="dropdown-item" href="/Users/user_config/<?= get_actual_user()->id ?>">Preferencias</a>
                <hr>
                <a class="dropdown-item" href="/Users/logout"><span data-feather="log-out"></span> Cerrar sesión</a>
            </div>
        </li>
    </ul>
</nav>
