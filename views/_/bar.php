<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a href="index.html" class="navbar-brand col-sm-3 col-md-2 mr-0 text-center"><span class="logo">TFG</span> <span class="logo logo-red">Backups</span></a>
    <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Buscar" aria-label="Buscar">-->
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap" style="position: relative;">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" id="userDropdownMenu" data-toggle="dropdown" >
                <?= get_actual_username() ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="userDropdownMenu" style="position: absolute; right: 0;margin-left: -100px;">
                <a class="dropdown-item" href="#">Perfil</a>
                <a class="dropdown-item" href="#">Ajustes</a>
                <a class="dropdown-item" href="#">Cerrar sesión</a>
            </div>
        </li>
    </ul>
</nav>