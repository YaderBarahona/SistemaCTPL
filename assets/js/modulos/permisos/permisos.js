function registrarPermisosGlobales(e) {
  e.preventDefault();

  const url = BASE_URL + "Permiso/registrarPermiso";
  const frm = document.getElementById("frmPermisosGlobales");
  //peticion ajax
  const http = new XMLHttpRequest();
  //abrimos la conexion
  //por metodo post y enviamos la url y true para especificar que es de forma asincrona
  http.open("POST", url, true);
  //enviamos la peticion con el formdata
  http.send(new FormData(frm));
  //onreadystatechange para verificar cada vez que cambie el readyState (status code)
  http.onreadystatechange = function () {
    //verificamos el estado del status code
    // 4 y 200 respuesta lista
    if (this.readyState == 4 && this.status == 200) {
      //respuesta del servidor
      console.log(this.responseText);

      const res = JSON.parse(this.responseText);

      if (res != "") {
        alerta(res.msg, "", res.icono);
      } else if (res == "") {
        alerta(res.msg, "", res.icono);
      } else {
        alerta("Error no identificado", "", "error");
      }
    }
  };
}

function registrarPermisosParciales(e) {
  e.preventDefault();

  const url = BASE_URL + "Permiso/registrarPermiso";
  const frm = document.getElementById("frmPermisosParciales");
  //peticion ajax
  const http = new XMLHttpRequest();
  //abrimos la conexion
  //por metodo post y enviamos la url y true para especificar que es de forma asincrona
  http.open("POST", url, true);
  //enviamos la peticion con el formdata
  http.send(new FormData(frm));
  //onreadystatechange para verificar cada vez que cambie el readyState (status code)
  http.onreadystatechange = function () {
    //verificamos el estado del status code
    // 4 y 200 respuesta lista
    if (this.readyState == 4 && this.status == 200) {
      //respuesta del servidor
      console.log(this.responseText);

      const res = JSON.parse(this.responseText);

      if (res != "") {
        alerta(res.msg, "", res.icono);
      } else {
        alerta("Error no identificado", "", "error");
      }

      // alerta(res.msg, res.icono);
      // tblUsuarios.ajax.reload();
    }
  };
}
