<?php include "Views/Templates/header.php"; ?>
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/modulos/checkbox4.css">
<div class="page-wrapper">
  <div class="page-content">
    <div class="col-md-9 mx-auto">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-permisos_globales-tab" data-bs-toggle="tab" data-bs-target="#permisos_globales" type="button" role="tab" aria-controls="permisos_globales" aria-selected="true">Permisos globales</button>
          <button class="nav-link" id="nav-permisos_parciales-tab" data-bs-toggle="tab" data-bs-target="#permisos_parciales" type="button" role="tab" aria-controls="permisos_parciales" aria-selected="false">Permisos parciales</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active mt-2" id="permisos_globales" role="tabpanel" aria-labelledby="permisos_globales-tab" tabindex="0">
          <!-- <h5 class="card-title text-center"><i class="fas fa-users"></i> Listado de permisos globales</h5>
          <hr> -->
          <div class="card" id="preloadedCard">
            <div class="card-header text-center bg-primary text-white">
              Asignar permisos globales
            </div>

            <div class="card-body">
              <h4 class="text-center">Módulo global</h4>
              <form id="frmPermisosGlobales" class="w-100" onsubmit="registrarPermisosGlobales(event);">
                <div class="row">
                  <?php
                  $contador = 1;
                  //acceder al array datos de $data
                  foreach ($data['datos'] as $row) { ?>
                    <div class="col-md-4 text-center text-capitalize p-2">
                      <div class="checkbox-wrapper-55">
                        <label class="rocker rocker-small">
                          <input type="checkbox" name="permisos[]" value="<?php echo $row['perm_id']; ?>" <?php echo isset($data['asignados'][$row['perm_id']]) ? 'checked' : ''; ?> />
                          <span class="switch-left">SÍ</span>
                          <span class="switch-right">NO</span>
                        </label>
                        <div> <span><?php echo $row['tp_perm'] ?></span></div>
                      </div>
                    </div>
                  <?php
                    $contador++;
                  } ?>
                  <input type="hidden" value="<?php echo $data['rol_id'] ?>" name="rol_id">
                </div>
                <?php
                if (isset($data['asignarDesignarPermisosGlobal']) && is_array($data['asignarDesignarPermisosGlobal']) && isset($data['asignarDesignarPermisosGlobal'][0]['tp_perm'])) {
                  $asignarDesignarPermisosGlobal = $data['asignarDesignarPermisosGlobal'][0]['tp_perm'];
                } else {
                  $asignarDesignarPermisosGlobal = '';
                }

                if (isset($data['asignarDesignarPermisosParcial']) && is_array($data['asignarDesignarPermisosParcial']) && isset($data['asignarDesignarPermisosParcial'][0]['tp_perm'])) {
                  $asignarDesignarPermisosParcial = $data['asignarDesignarPermisosParcial'][0]['tp_perm'];
                } else {
                  $asignarDesignarPermisosParcial = '';
                }
                ?>

                <?php
                if (!empty($asignarDesignarPermisosGlobal) || !empty($asignarDesignarPermisosParcial)) {
                ?>
                  <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-block" type="submit">Asignar permiso</button> <!-- Agrega la clase btn-block -->
                    <a class="btn btn-outline-danger btn-block" href="<?php echo BASE_URL ?>Rol">Cancelar</a> <!-- Agrega la clase btn-block -->
                  </div>

                <?php } ?>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade mt-2" id="permisos_parciales" role="tabpanel" aria-labelledby="permisos_parciales-tab" tabindex="0">
          <!-- <h5 class="card-title text-center"><i class="fas fa-users"></i> Listado de permisos parciales</h5>
          <hr> -->
          <div class="card">
            <div class="card-header text-center bg-primary text-white">
              Asignar permisos parciales
            </div>

            <div class="card-body">
              <form id="frmPermisosParciales" class="w-100" onsubmit="registrarPermisosParciales(event);">
                <div>
                  <h4 class="text-center">Módulo Usuarios</h4>
                </div>
                <div class="row">
                  <?php
                  $contador = 1;
                  //acceder al array datos de $data
                  foreach ($data['permisosParcialesUsuario'] as $row) { ?>
                    <div class="col-md-3 text-center text-capitalize p-2">
                      <div class="checkbox-wrapper-55">
                        <label class="rocker rocker-small">
                          <input type="checkbox" name="permisos[]" value="<?php echo $row['perm_id']; ?>" <?php echo isset($data['asignados'][$row['perm_id']]) ? 'checked' : ''; ?> />
                          <span class="switch-left">SÍ</span>
                          <span class="switch-right">NO</span>
                        </label>
                        <div> <span><?php echo $row['tp_perm'] ?></span></div>
                      </div>
                    </div>
                  <?php
                    $contador++;
                  } ?>
                  <input type="hidden" value="<?php echo $data['rol_id'] ?>" name="rol_id">
                </div>
                <hr>
                <div>
                  <h4 class="text-center">Módulo Roles</h4>
                </div>
                <div class="row">
                  <?php
                  $contador = 1;
                  //acceder al array datos de $data
                  foreach ($data['permisosParcialesRoles'] as $row) { ?>
                    <div class="col-md text-center text-capitalize p-2">
                      <div class="checkbox-wrapper-55">
                        <label class="rocker rocker-small">
                          <input type="checkbox" name="permisos[]" value="<?php echo $row['perm_id']; ?>" <?php echo isset($data['asignados'][$row['perm_id']]) ? 'checked' : ''; ?> />
                          <span class="switch-left">SÍ</span>
                          <span class="switch-right">NO</span>
                        </label>
                        <div> <span><?php echo $row['tp_perm'] ?></span></div>
                      </div>
                    </div>
                  <?php
                    $contador++;
                  } ?>
                  <input type="hidden" value="<?php echo $data['rol_id'] ?>" name="rol_id">
                </div>
                <div>
                  <hr>
                  <h4 class="text-center">Módulo Permisos</h4>
                </div>
                <div class="row">
                  <?php
                  $contador = 1;
                  //acceder al array datos de $data
                  foreach ($data['permisosParcialesPermisos'] as $row) { ?>
                    <div class="col-md text-center text-capitalize p-2">
                      <div class="checkbox-wrapper-55">
                        <label class="rocker rocker-small">
                          <input type="checkbox" name="permisos[]" value="<?php echo $row['perm_id']; ?>" <?php echo isset($data['asignados'][$row['perm_id']]) ? 'checked' : ''; ?> />
                          <span class="switch-left">SÍ</span>
                          <span class="switch-right">NO</span>
                        </label>
                        <div> <span><?php echo $row['tp_perm'] ?></span></div>
                      </div>
                    </div>
                  <?php
                    $contador++;
                  } ?>
                  <input type="hidden" value="<?php echo $data['rol_id'] ?>" name="rol_id">
                </div>
                <hr>
                <div>
                  <h4 class="text-center">Módulo Estudiantes</h4>
                </div>
                <div class="row">
                  <?php
                  $contador = 1;
                  //acceder al array datos de $data
                  foreach ($data['permisosParcialesEstudiantes'] as $row) { ?>
                    <div class="col-md text-center text-capitalize p-2">
                      <div class="checkbox-wrapper-55">
                        <label class="rocker rocker-small">
                          <input type="checkbox" name="permisos[]" value="<?php echo $row['perm_id']; ?>" <?php echo isset($data['asignados'][$row['perm_id']]) ? 'checked' : ''; ?> />
                          <span class="switch-left">SÍ</span>
                          <span class="switch-right">NO</span>
                        </label>
                        <div> <span><?php echo $row['tp_perm'] ?></span></div>
                      </div>
                    </div>
                  <?php
                    $contador++;
                  } ?>
                  <input type="hidden" value="<?php echo $data['rol_id'] ?>" name="rol_id">
                </div>
                <hr>
                <div>
                  <h4 class="text-center">Módulo Secciones</h4>
                </div>
                <div class="row">
                  <?php
                  $contador = 1;
                  //acceder al array datos de $data
                  foreach ($data['permisosParcialesSecciones'] as $row) { ?>
                    <div class="col-md text-center text-capitalize p-2">
                      <div class="checkbox-wrapper-55">
                        <label class="rocker rocker-small">
                          <input type="checkbox" name="permisos[]" value="<?php echo $row['perm_id']; ?>" <?php echo isset($data['asignados'][$row['perm_id']]) ? 'checked' : ''; ?> />
                          <span class="switch-left">SÍ</span>
                          <span class="switch-right">NO</span>
                        </label>
                        <div> <span><?php echo $row['tp_perm'] ?></span></div>
                      </div>
                    </div>
                  <?php
                    $contador++;
                  } ?>
                  <input type="hidden" value="<?php echo $data['rol_id'] ?>" name="rol_id">
                </div>
                <hr>
                <div>
                  <h4 class="text-center">Módulo Asistencias</h4>
                </div>
                <div class="row">
                  <?php
                  $contador = 1;
                  //acceder al array datos de $data
                  foreach ($data['permisosParcialesAsistencias'] as $row) { ?>
                    <div class="col-md text-center text-capitalize p-2">
                      <div class="checkbox-wrapper-55">
                        <label class="rocker rocker-small">
                          <input type="checkbox" name="permisos[]" value="<?php echo $row['perm_id']; ?>" <?php echo isset($data['asignados'][$row['perm_id']]) ? 'checked' : ''; ?> />
                          <span class="switch-left">SÍ</span>
                          <span class="switch-right">NO</span>
                        </label>
                        <div> <span><?php echo $row['tp_perm'] ?></span></div>
                      </div>
                    </div>
                  <?php
                    $contador++;
                  } ?>
                  <input type="hidden" value="<?php echo $data['rol_id'] ?>" name="rol_id">
                </div>
                <hr>
                <?php
                if (isset($data['asignarDesignarPermisosGlobal']) && is_array($data['asignarDesignarPermisosGlobal']) && isset($data['asignarDesignarPermisosGlobal'][0]['tp_perm'])) {
                  $asignarDesignarPermisosGlobal = $data['asignarDesignarPermisosGlobal'][0]['tp_perm'];
                } else {
                  $asignarDesignarPermisosGlobal = '';
                }

                if (isset($data['asignarDesignarPermisosParcial']) && is_array($data['asignarDesignarPermisosParcial']) && isset($data['asignarDesignarPermisosParcial'][0]['tp_perm'])) {
                  $asignarDesignarPermisosParcial = $data['asignarDesignarPermisosParcial'][0]['tp_perm'];
                } else {
                  $asignarDesignarPermisosParcial = '';
                }
                ?>

                <?php
                if (!empty($asignarDesignarPermisosGlobal) || !empty($asignarDesignarPermisosParcial)) {
                ?>
                  <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-block" type="submit">Asignar permiso</button> <!-- Agrega la clase btn-block -->
                    <a class="btn btn-outline-danger btn-block" href="<?php echo BASE_URL ?>Rol">Cancelar</a> <!-- Agrega la clase btn-block -->
                  </div>

                <?php } ?>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var permisos_globales = document.getElementById('permisos_globales');
    permisos_globales.classList.remove('fade');
    permisos_globales.classList.add('show');
  });
</script>
<script src="<?php echo BASE_URL ?>assets/js/modulos/permisos/permisos.js"></script>
<?php include "Views/Templates/footer.php"; ?>