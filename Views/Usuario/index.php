<?php include "Views/Templates/header.php"; ?>
<!--start page wrapper -->
<div class="page-wrapper">
  <div class="page-content">

    <?php
    if (isset($data['permisoCrearUsuario']) && is_array($data['permisoCrearUsuario']) && isset($data['permisoCrearUsuario'][0]['tp_perm'])) {
      $permisoCrearUsuario = $data['permisoCrearUsuario'][0]['tp_perm'];
    } else {
      $permisoCrearUsuario = '';
    }

    if (isset($data['permisoGlobalUsuario']) && is_array($data['permisoGlobalUsuario']) && isset($data['permisoGlobalUsuario'][0]['tp_perm'])) {
      $permisoGlobalUsuario = $data['permisoGlobalUsuario'][0]['tp_perm'];
    } else {
      $permisoGlobalUsuario = '';
    }
    ?>

    <?php
    if (!empty($permisoCrearUsuario) || !empty($permisoGlobalUsuario)) {
    ?>
      <button class="btn btn-primary mb-2 boton" type="button" onclick="abrirModal();">Nuevo <i class="fas fa-plus"></i></button>

    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblUsuarios" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Fecha creación</th>
                <th>Fecha actualización</th>
                <th>Rol</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <?php
    if (isset($data['permisoReporteUsuario']) && is_array($data['permisoReporteUsuario']) && isset($data['permisoReporteUsuario'][0]['tp_perm'])) {
      $permisoReporteUsuario = $data['permisoReporteUsuario'][0]['tp_perm'];
    } else {
      $permisoReporteUsuario = '';
    }

    if (isset($data['permisoGlobalUsuario']) && is_array($data['permisoGlobalUsuario']) && isset($data['permisoGlobalUsuario'][0]['tp_perm'])) {
      $permisoGlobalUsuario = $data['permisoGlobalUsuario'][0]['tp_perm'];
    } else {
      $permisoGlobalUsuario = '';
    }
    ?>
    <input type="hidden" value="<?php echo $permisoReporteUsuario  ?>" id="permisoReporteUsuario">
    <input type="hidden" value="<?php echo $permisoGlobalUsuario  ?>" id="permisoGlobalUsuario">
  </div>
</div>

<!-- modal que reacciona al boton de nuevo usuario -->
<div id="nuevo_usuario" class="modal fade" tabindex="-1" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title_modal">Nuevo usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form action="post" id="frmUsuario">

          <div class="formulario__grupo" id="grupo__usuario">
            <div class="form-group formulario__grupo-input">
              <input type="hidden" id="id_hidden" name="id_hidden">
              <label for="inputUsuario" class="formulario__label">Usuario</label>
              <input id="inputUsuario" class="form-control formulario__input" type="text" name="inputUsuario" placeholder="Usuario">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El campo usuario permite ingresar entre 5 y 30 caracteres, solo admite letras, numeros, guion y guion bajo, no se permiten carácteres especiales ni espacios.</p>
          </div>

          <div class="formulario__grupo" id="grupo__correo">
            <div class="form-group formulario__grupo-input">
              <label for="inputCorreo" class="formulario__label">Correo eléctronico</label>
              <input id="inputCorreo" class="form-control formulario__input" type="text" name="inputCorreo" placeholder="Correo eléctronico">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El correo eléctronico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba "@" seguido del dominio y por ultimo una extensión (.com,.co,etc).</p>
          </div>

          <div class="row" id="contraseñas">
            <div class="col-md-6">
              <div class="formulario__grupo" id="grupo__nueva">
                <div class="form-group formulario__grupo-input">
                  <label for="inputPassword" class="formulario__label">Contraseña</label>
                  <input id="inputPassword" class="form-control formulario__input" type="password" name="inputPassword" placeholder="Contraseña">
                  <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, un carácter especial además la longitud mínima es de 8 caracteres y la longitud máxima es de 100 carácteres.</p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="formulario__grupo" id="grupo__confirmar">
                <div class="form-group formulario__grupo-input">
                  <label for="inputConfirmPassword" class="formulario__label">Confirmar contraseña</label>
                  <input id="inputConfirmPassword" class="form-control formulario__input" type="password" name="inputConfirmPassword" placeholder="Confirmar contraseña">
                  <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El campo confirmar contraseña no coincide con el campo nueva contraseña.</p>
              </div>
            </div>
          </div>

          <div class="form-group mb-2">
            <label for="selectRol">Rol</label>
            <select id="selectRol" class="form-control" name="selectRol">
              <?php foreach ($data['roles'] as $row) { ?>
                <!-- almacenamos en el value de cada option el id de cada registro de la tabla caja -->
                <option value="<?php echo $row['rol_id'] ?>">
                  <?php echo $row['tp_rol'] ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <!--  -->
          <div class="formulario__mensaje" id="formulario__mensaje">
            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
          </div>


          <!--  -->
          <div class="d-grid gap-2">
            <button id="btnModal" class="btn btn-primary formulario__btn boton" type="button" onclick="frmRegistrarUser(event);">Registrar</button>
            <button id="btnModal2" class="btn btn-danger formulario__btn2 boton" type="button" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- obtener value desde js -->

</div>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/usuarios/usuarios.js"></script>
<?php include "Views/Templates/footer.php"; ?>