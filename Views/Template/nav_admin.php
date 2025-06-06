<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png"
            alt="User Image">
        <div>
            <p class="app-sidebar__user-name">
                <?= $_SESSION['userData']['nombres'].' '.substr($_SESSION['userData']['apellidos'], 0, strpos($_SESSION['userData']['apellidos'], ' ')); ?>
            </p>
            <p class="app-sidebar__user-designation">
                <?= $_SESSION['userData']['nombrerol']; ?>
            </p>
        </div>
    </div>
    <ul class="app-menu">
        <?php if (!empty($_SESSION['permisos'][1]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>dashboard">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Inicio</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                    <span class="app-menu__label">Usuarios</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url(); ?>usuarios"><i class="icon fa fa-circle-o"></i>
                            Usuarios</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>roles"><i class="icon fa fa-circle-o"></i>
                            Roles</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
            <li>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][6]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-shopping-bag" aria-hidden="true"></i>
                    <span class="app-menu__label">Almacenes</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>almacenes"><i class="icon fa fa-circle-o"></i>
                                Almacenes</a></li>
                    <?php } ?>
                    <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>productos"><i class="icon fa fa-circle-o"></i>
                                Productos</a></li>
                    <?php } ?>
                    <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>categorias"><i class="icon fa fa-circle-o"></i>
                                Categorias Productos</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>modulos">
                    <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="app-menu__label">Modulos</span>
                </a>
            </li>
        <?php } ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Logout</span>
            </a>
        </li>
    </ul>
</aside>