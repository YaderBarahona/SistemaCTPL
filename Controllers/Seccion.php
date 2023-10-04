<?php

class Seccion extends Controller
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
    //pasamos el id_usuario de la sesion
    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Secciones');
    $verificarPermisoParcial = $this->model->verificarPermiso($id_user, 'Mostrar Secciones');

    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto) || !empty($verificarPermisoParcial)) {

      $data['permisoCrearSeccion'] = $this->model->verificarPermiso($id_user, 'Crear Seccion');
      // $reporte = $this->model->verificarPermiso($id_user, 'Reportes Usuario');
      // $data['permisoReporteUsuario'] = $reporte['tp_perm'];
      $data['permisoReporteSeccion'] = $this->model->verificarPermiso($id_user, 'Reportes Secciones');

      //global
      $data['permisoGlobalSeccion'] = $this->model->verificarPermiso($id_user, 'Secciones');

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
    // print_r($this->model->getDNIs());

    $data = $this->model->getSecciones();

    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompletoSeccion = $this->model->verificarPermiso($id_user, 'Secciones');
    $verificarPermisoActualizarSeccion = $this->model->verificarPermiso($id_user, 'Editar Seccion');
    $verificarPermisoEliminarSeccion = $this->model->verificarPermiso($id_user, 'Eliminar Seccion');

    //
    for ($i = 0; $i < count($data); $i++) {

      if ((!empty($verificarPermisoActualizarSeccion) && !empty($verificarPermisoEliminarSeccion)) || !empty($verificarPermisoCompletoSeccion)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-primary" type="button" onClick="{editarSeccion(' . $data[$i]['sec_id'] . ')}"><i class="fas fa-edit"></i></button>
      <button class="btn btn-danger" type="button"  onClick="{eliminarSeccion(' . $data[$i]['sec_id'] . ')}"><i class="fas fa-trash"></i></button>
      </div>';
      } else if (!empty($verificarPermisoActualizarSeccion)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-primary" type="button" onClick="{editarSeccion(' . $data[$i]['sec_id'] . ')}"><i class="fas fa-edit"></i></button>
      </div>';
      } else if (!empty($verificarPermisoEliminarSeccion)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-danger" type="button"  onClick="{eliminarSeccion(' . $data[$i]['sec_id'] . ')}"><i class="fas fa-trash"></i></button>
      </div>';
      } else {
        $data[$i]['acciones'] = '<div>
        <span class="badge badge-info">Usuario sin acciones</span>
        </div>';
      }
    }

    //enviamos la data en json hacia el js
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function postOrUpdateSeccion()
  {

    $sec = $_POST['inputSec'];
    $patron = '/^\d{1,2}-\d{1,2}$/';

    $id = $_POST['id_hidden_seccion'];

    $sec_hidden = $_POST['SEC_hidden'];

    if (empty($sec)) {
      //mensaje hacia el js
      // $msg = "Todos los campos son obligatorios";

      //mensaje hacia el js como array
      $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
    } else {
      //validar patrones
      if (!preg_match($patron, $sec)) {
        $msg = array('msg' => 'No se admiten letras ni caracteres especiales, se permite ingresar de 3 a 5 caracteres y solo puede contener números y debe incluir guion entre los números (1-2 caracteres antes y despues del guion), ingresa una sección válida', 'icono' => 'error');
      } else {
        if ($id == '') {
          $data = $this->model->postSeccion($sec);
          if ($data == "OK") {
            // $msg = "OK";
            // $msg = "Usuario registrado con éxito";

            $msg = array('msg' => '¡Sección registrada con éxito!', 'icono' => 'success');
          } else if ($data == "EXISTE") {
            // $msg = "existe";
            // $msg = "El usuario ya existe";

            $msg = array('msg' => '¡Ya existe una sección con los mismos datos!', 'icono' => 'error');
          } else {
            // $msg = "error";
            // $msg = "Error al registrar el usuario";

            $msg = array('msg' => 'Error al registrar la sección', 'icono' => 'error');
          }
        } else {
          $data = $this->model->updateSeccion($sec, $id, $sec_hidden);
          if ($data == "MODIFICADO") {
            // $msg = "MODIFICADO";
            // $msg = "Usuario registrado con éxito";

            $msg = array('msg' => '¡Seccion modificado con éxito!', 'icono' => 'success');
          } else if ($data == "EXISTE") {
            // $msg = "existe";
            // $msg = "El usuario ya existe";

            $msg = array('msg' => '¡Ya existe una sección con la mismos datos!', 'icono' => 'error');
          } else {
            // $msg = "error";
            // $msg = "Error al modificar el usuario";

            $msg = array('msg' => 'Error al modificar la sección', 'icono' => 'error');
          }
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function getSeccion(int $id)
  {
    // print_r($id);

    $data = $this->model->getSeccion($id);
    // print_r($data);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function deleteSeccion(int $id)
  {
    // print_r($id);
    $data = $this->model->deleteSeccion($id);
    if ($data == "OK") {
      $msg = array('msg' => '¡Seccion eliminada con éxito!', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar la sección', 'icono' => 'error');
    }
    // print_r($data);
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
