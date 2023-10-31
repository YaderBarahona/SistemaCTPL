<?php

class Rol extends Controller
{

  public function __construct()
  {
    //inicializamos la sesion
    session_start();

    //verificamos si la sesion esta iniciada
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL);
    }

    //cargamos constructor de la instancia (de la vista)
    parent::__construct();
  }

  //metodo index para mostrar la vista
  public function index()
  {

    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Roles');
    $verificarPermisoParcial = $this->model->verificarPermiso($id_user, 'Mostrar Roles');

    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto) || !empty($verificarPermisoParcial)) {

      //parcial
      $data['permisoCrearRol'] = $this->model->verificarPermiso($id_user, 'Crear Rol');

      //reportes (datatable)
      $data['permisoReporteRol'] = $this->model->verificarPermiso($id_user, 'Reportes Roles');

      //global
      $data['permisoGlobalRol'] = $this->model->verificarPermiso($id_user, 'Roles');

      //accedemos a views y al metodo getview
      //pasando por parametros el controlador y el nombre de la vista
      //pasamos la variable data a la vista
      $this->views->getView($this, "index", $data);
    } else {
      header('Location: ' . BASE_URL . 'Errors/forbidden');
    }
  }

  public function listar()
  {
    // print_r($this->model->getUsuarios());

    $data = $this->model->getRoles();

    $id_user = $_SESSION['id_usuario'];

    //permisos especificos
    $verificarPermisoCompletoRol = $this->model->verificarPermiso($id_user, 'Roles');
    $verificarPermisoActualizarRol = $this->model->verificarPermiso($id_user, 'Editar Rol');
    $verificarPermisoEliminarRol = $this->model->verificarPermiso($id_user, 'Eliminar Rol');
    $verificarPermisoMostrarPermisos = $this->model->verificarPermiso($id_user, 'Mostrar Permisos');

    //
    for ($i = 0; $i < count($data); $i++) {

      if ((!empty($verificarPermisoActualizarRol) && !empty($verificarPermisoEliminarRol) && !empty($verificarPermisoMostrarPermisos)) || !empty($verificarPermisoCompletoRol)) {
        $data[$i]['acciones'] = '<div>
      <a class="btn btn-dark" href="' . BASE_URL . 'Permiso/index/' . $data[$i]['rol_id'] . '"><i class="fas fa-key"></i></a>
      <button class="btn btn-primary" type="button" onClick="{editarRol(' . $data[$i]['rol_id'] . ')}"><i class="fas fa-user-edit"></i></button>
      <button class="btn btn-danger" type="button"  onClick="{eliminarRol(' . $data[$i]['rol_id'] . ')}"><i class="fas fa-trash"></i></button>
      </div>';
      } else if (!empty($verificarPermisoMostrarPermisos)) {
        $data[$i]['acciones'] = '<div>
      <a class="btn btn-dark" href="' . BASE_URL . 'Permiso/index/' . $data[$i]['rol_id'] . '"><i class="fas fa-key"></i></a>
      </div>';
      } else if (!empty($verificarPermisoActualizarRol)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-primary" type="button" onClick="{editarRol(' . $data[$i]['rol_id'] . ')}"><i class="fas fa-user-edit"></i></button>    
      </div>';
      } else if (!empty($verificarPermisoEliminarRol)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-danger" type="button"  onClick="{eliminarRol(' . $data[$i]['rol_id'] . ')}"><i class="fas fa-trash"></i></button>
      </div>';
      } else {
        $data[$i]['acciones'] = '<div>
        <span class="badge bg-info">Usuario sin acciones</span>
        </div>';
      }
    }

    //enviamos la data en json hacia el js
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function postOrUpdateRol()
  {
    $tipoRol = $_POST['inputTipoRol'];
    $patron_tipo = '/^[a-zA-ZÀ-ÿ\s\_\-]{1,30}$/u';

    $descripcion = $_POST['inputDescripcion'];
    $patron_descripcion = '/^[a-zA-ZÀ-ÿ\s\_\-\,\.]{1,100}$/u';

    $id = $_POST['id_rol_hidden'];

    $tipoRolHidden = $_POST['tipo_rol_hidden'];

    if (empty($tipoRol) || empty($descripcion)) {
      //mensaje hacia el js
      // $msg = "Todos los campos son obligatorios";

      //mensaje hacia el js como array
      $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
    } else {
      //validar patrones

      if (!preg_match($patron_tipo, $tipoRol)) {
        $msg = array('msg' => 'No se admiten caracteres especiales y el máximo de caracteres es de 30, ingresa un tipo de rol válido', 'icono' => 'error');
      } else if (!preg_match($patron_descripcion, $descripcion)) {

        $msg = array('msg' => 'No se admiten números ni caracteres especiales y el máximo de caracteres es de 100, ingresa una descripción válida', 'icono' => 'error');
      } else {
        if ($id == '') {
          $data = $this->model->postRol($tipoRol, $descripcion);
          if ($data == "OK") {
            // $msg = "OK";
            // $msg = "Usuario registrado con éxito";

            $msg = array('msg' => 'Rol registrado con éxito!', 'icono' => 'success');
          } else if ($data == "EXISTE") {
            // $msg = "existe";
            // $msg = "El usuario ya existe";

            $msg = array('msg' => '¡Ya existe un rol con el mismo tipo de rol!', 'icono' => 'error');
          } else {
            // $msg = "error";
            // $msg = "Error al registrar el usuario";

            $msg = array('msg' => 'Error al registrar el rol', 'icono' => 'error');
          }
        } else {
          $data = $this->model->updateRol($tipoRol, $descripcion, $id, $tipoRolHidden);
          if ($data == "MODIFICADO") {
            // $msg = "MODIFICADO";
            // $msg = "Usuario registrado con éxito";

            $msg = array('msg' => '¡Rol modificado con éxito!', 'icono' => 'success');
          } else if ($data == "EXISTE") {
            // $msg = "existe";
            // $msg = "El usuario ya existe";

            $msg = array('msg' => '¡Ya existe un rol con el mismo tipo de rol!', 'icono' => 'error');
          } else {
            // $msg = "error";
            // $msg = "Error al modificar el usuario";

            $msg = array('msg' => 'Error al modificar el rol', 'icono' => 'error');
          }
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function getRol(int $id)
  {
    // print_r($id);

    $data = $this->model->getRol($id);
    // print_r($data);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function deleteRol(int $id)
  {
    // print_r($id);
    $data = $this->model->deleteRol($id);
    if ($data == "OK") {
      $msg = array('msg' => 'Rol eliminado con éxito!', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar el rol', 'icono' => 'error');
    }
    // print_r($data);
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
