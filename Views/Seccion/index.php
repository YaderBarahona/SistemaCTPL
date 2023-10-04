<?php
include "Views/Templates/header.php"; ?>

<div class="page-wrapper">
  <div class="page-content">

    <!-- Page Heading -->

    <!-- <h1 class="h3 mb-2 text-gray-800">Tabla</h1> -->

    <!-- <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Usuarios</li>
  </ol> -->

    <?php
    if (isset($data['permisoCrearSeccion']) && is_array($data['permisoCrearSeccion']) && isset($data['permisoCrearSeccion'][0]['tp_perm'])) {
      $permisoCrearSeccion = $data['permisoCrearSeccion'][0]['tp_perm'];
    } else {
      $permisoCrearSeccion = '';
    }

    if (isset($data['permisoGlobalSeccion']) && is_array($data['permisoGlobalSeccion']) && isset($data['permisoGlobalSeccion'][0]['tp_perm'])) {
      $permisoGlobalSeccion = $data['permisoGlobalSeccion'][0]['tp_perm'];
    } else {
      $permisoGlobalSeccion = '';
    }
    ?>

    <?php
    if (!empty($permisoCrearSeccion) || !empty($permisoGlobalSeccion)) {
    ?>
      <button id="btnNuevaSeccion" class="btn btn-primary mb-2 boton" type="button">Nueva <i class="fas fa-plus"></i></i></i> </button>

    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-6">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Secciones</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="tblSecciones" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Sección</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!--  -->
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <?php
    if (isset($data['permisoReporteSeccion']) && is_array($data['permisoReporteSeccion']) && isset($data['permisoReporteSeccion'][0]['tp_perm'])) {
      $permisoReporteSeccion = $data['permisoReporteSeccion'][0]['tp_perm'];
    } else {
      $permisoReporteSeccion = '';
    }

    if (isset($data['permisoGlobalSeccion']) && is_array($data['permisoGlobalSeccion']) && isset($data['permisoGlobalSeccion'][0]['tp_perm'])) {
      $permisoGlobalSeccion = $data['permisoGlobalSeccion'][0]['tp_perm'];
    } else {
      $permisoGlobalSeccion = '';
    }
    ?>
    <input type="hidden" value="<?php echo $permisoReporteSeccion  ?>" id="permisoReporteSeccion">
    <input type="hidden" value="<?php echo $permisoGlobalSeccion  ?>" id="permisoGlobalSeccion">
  </div>
</div>

<!-- modal que reacciona al boton de nuevo usuario -->
<div id="nueva_seccion" class="modal fade" tabindex="-1" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title_modal">Nueva sección</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form action="post" id="frmSeccion">

          <div class="formulario__grupo" id="grupo__seccion">
            <div class="form-group formulario__grupo-input">
              <input type="hidden" id="id_hidden_seccion" name="id_hidden_seccion">
              <input type="hidden" id="SEC_hidden" name="SEC_hidden">
              <label for="inputSec" class="formulario__label">Sección</label>
              <input id="inputSec" class="form-control formulario__input" type="text" name="inputSec" placeholder="Sección">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El campo sección permite ingresar de 3 a 5 caracteres y solo puede contener números y debe incluir guion entre los números (1-2 caracteres antes y despues del guion).</p>
          </div>

          <!--  -->
          <div class="formulario__mensaje" id="formulario__mensaje">
            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
          </div>
          <!--  -->
          <div class="d-grid gap-2">
            <button id="btnModal" class="btn btn-primary btn-block formulario__btn boton" type="submit">Registrar</button>
            <button id="btnModal2" class="btn btn-danger btn-block formulario__btn2 boton" type="button">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>Assets/js/modulos/secciones/secciones.js"></script>
<?php include "Views/Templates/footer.php"; ?>