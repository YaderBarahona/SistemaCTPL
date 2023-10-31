<?php
class UsuarioModel extends Query
{
  private  $usuario,  $correo,  $password, $id, $estado, $selectRol;
  private $fecha_creacion, $fecha_actualizacion;
  private $token, $expira, $email, $hashed;
  private $USUARIO_HIDDEN, $CORREO_HIDDEN;

  public function __construct()
  {
    //cargar constructor de la clase query
    parent::__construct();
  }

  public function getUsuario(string $user, string $password)
  {
    $sql = "SELECT us_id, nom_us, con_us, cor_us, activo, rol_id FROM usuarios WHERE nom_us = '$user' AND con_us = '$password' AND activo = 1";
    $data = $this->select($sql);
    return $data;
  }

  public function getEstado(string $user)
  {
    $sql = "SELECT nom_us, activo FROM usuarios WHERE nom_us = '$user' AND activo = 1";
    $data = $this->select($sql);
    return $data;
  }


  public function getUsuarios()
  {
    $sql = "SELECT u.us_id, u.nom_us, u.cor_us, u.activo, u.fec_cr_us, u.fec_act_us, u.rol_id, r.rol_id, r.tp_rol FROM usuarios u INNER JOIN roles r WHERE u.rol_id = r.rol_id";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getRoles()
  {
    $sql = "SELECT rol_id, tp_rol FROM roles";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function insertarUsuario(string $usuario, string $correo, string $password, int $selectRol)
  {
    $this->usuario = $usuario;
    $this->correo = $correo;
    $this->password = $password;
    $this->selectRol = $selectRol;

    date_default_timezone_set('America/Costa_Rica');
    $this->fecha_creacion = date('Y-m-d h:i:s');
    $this->fecha_actualizacion = date('Y-m-d h:i:s');

    // print_r($this->fecha_creacion);

    //select para verificar si el nombre de usuario ya existe
    $verificarUsuario = "SELECT nom_us FROM usuarios WHERE nom_us = '$this->usuario'";
    $verificarCorreo = "SELECT cor_us FROM usuarios WHERE  cor_us = '$this->correo'";

    $existeUsuario = $this->select($verificarUsuario);
    $existeCorreo = $this->select($verificarCorreo);

    if (!empty($existeUsuario)) {
      $res = "EXISTE_USUARIO";
     } else if(!empty($existeCorreo)){
      $res = "EXISTE_CORREO";
      } else {
        $sql = "INSERT INTO usuarios(nom_us, con_us, cor_us, activo, fec_cr_us, fec_act_us, rol_id) 
        VALUES (?,?,?,?,?,?,?)";
        $datos = array($this->usuario, $this->password, $this->correo, 1, $this->fecha_creacion, $this->fecha_actualizacion, $this->selectRol);
        $data = $this->save($sql, $datos);
  
        if ($data == 1) {
          $res = "OK";
        } else {
          $res = "ERROR";
        }
      }

    return $res;
  }

  public function actualizarUsuario(int $id)
  {
    $sql = "SELECT us_id, nom_us, con_us, cor_us, activo, fec_cr_us, fec_act_us, rol_id FROM usuarios WHERE us_id = $id";
    $data = $this->select($sql);

    return $data;
  }

  public function actualizarUsuario2(string $usuario, string $correo, int $id, int $selectRol, string $NOMBRE_HIDDEN, string $CORREO_HIDDEN)
  {
    $this->usuario = $usuario;
    $this->correo = $correo;
    $this->selectRol = $selectRol;
    $this->USUARIO_HIDDEN = $NOMBRE_HIDDEN;
    $this->CORREO_HIDDEN = $CORREO_HIDDEN;


    date_default_timezone_set('America/Costa_Rica');
    $this->fecha_actualizacion = date('Y-m-d h:i:s');

    $this->id = $id;

    //select para verificar si el nombre de usuario ya existe
    $verificarUsuario = "SELECT nom_us FROM usuarios WHERE nom_us = '$this->usuario' AND nom_us <> '$this->USUARIO_HIDDEN'";
    $verificarCorreo = "SELECT cor_us FROM usuarios WHERE cor_us = '$this->correo' AND cor_us <> '$this->CORREO_HIDDEN'";
    
    $existeUsuario = $this->select($verificarUsuario);
    $existeCorreo = $this->select($verificarCorreo);

    if (!empty($existeUsuario)) {
    $res = "EXISTE_USUARIO";
  } else if (!empty($existeCorreo)){
    $res = "EXISTE_CORREO";
  } else {
    $sql = "UPDATE usuarios SET nom_us = ?, cor_us = ?, fec_act_us = ?, rol_id = ? WHERE us_id = ?";
    $datos = array($this->usuario, $this->correo, $this->fecha_actualizacion,  $this->selectRol, $this->id);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
      $res = "MODIFICADO";
    } else {
      $res = "ERROR";
    }
  }
    return $res;
  }

  function deleteUsuario(int $id)
  {
    $this->id = $id;
    $sql = "DELETE from usuarios WHERE us_id = ?";
    $datos = array($id);
    $data = $this->save($sql, $datos);

    //el metodo save retorna 1 en caso de insercion o eliminacion
    if ($data == 1) {
      $res = "OK";
    } else {
      $res = "ERROR";
    }

    return $res;
  }


  function accionUsuario(int $estado, int $id)
  {
    $this->estado = $estado;
    $this->id = $id;
    $sql = "UPDATE usuarios SET activo = ? WHERE us_id = ?";
    //mandamos en el array los parametros dinamicos
    $datos = array($this->estado, $this->id);
    $data = $this->save($sql, $datos);

    return $data;
  }

  function desactivarUsuario(int $id)
  {
    $this->id = $id;
    $sql = "UPDATE usuarios SET activo = 0 WHERE us_id = ?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);

    return $data;
  }

  function activarUsuario(int $id)
  {
    $this->id = $id;
    $sql = "UPDATE usuarios SET activo = 1 WHERE us_id = ?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);

    return $data;
  }

  function getPass(string $pass, int $id)
  {
    $sql = "SELECT us_id, con_us FROM usuarios WHERE con_us = '$pass' AND us_id = $id";
    $data = $this->select($sql);

    return $data;
  }

  function actualizarPass(string $pass, int $id)
  {
    $sql = "UPDATE usuarios SET con_us = ? WHERE us_id = ?";
    $datos = array($pass, $id);
    $data = $this->save($sql, $datos);

    return $data;
  }

  public function verificarPermiso(int $id_user, string $nombre_permiso)
  {
    $sql = "SELECT p.perm_id, p.tp_perm, 
          rp.rol_id, 
          r.tp_rol
          FROM permisos p 
          INNER JOIN roles_permisos rp ON p.perm_id = rp.perm_id
          INNER JOIN roles r ON rp.rol_id = r.rol_id
          INNER JOIN usuarios u ON u.rol_id = r.rol_id
          WHERE u.us_id = $id_user AND p.tp_perm = '$nombre_permiso'";
    $data = $this->selectAll($sql);
    return $data;
  }

  function verificarCorreo($email)
  {
    $sql = "SELECT cor_us FROM usuarios WHERE cor_us = '$email'";
    $data = $this->select($sql);
    return $data;
  }

  public function guardarToken($email, $token, $expira)
  {
    $this->token = $token;
    $this->expira = $expira;
    $this->email = $email;

    $sql = "UPDATE usuarios SET token = ?, expira = ? WHERE cor_us = ?";
    // $sql = "UPDATE usuarios SET token = '$token', expira = '$expira' WHERE cor_us = '$email'";
    $datos = array($this->token, $this->expira, $this->email);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
      return true;
    } else {
      return false;
    }
  }


