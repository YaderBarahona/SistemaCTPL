<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="<?php echo BASE_URL; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="<?php echo BASE_URL; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- loader-->
  <link href="<?php echo BASE_URL; ?>assets/css/pace.min.css" rel="stylesheet" />
  <script src="<?php echo BASE_URL; ?>assets/js/pace.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Prata&family=Raleway&display=swap" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/css/app.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/css/icons.css" rel="stylesheet">
  <!-- Theme Style CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/dark-theme.css" />
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/semi-dark.css" />
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header-colors.css" />

  <!--  -->
  <link href="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.css" rel="stylesheet" />
  <link href="<?php echo BASE_URL; ?>assets/css/modulos/forms.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/css/modulos/btn.css" rel="stylesheet">
  <!-- <link href="<?php echo BASE_URL; ?>assets/bootstrap.min.css" rel="stylesheet" /> -->

  <title>SCCTPL</title>
</head>

<body>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class=" sidebar-header">

        <?php if (isset($_SESSION['permisoCompletoPanel'][0]['tp_perm'])) { ?>

          <div>
            <img src="<?php echo BASE_URL; ?>assets/images/escudo_ctp.png" class="logo-icon" alt="logo icon">
          </div>
          <div>
            <a href="<?php echo BASE_URL; ?>Principal">
              <h4 class="logo-text">SCCTPL</h4>
          </div>
          </a>
          <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
          </div>
      </div>
    <?php } else { ?>

      <div>
        <img src="<?php echo BASE_URL; ?>assets/images/escudo_ctp.png" class="logo-icon" alt="logo icon">
      </div>
      <div>
        <h4 class="logo-text">SCCTPL</h4>
      </div>
      <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
      </div>
    </div>
  <?php } ?>

  <!--navigation-->
  <ul class="metismenu" id="menu">
    <?php if (isset($_SESSION['permisoCompletoPanel'][0]['tp_perm'])) { ?>
      <li>
        <a href="<?php echo BASE_URL; ?>Principal">
          <div class="parent-icon"><i class='bx bx-home'></i>
          </div>
          <div class="menu-title">Panel</div>
        </a>
      </li>
    <?php } ?>

    <hr>

    <!-- <li>
          <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-folder-open'></i>
            </div>
            <div class="menu-title">Administración</div>
          </a>
          <ul>
            <li>
              <a href="widgets.html">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Usuarios</div>
              </a>
            </li>

            <li>
              <a href="widgets.html">
                <div class="parent-icon"><i class='bx bx-shield-alt-2'></i>
                </div>
                <div class="menu-title">Roles y permisos</div>
              </a>
            </li>

            <li>
              <a href="widgets.html">
                <div class="parent-icon"><i class='bx bx-history'></i>
                </div>
                <div class="menu-title">Log de acceso</div>
              </a>
            </li>
          </ul>
        </li> -->

    <?php if (isset($_SESSION['permisoCompletoUsuario'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarUsuario'][0]['tp_perm']) || isset($_SESSION['permisoCompletoRoles'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarRoles'][0]['tp_perm']) || isset($_SESSION['permisoCompletoEstudiantes'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarEstudiantes'][0]['tp_perm']) || isset($_SESSION['permisoCompletoSecciones'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarSecciones'][0]['tp_perm']) || isset($_SESSION['permisoCompletoAsistencias'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarAsistencias'][0]['tp_perm'])) { ?>
      <li class="menu-label">Gestión</li>
    <?php } ?>

    <?php if (isset($_SESSION['permisoCompletoUsuario'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarUsuario'][0]['tp_perm'])) { ?>

      <li>
        <a href="<?php echo BASE_URL; ?>Usuario">
          <div class="parent-icon"><i class='bx bx-user'></i>
          </div>
          <div class="menu-title">Usuarios</div>
        </a>
      </li>

    <?php } ?>

    <?php if (isset($_SESSION['permisoCompletoRoles'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarRoles'][0]['tp_perm'])) { ?>
      <li>
        <a href="<?php echo BASE_URL; ?>Rol">
          <div class="parent-icon"><i class='bx bx-shield-alt-2'></i>
          </div>
          <div class="menu-title">Roles y permisos</div>
        </a>
      </li>
    <?php } ?>

    <li>
      <a href="widgets.html">
        <div class="parent-icon"><i class='bx bx-history'></i>
        </div>
        <div class="menu-title">Log de acceso</div>
      </a>
    </li>

    <?php if (isset($_SESSION['permisoCompletoEstudiantes'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarEstudiantes'][0]['tp_perm'])) { ?>
      <li>
        <a href="<?php echo BASE_URL; ?>Estudiante">
          <div class="parent-icon"><i class='bx bx-id-card'></i>
          </div>
          <div class="menu-title">Estudiantes</div>
        </a>
      </li>
    <?php } ?>


    <?php if (isset($_SESSION['permisoCompletoSecciones'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarSecciones'][0]['tp_perm'])) { ?>
      <li>
        <a href="<?php echo BASE_URL; ?>Seccion">
          <div class="parent-icon"><i class='bx bx-list-ol'></i>
          </div>
          <div class="menu-title">Secciones</div>
        </a>
      </li>
    <?php } ?>

    <?php if (isset($_SESSION['permisoCompletoAsistencias'][0]['tp_perm']) || isset($_SESSION['permisoParcialMostrarAsistencias'][0]['tp_perm'])) { ?>
      <li>
        <a href="<?php echo BASE_URL; ?>AsistenciaComedor">
          <div class="parent-icon"><i class='bx bx-task'></i>
          </div>
          <div class="menu-title">Historial Asistencia</div>
        </a>
      </li>
    <?php } ?>

    <?php if (isset($_SESSION['permisoCompletoQR'][0]['tp_perm'])) { ?>
      <hr>

      <li class="menu-label">QR</li>

      <li>
        <a href="<?php echo BASE_URL; ?>Qr">
          <div class="parent-icon"><i class='bx bx-webcam'></i>
          </div>
          <div class="menu-title">Escanear QR</div>
        </a>
      </li>
    <?php } ?>

  </ul>
  <!--end navigation-->
  </div>
  <!--end sidebar wrapper -->
  <!--start header -->
  <header>
    <div class="topbar d-flex align-items-center">
      <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
        </div>

        <div class="top-menu ms-auto">
          <ul class="navbar-nav align-items-center gap-1">
            <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;" data-bs-toggle="dropdown"><img src="assets/images/county/06.png" width="22" alt="">
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/06.png" width="20" alt=""><span class="ms-2">English</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/06.png" width="20" alt=""><span class="ms-2">Spanish</span></a>
                </li>
              </ul>
            </li>
            <li class="nav-item dark-mode d-none d-sm-flex">
              <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
              </a>
            </li>

            <!-- <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
                  <i class='bx bx-bell'></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a href="javascript:;">
                    <div class="msg-header">
                      <p class="msg-header-title">Notifications</p>
                      <p class="msg-header-badge">8 New</p>
                    </div>
                  </a>
                  <div class="header-notifications-list">
                    <a class="dropdown-item" href="javascript:;">
                      <div class="d-flex align-items-center">
                        <div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
                              ago</span></h6>
                          <p class="msg-info">Successfully shipped your item</p>
                        </div>
                      </div>
                    </a>
                  </div>
                  <a href="javascript:;">
                    <div class="text-center msg-footer">
                      <button class="btn btn-primary w-100">View All Notifications</button>
                    </div>
                  </a>
                </div>
              </li> -->

          </ul>
        </div>

        <div class="user-box dropdown px-3">
          <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar"> -->
            <div class="user-info">
              <p class="user-name mb-0 align-items-center"><?php echo $_SESSION['usuario'] ?></p>
              <p class="designattion mb-0"><?php echo $_SESSION['correo'] ?></p>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
            </li>
            <li>
              <div class="dropdown-divider mb-0"></div>
            </li>
            <li><a class="dropdown-item d-flex align-items-center" href="<?php echo BASE_URL; ?>Usuario/cerrarSesion"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
            </li>

            <!-- <a class="dropdown-item" href="<?php echo BASE_URL; ?>Perfil"> -->
            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiarPass"> -->
            <!-- <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> -->
            <!-- <i class="fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cambiar contraseña
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a> -->

          </ul>
        </div>
      </nav>
    </div>
  </header>
  <!--end header -->