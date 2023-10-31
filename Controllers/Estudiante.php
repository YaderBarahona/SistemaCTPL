<?php

class Estudiante extends Controller
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

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Estudiantes');
    $verificarPermisoParcial = $this->model->verificarPermiso($id_user, 'Mostrar Estudiantes');

    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto) || !empty($verificarPermisoParcial)) {
      $data['seccion'] = $this->model->getSecciones();

      $data['permisoCrearEstudiante'] = $this->model->verificarPermiso($id_user, 'Crear Estudiante');
      // $reporte = $this->model->verificarPermiso($id_user, 'Reportes Usuario');
      // $data['permisoReporteUsuario'] = $reporte['tp_perm'];
      $data['permisoReporteEstudiante'] = $this->model->verificarPermiso($id_user, 'Reportes Estudiantes');

      //global
      $data['permisoGlobalEstudiante'] = $this->model->verificarPermiso($id_user, 'Estudiantes');

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

    $data = $this->model->getEstudiantes();

    $id_user = $_SESSION['id_usuario'];

    //permisos especificos
    $verificarPermisoCompletoEstudiante = $this->model->verificarPermiso($id_user, 'Estudiantes');
    $verificarPermisoActualizarEstudiante = $this->model->verificarPermiso($id_user, 'Editar Estudiante');
    $verificarPermisoEliminarEstudiante = $this->model->verificarPermiso($id_user, 'Eliminar Estudiante');

    //
    for ($i = 0; $i < count($data); $i++) {

      if ((!empty($verificarPermisoActualizarEstudiante) && !empty($verificarPermisoEliminarEstudiante)) || !empty($verificarPermisoCompletoEstudiante)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-primary" type="button" onClick="{EditarEstudiante(' . $data[$i]['est_id'] . ')}"><i class="fas fa-user-edit"></i></button>
      <button class="btn btn-danger" type="button"  onClick="{eliminarEstudiante(' . $data[$i]['est_id'] . ')}"><i class="fas fa-trash"></i></button>
      </div>';
      } else if (!empty($verificarPermisoActualizarEstudiante)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-primary" type="button" onClick="{EditarEstudiante(' . $data[$i]['est_id'] . ')}"><i class="fas fa-user-edit"></i></button>
      </div>';
      } else if (!empty($verificarPermisoEliminarEstudiante)) {
        $data[$i]['acciones'] = '<div>
      <button class="btn btn-danger" type="button"  onClick="{eliminarEstudiante(' . $data[$i]['est_id'] . ')}"><i class="fas fa-trash"></i></button>
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

  public function postOrUpdateEstudiante()
  {

    $ced = $_POST['inputCed'];
    $patron_ced = '/^[a-zA-Z0-9-]{8,15}$/';

    $nombre = $_POST['inputNombre'];
    $patron_nom = '/^[a-zA-ZÀ-ÿ\s]{1,30}$/u';

    $pa = $_POST['inputPa'];
    $patron_pa = '/^[a-zA-ZÀ-ÿ\s]{1,30}$/u';

    $sa = $_POST['inputSa'];
    $patron_sa = '/^[a-zA-ZÀ-ÿ\s]{1,30}$/u';

    $seccion = $_POST['selectSec'];

    $id = $_POST['id_hidden_estudiante'];

    $ced_hidden = $_POST['CED_hidden'];

    if (empty($ced) || empty($nombre) || empty($pa) || empty($sa) || empty($seccion)) {
      //mensaje hacia el js
      // $msg = "Todos los campos son obligatorios";

      //mensaje hacia el js como array
      $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
    } else {
      //validar patrones
      if (!preg_match($patron_ced, $ced)) {
        $msg = array('msg' => 'No se admiten caracteres especiales y el máximo de caracteres es de 15, ingresa una cédula válida', 'icono' => 'error');
      } else if (!preg_match($patron_nom, $nombre)) {
        $msg = array('msg' => 'No se admiten números ni caracteres especiales y el máximo de caracteres es de 30, ingresa un nombre válido', 'icono' => 'error');
      } else if (!preg_match($patron_pa, $pa)) {
        $msg = array('msg' => 'No se admiten números ni caracteres especiales y el máximo de caracteres es de 30, ingresa un apellido válido', 'icono' => 'error');
      } else if (!preg_match($patron_sa, $sa)) {
        $msg = array('msg' => 'No se admiten números ni caracteres especiales y el máximo de caracteres es de 30, ingresa un apellido válido', 'icono' => 'error');
      } else {
        if ($id == '') {
          $data = $this->model->postEstudiante($ced, $nombre, $pa, $sa, $seccion);
          if ($data == "OK") {
            $msg = array('msg' => '¡Estudiante registrado con éxito!', 'icono' => 'success');
          } else if ($data == "EXISTE") {
            $msg = array('msg' => '¡Ya existe un estudiante con la misma cédula!', 'icono' => 'error');
          } else {
            $msg = array('msg' => 'Error al registrar el estudiante', 'icono' => 'error');
          }
        } else {
          $data = $this->model->updateEstudiante($ced, $nombre, $pa, $sa, $seccion, $id, $ced_hidden);
          if ($data == "MODIFICADO") {
            $msg = array('msg' => '¡Estudiante modificado con éxito!', 'icono' => 'success');
          } else if ($data == "EXISTE") {
            $msg = array('msg' => '¡Ya existe un estudiante con la misma cédula!', 'icono' => 'error');
          } else {
            $msg = array('msg' => 'Error al modificar el estudiante', 'icono' => 'error');
          }
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function getEstudiante(int $id)
  {
    // print_r($id);

    $data = $this->model->getEstudiante($id);
    // print_r($data);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function deleteEstudiante(int $id)
  {
    // print_r($id);
    $data = $this->model->deleteEstudiante($id);
    if ($data == "OK") {
      $msg = array('msg' => '¡Estudiante eliminado con éxito!', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar el estudiante', 'icono' => 'error');
    }
    // print_r($data);
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
