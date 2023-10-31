<?php
include "Views/Templates/header.php"; ?>

<div class="page-wrapper">
  <div class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3 students">Estudiantes</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item active management" aria-current="page">Gestión</li>
            </li>
            <li class="breadcrumb-item active students" aria-current="page">Estudiantes</li>
          </ol>
        </nav>
      </div>
    </div>

    <?php
    if (isset($data['permisoCrearEstudiante']) && is_array($data['permisoCrearEstudiante']) && isset($data['permisoCrearEstudiante'][0]['tp_perm'])) {
      $permisoCrearEstudiante = $data['permisoCrearEstudiante'][0]['tp_perm'];
    } else {
      $permisoCrearEstudiante = '';
    }

    if (isset($data['permisoGlobalEstudiante']) && is_array($data['permisoGlobalEstudiante']) && isset($data['permisoGlobalEstudiante'][0]['tp_perm'])) {
      $permisoGlobalEstudiante = $data['permisoGlobalEstudiante'][0]['tp_perm'];
    } else {
      $permisoGlobalEstudiante = '';
    }
    ?>

    <?php
    if (!empty($permisoCrearEstudiante) || !empty($permisoGlobalEstudiante)) {
    ?>
      <button id="btnNuevoEstudiante" class="btn btn-primary mb-2 boton new" type="button">Nuevo <i class="fas fa-plus"></i></i> </button>

    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center students">Estudiantes</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="tblEstudiantes" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
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
    if (isset($data['permisoReporteEstudiante']) && is_array($data['permisoReporteEstudiante']) && isset($data['permisoReporteEstudiante'][0]['tp_perm'])) {
      $permisoReporteEstudiante = $data['permisoReporteEstudiante'][0]['tp_perm'];
    } else {
      $permisoReporteEstudiante = '';
    }

    if (isset($data['permisoGlobalEstudiante']) && is_array($data['permisoGlobalEstudiante']) && isset($data['permisoGlobalEstudiante'][0]['tp_perm'])) {
      $permisoGlobalEstudiante = $data['permisoGlobalEstudiante'][0]['tp_perm'];
    } else {
      $permisoGlobalEstudiante = '';
    }
    ?>
    <input type="hidden" value="<?php echo $permisoReporteEstudiante  ?>" id="permisoReporteEstudiante">
    <input type="hidden" value="<?php echo $permisoGlobalEstudiante  ?>" id="permisoGlobalEstudiante">
  </div>
</div>

<!-- modal que reacciona al boton de nuevo usuario -->
<div id="nuevo_estudiante" class="modal fade" tabindex="-1" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title_modal">Nuevo estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form action="post" id="frmEstudiante">

          <div class="formulario__grupo" id="grupo__cedula">
            <div class="form-group formulario__grupo-input">
              <input type="hidden" id="id_hidden_estudiante" name="id_hidden_estudiante">
              <input type="hidden" id="CED_hidden" name="CED_hidden">
              <label for="inputCed" class="formulario__label ced">Cédula</label>
              <input id="inputCed" class="form-control formulario__input" type="text" name="inputCed" placeholder="Cédula">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error cedValidation">El campo cédula permite ingresar de 8 a 15 caracteres y solo puede contener letras, numeros y guiones.</p>
          </div>

          <div class="formulario__grupo" id="grupo__nombre">
            <div class="form-group formulario__grupo-input">
              <label for="inputNombre" class="formulario__label fullname">Nombre</label>
              <input id="inputNombre" class="form-control formulario__input" type="text" name="inputNombre" placeholder="Nombre">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error fullnameValidation">El campo nombre permite ingresar entre 1 y 30 caracteres y solo puede contener letras.</p>
          </div>
          <div class="formulario__grupo" id="grupo__apellido1">
            <div class="form-group formulario__grupo-input">
              <label for="inputPa" class="formulario__label pa">Primer apellido</label>
              <input id="inputPa" class="form-control formulario__input" type="text" name="inputPa" placeholder="Primer apellido">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error paValidation">El campo primer apellido permite ingresar entre 1 y 30 caracteres y solo puede contener letras.</p>
          </div>
          <div class="formulario__grupo" id="grupo__apellido2">
            <div class="form-group formulario__grupo-input">
              <label for="inputSa" class="formulario__label sa">Segundo apellido</label>
              <input id="inputSa" class="form-control formulario__input" type="text" name="inputSa" placeholder="Segundo apellido">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error saValidation">El campo segundo apellido permite ingresar entre 1 y 30 caracteres y solo puede contener letras.</p>
          </div>
          <div class="form-group mb-2">
            <label for="selectSec" class="formulario__label section">Sección</label>
            <select id="selectSec" class="form-control" name="selectSec">
              <?php foreach ($data['seccion'] as $row) { ?>
                <!-- almacenamos en el value de cada option el id de cada registro de la tabla secciones -->
                <option value="<?php echo $row['sec_id'] ?>">
                  <?php echo $row['num_sec'] ?>
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
            <button id="btnModal" class="btn btn-primary btn-block formulario__btn boton" type="submit">Registrar</button>
            <button id="btnModal2" class="btn btn-danger btn-block formulario__btn2 boton cancel" type="button">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/estudiantes/estudiantes.js"></script>
<?php include "Views/Templates/footer.php"; ?>