<div id="layoutSidenav_nav">
    <!-- Sidebar -->
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <!-- dashboard -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["dashboard"]) && $_SESSION["sidebar"]["active_tab"]["dashboard"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/dashboard'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/dashboard'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                <?php } ?>

                <!-- groups -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["groups"]) && $_SESSION["sidebar"]["active_tab"]["groups"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/groups';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Grupos
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/groups';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Grupos
                    </a>
                <?php } ?>

                <!-- users -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["users"]) && $_SESSION["sidebar"]["active_tab"]["users"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/users';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Utilizadores
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/users';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Utilizadores
                    </a>
                <?php } ?>

                <!-- securities -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["securities"]) && $_SESSION["sidebar"]["active_tab"]["securities"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/security';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>
                        Tabela de segurança
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/security';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>
                        Tabelas de segurança
                    </a>
                <?php } ?>

                <!-- trees -->
                <div class="sb-sidenav-menu-heading">Árvores</div>
                <!-- trees_dashboard -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["trees_dashboard"]) && $_SESSION["sidebar"]["active_tab"]["trees_dashboard"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/trees_dashboard';?>">Dashboard</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/trees_dashboard';?>">Dashboard</a>
                <?php } ?>

                <!-- trees -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["trees"]) && $_SESSION["sidebar"]["active_tab"]["trees"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/trees';?>">Árvores</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/trees';?>">Árvores</a>
                <?php } ?>

                <!-- trees users -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["trees_users"]) && $_SESSION["sidebar"]["active_tab"]["trees_users"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/trees_users';?>">Árvores-Utilizadores</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/trees_users';?>">Árvores-Utilizadores</a>
                <?php } ?>

                <!-- tree types -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["tree_types"]) && $_SESSION["sidebar"]["active_tab"]["tree_types"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/tree_types';?>">Tipos de árvores</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/tree_types';?>">Tipos de árvores</a>
                <?php } ?>

                <!-- tree interventions -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["tree_interventions"]) && $_SESSION["sidebar"]["active_tab"]["tree_interventions"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/tree_interventions';?>">Intervenções</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/tree_interventions';?>">Intervenções</a>
                <?php } ?>

                <!-- Settings -->
                <?php if (isset($_SESSION["sidebar"]["active_tab"]["settings"]) && $_SESSION["sidebar"]["active_tab"]["settings"] === true) { ?>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/settings';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                        Definições
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/settings';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                        Definições
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php echo $_SESSION["userdata"]["name"] ?>
        </div>
    </nav>
</div>

<script>
    $(document).ready(function() {
        if (localStorage.getItem('sidebar_collapsed_trees') === 'false') {
            $("#trees_collapse").addClass("show");
        }

        // function to get sidebar collapsed tab state
        $('#trees_collapse').on('show.bs.collapse', function () {
            // not collapsed/open
            localStorage.setItem('sidebar_collapsed_trees', "false");
        }).on('hide.bs.collapse', function () {
            // collapsed
            localStorage.setItem('sidebar_collapsed_trees', "true");
        });

    });
</script>