  public function verificarToken($email, $token)
  {
    $consulta = "SELECT token, expira FROM usuarios WHERE cor_us = '$email'";
    $resultado = $this->select($consulta);

    if ($resultado) {
      $tokenGuardado = $resultado['token'];
      $expira = strtotime($resultado['expira']);

      if ($token === $tokenGuardado && $expira < time()) {
        // El token es válido y no ha expirado
        return true;
      }
    }

    // El token no es válido o ha expirado
    return false;
  }

  public function updatePassword($email, $password)
  {
    //
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_password = hash("SHA256", $password);

    $this->hashed = $hashed_password;
    $this->email = $email;

    $sql = "UPDATE usuarios SET con_us = ?, token = ?, expira = ? WHERE cor_us = ?";
    $datos = array($this->hashed, null, null, $this->email);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
      $res = "MODIFICADO";
    } else {
      $res = "ERROR";
    }

    return $res;
  }

  public function getPerfil($id_usuario)
  {
    $sql = "SELECT us_id, u.nom_us, con_us, u.cor_us, u.activo, u.fec_cr_us, u.fec_act_us, u.rol_id, r.rol_id, r.tp_rol 
    FROM usuarios u INNER JOIN roles r ON u.rol_id = r.rol_id
    WHERE us_id = $id_usuario AND activo = 1";
    $data = $this->select($sql);
    return $data;
  }


  public function updatePerfil(string $usuario, string $correo, int $id, string $NOMBRE_HIDDEN, string $CORREO_HIDDEN)
  {
    $this->usuario = $usuario;
    $this->correo = $correo;
    $this->USUARIO_HIDDEN = $NOMBRE_HIDDEN;
    $this->CORREO_HIDDEN = $CORREO_HIDDEN;


    date_default_timezone_set('America/Costa_Rica');
    $this->fecha_actualizacion = date('Y-m-d h:i:s');

    $this->id = $id;

    //select para verificar si el nombre de usuario ya existe
    $verificarUsuario = "SELECT nom_us FROM usuarios WHERE nom_us = '$this->usuario' AND nom_us <> '$this->USUARIO_HIDDEN'";
    $verificarCorreo = "SELECT cor_us FROM usuarios WHERE cor_us = '$this->correo' AND cor_us <> '$this->CORREO_HIDDEN'";
    
    $existeUsuario = $this->select($verificarUsuario);
    $existeCorreo = $this->select($verificarCorreo);

    if (!empty($existeUsuario)) {
    $res = "EXISTE_USUARIO";
  } else if (!empty($existeCorreo)){
    $res = "EXISTE_CORREO";
  } else {
    $sql = "UPDATE usuarios SET nom_us = ?, cor_us = ?, fec_act_us = ? WHERE us_id = ?";
    $datos = array($this->usuario, $this->correo, $this->fecha_actualizacion, $this->id);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
      $res = "MODIFICADO";
    } else {
      $res = "ERROR";
    }
  }
    return $res;
  }
}
