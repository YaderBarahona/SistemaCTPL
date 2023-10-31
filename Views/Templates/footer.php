<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<footer class="page-footer">
  <p class="mb-0">Copyright &copy; SCCTPL <?php echo date("Y"); ?></p>
</footer>
</div>
<!--end wrapper-->

<!--start switcher-->
<!-- <div class="switcher-wrapper">
  <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
  </div>
  <div class="switcher-body">
    <div class="d-flex align-items-center">
      <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
      <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
    </div>
    <hr />
    <h6 class="mb-0">Theme Styles</h6>
    <hr />
    <div class="d-flex align-items-center justify-content-between">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
        <label class="form-check-label" for="lightmode">Light</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
        <label class="form-check-label" for="darkmode">Dark</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
        <label class="form-check-label" for="semidark">Semi Dark</label>
      </div>
    </div>
    <hr />
    <div class="form-check">
      <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
      <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
    </div>
    <hr />
    <h6 class="mb-0">Header Colors</h6>
    <hr />
    <div class="header-colors-indigators">
      <div class="row row-cols-auto g-3">
        <div class="col">
          <div class="indigator headercolor1" id="headercolor1"></div>
        </div>
        <div class="col">
          <div class="indigator headercolor2" id="headercolor2"></div>
        </div>
        <div class="col">
          <div class="indigator headercolor3" id="headercolor3"></div>
        </div>
        <div class="col">
          <div class="indigator headercolor4" id="headercolor4"></div>
        </div>
        <div class="col">
          <div class="indigator headercolor5" id="headercolor5"></div>
        </div>
        <div class="col">
          <div class="indigator headercolor6" id="headercolor6"></div>
        </div>
        <div class="col">
          <div class="indigator headercolor7" id="headercolor7"></div>
        </div>
        <div class="col">
          <div class="indigator headercolor8" id="headercolor8"></div>
        </div>
      </div>
    </div>
    <hr />
    <h6 class="mb-0">Sidebar Colors</h6>
    <hr />
    <div class="header-colors-indigators">
      <div class="row row-cols-auto g-3">
        <div class="col">
          <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
        </div>
        <div class="col">
          <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
        </div>
        <div class="col">
          <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
        </div>
        <div class="col">
          <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
        </div>
        <div class="col">
          <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
        </div>
        <div class="col">
          <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
        </div>
        <div class="col">
          <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
        </div>
        <div class="col">
          <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!--end switcher-->


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="<?php echo BASE_URL ?>Usuario/cerrarSesion">Cerrar sesión</a>
      </div>
    </div>
  </div>
</div>

<!-- modal cambiar contraseña -->
<div id="cambiarPass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Cambiar contraseña</h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmCambiarPass">

          <div class="formulario__grupo" id="grupo__actual">
            <div class="form-group formulario__grupo-input">
              <label for="passActual" class="formulario__label">Contraseña actual</label>
              <input id="passActual" class="form-control formulario__input" type="password" name="passActual" placeholder="Contraseña actual">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El campo contraseña actual no coincide con la contraseña actual no coincide.</p>
          </div>

          <div class="formulario__grupo" id="grupo__pass1">
            <div class="form-group formulario__grupo-input">
              <label for="passNueva" class="formulario__label">Nueva contraseña</label>
              <input id="passNueva" class="form-control formulario__input" type="password" name="passNueva" placeholder="Nueva contraseña">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, un carácter especial ademas la longitud mínima es de 8 caracteres y la longitud máxima es de 100 caracteres.</p>
          </div>

          <div class="formulario__grupo" id="grupo__pass2">
            <div class="form-group formulario__grupo-input">
              <label for="passConfirm" class="formulario__label">Confirmar contraseña</label>
              <input id="passConfirm" class="form-control formulario__input" type="password" name="passConfirm" placeholder="Confirmar contraseña">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El campo confirmar contraseña no coincide con la nueva contraseña.</p>
          </div>

          <!--  -->
          <div class="formulario__mensaje" id="formulario__mensaje">
            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
          </div>
          <!--  -->

          <button class="btn btn-primary btn-block formulario__btn boton" type="submit">Actualizar contraseña</button>
          <button id="btnCancelPass" class="btn btn-danger btn-block formulario__btn2 boton" type="button">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->

<!-- Bootstrap JS -->
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<!-- <script src="<?php echo BASE_URL; ?>assets/bootstrap.bundle.min.js"></script> -->

<!--plugins-->
<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
<!-- <script src="<?php echo BASE_URL; ?>assets/jquery-3.7.1.min.js"></script> -->
<script src="<?php echo BASE_URL; ?>assets/jquery-ui.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/chartjs/js/chart.js"></script>

<script src="<?php echo BASE_URL; ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>

<!--app JS-->
<script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/index.js"></script>

<script>
  const BASE_URL = "<?php echo BASE_URL; ?>";
</script>

<script src="<?php echo BASE_URL; ?>assets/fontawesome-5.15.4.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/js/modulos/alertas.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/js/modulos/usuarios/cambiar_password.js"></script>

<script src="<?php echo BASE_URL; ?>Assets/js/modulos/multilenguaje/multilenguaje.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/js/modulos/usuarios/logout.js"></script>

</body>

</html>