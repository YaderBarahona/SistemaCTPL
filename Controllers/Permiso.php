<?php

class Permiso extends Controller
{

  public function __construct()
  {
    //inicializamos la sesion
    session_start();

    //cargamos constructor de la instancia (de la vista)
    parent::__construct();
  }

  //metodo index para mostrar la vista
  public function index($id)
  {
    //verificamos si la sesion esta iniciada
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL);
    }

    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Permisos');
    $verificarPermisoParcial = $this->model->verificarPermiso($id_user, 'Mostrar Permisos');

    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto) || !empty($verificarPermisoParcial)) {

      //pasar con el nombre de 'datos' al array de la variable $data hacia la vista
      $data['datos'] = $this->model->getPermisosCompletos();
      $data['permisosParcialesUsuario'] = $this->model->getPermisosParcialesUsuario();
      $data['permisosParcialesRoles'] = $this->model->getPermisosParcialesRoles();
      $data['permisosParcialesPermisos'] = $this->model->getPermisosParcialesPermisos();
      $data['permisosParcialesEstudiantes'] = $this->model->getPermisosParcialesEstudiantes();
      $data['permisosParcialesSecciones'] = $this->model->getPermisosParcialesSecciones();
      $data['permisosParcialesAsistencias'] = $this->model->getPermisosParcialesAsistencias();

      $data['asignarDesignarPermisosGlobal'] =
        $this->model->verificarPermiso($id_user, 'Permisos');
      $data['asignarDesignarPermisosParcial'] =
        $this->model->verificarPermiso($id_user, 'Asignar/Designar Permisos');


      //obtener los permisos activos del usuario
      $permisos = $this->model->getDetallePermiso($id);

      //verificar los permisos asignados
      $data['asignados'] = array();

      //recorremos los permisos
      foreach ($permisos as $permiso) {
        //si existe asignamos true
        //añadimos los permisos al array de asignados
        $data['asignados'][$permiso['perm_id']] = true;
      }

      //id del rol mediante $data
      $data['rol_id'] = $id;

      //accedemos a views y al metodo getview
      //pasando por parametros el controlador y el nombre de la vista
      //pasamos la variable data a la vista
      $this->views->getView($this, "index", $data);
    } else {
      header('Location: ' . BASE_URL . 'Errors/forbidden');
    }
  }

  public function registrarPermiso()
  {
    // vemos que trae el metodo POST
    // print_r($_POST);

    //recuperamos por medio del metodo POST el id_usuario del name del input hidden
    $id_rol = $_POST['rol_id'];

    //almacenamos el DELETE para eliminar los permisos del usuario que viene del metodo del modelo 
    $eliminar = $this->model->deletePermiso($id_rol);

    $msg = "";

    if ($eliminar == "ELIMINADO") {

      if (isset($_POST['permisos'])) {
        //recorremos el array de permisos
        foreach ($_POST['permisos'] as $id_permiso) {
          $msg = $this->model->postRolPermiso($id_rol, $id_permiso);
        }
        if ($msg == "OK") {
          $msg = array("msg" => "¡Permiso(s) asignado(s) con éxito!", "icono" => "success");
        } else {
          $msg = array("msg" => "Error al asignar los permisos", "icono" => "error");
        }
      } else {

        // $msg = $this->model->deletePermiso($id_rol);
        $msg = array("msg" => "Permisos designados", "icono" => "info");
        // $msg = "";
      }
    } else {
      $msg = array("msg" => "Error al eliminar los permisos anteriores", "icono" => "error");
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
  }
}
