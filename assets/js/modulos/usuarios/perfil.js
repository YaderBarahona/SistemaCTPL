//
const frmPerfil = document.getElementById("frmPerfil");
//
const btnEditarSeccion = document.getElementById("btnEditarSeccion");

const inputs = document.querySelectorAll("#frmPerfil input");


document.addEventListener("DOMContentLoaded", () => {

  // const url = BASE_URL + "Usuario/getPerfil/" + id;
  // //peticion ajax
  // const http = new XMLHttpRequest();
  // //abrimos la conexion
  // //por metodo post y enviamos la url y true para especificar que es de forma asincrona
  // http.open("GET", url, true);
  // //enviamos la peticion con el formdata
  // http.send();
  // //onreadystatechange para verificar cada vez que cambie el readyState (status code)
  // http.onreadystatechange = function () {
  //   //verificamos el estado del status code
  //   // 4 y 200 respuesta lista
  //   if (this.readyState == 4 && this.status == 200) {
  //     //respuesta del servidor
  //     // console.log(this.responseText);

  //     const res = JSON.parse(this.responseText);

  //     document.getElementById("id_hidden").value = res.us_id;
  //     document.getElementById("USUARIO_HIDDEN").value = res.nom_us;
  //     document.getElementById("CORREO_HIDDEN").value = res.cor_us;
  //   }
  // };

  const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{5,30}$/,
    correo:
      /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+[a-zA-Z0-9-]{1,61}[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{2,63}$/,
    // password:
    //   /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,100}$/,
  };

  const campos = {
    usuario: false,
    correo: false,
    // password: false,
  };

  const validarFormulario = (e) => {
    switch (e.target.name) {
      case "inputUsuario":
        validarCampo(expresiones.usuario, e.target, "usuario");
        break;
      case "inputCorreo":
        validarCampo(expresiones.correo, e.target, "correo");
        break;
      // case "inputPassword":
      //   validarCampo(expresiones.password, e.target, "nueva");
      //   validarPassword();
      //   break;
      // case "inputConfirmPassword":
      //   validarPassword();
      //   break;
    }
  };

  const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
      document
        .getElementById(`grupo__${campo}`)
        .classList.remove("formulario__grupo-incorrecto");
      document
        .getElementById(`grupo__${campo}`)
        .classList.add("formulario__grupo-correcto");
      document
        .querySelector(`#grupo__${campo} svg`)
        .classList.add("fa-check-circle");
      document
        .querySelector(`#grupo__${campo} svg`)
        .classList.remove("fa-times-circle");
      document
        .querySelector(`#grupo__${campo} .formulario__input-error`)
        .classList.remove("formulario__input-error-activo");
      campos[campo] = true;
    } else {
      document
        .getElementById(`grupo__${campo}`)
        .classList.add("formulario__grupo-incorrecto");
      document
        .getElementById(`grupo__${campo}`)
        .classList.remove("formulario__grupo-correcto");

      console.log(document.querySelector(`#grupo__${campo} `));

      document
        .querySelector(`#grupo__${campo} svg`)
        .classList.add("fa-times-circle");
      document
        .querySelector(`#grupo__${campo} svg`)
        .classList.remove("fa-check-circle");
      document
        .querySelector(`#grupo__${campo} .formulario__input-error`)
        .classList.add("formulario__input-error-activo");
      campos[campo] = false;
    }
  };

  // const validarPassword = () => {
  //   const inputPassword1 = document.getElementById("inputPassword");
  //   const inputPassword2 = document.getElementById("inputConfirmPassword");

  //   if (inputPassword1.value !== inputPassword2.value) {
  //     document
  //       .getElementById(`grupo__confirmar`)
  //       .classList.add("formulario__grupo-incorrecto");
  //     document
  //       .getElementById(`grupo__confirmar`)
  //       .classList.remove("formulario__grupo-correcto");
  //     document
  //       .querySelector(`#grupo__confirmar svg`)
  //       .classList.add("fa-times-circle");
  //     document
  //       .querySelector(`#grupo__confirmar svg`)
  //       .classList.remove("fa-check-circle");
  //     document
  //       .querySelector(`#grupo__confirmar .formulario__input-error`)
  //       .classList.add("formulario__input-error-activo");
  //     campos["password"] = false;
  //   } else {
  //     document
  //       .getElementById(`grupo__confirmar`)
  //       .classList.remove("formulario__grupo-incorrecto");
  //     document
  //       .getElementById(`grupo__confirmar`)
  //       .classList.add("formulario__grupo-correcto");
  //     document
  //       .querySelector(`#grupo__confirmar svg`)
  //       .classList.remove("fa-times-circle");
  //     document
  //       .querySelector(`#grupo__confirmar svg`)
  //       .classList.add("fa-check-circle");
  //     document
  //       .querySelector(`#grupo__confirmar .formulario__input-error`)
  //       .classList.remove("formulario__input-error-activo");
  //     campos["password"] = true;
  //   }
  // };

  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });
});

frmPerfil.addEventListener("submit", (e) => {
  e.preventDefault();

  //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
  const url = BASE_URL + "Usuario/updatePerfil";
  //peticion ajax
  const http = new XMLHttpRequest();
  //abrimos la conexion
  //por metodo post y enviamos la url y true para especificar que es de forma asincrona
  http.open("POST", url, true);
  //enviamos la peticion con el formdata
  http.send(new FormData(frmPerfil));
  //onreadystatechange para verificar cada vez que cambie el readyState (status code)
  http.onreadystatechange = function () {
    //verificamos el estado del status code
    // 4 y 200 respuesta lista
    if (this.readyState == 4 && this.status == 200) {
      //mostramos la respuesta de msg en consola
      console.log(this.responseText);

      //parseamos el msg
      const res = JSON.parse(this.responseText);

    if (res == "EXISTE_USUARIO") {
      alerta("¡El nombre de usuario ya existe!, por favor digita uno diferente", "", "warning");
    } else if (res == "EXISTE_CORREO") {
      alerta("¡El correo ya existe asociado a un usuario!, por favor digita uno diferente", "", "warning");
    } else if (res == "MODIFICADO") {
      alerta("¡Perfil actualizado con éxito!", "", "success");
      document
          .querySelectorAll(".formulario__grupo-correcto")
          .forEach((icono) => {
            icono.classList.remove("formulario__grupo-correcto");
          });
        setTimeout(() => {
          window.location.reload();
        }, 3000);
    } else {
      alerta("Error", "", "error");
    }
    
  };
};
});


const btnCambiarPass = document.getElementById("btnCambiarPass");
const btnCancelPass = document.getElementById("btnModal2");
const frmCambiarPass = document.getElementById("frmCambiarPass");

const inputP = document.querySelectorAll("#frmCambiarPass input");

const modal = document.getElementById('CambiarPass');

const expresionP = {
  password:
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,100}$/,
};

const campoP = {
  password: false,
};

const validarFormularioP = (e) => {
  switch (e.target.name) {
    // case "passActual":
    //   validarCampo(expresiones.password, e.target, "actual");
    //   break;
    case "passNueva":
      validarCampoP(expresionP.password, e.target, "pass1");
      validarPassword2();
      break;
    case "passConfirm":
      validarPassword2();
      break;
  }
};

const validarCampoP = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__${campo} svg`)
      .classList.add("fa-check-circle");
    document
      .querySelector(`#grupo__${campo} svg`)
      .classList.remove("fa-times-circle");
    document
      .querySelector(`#grupo__${campo} .formulario__input-error`)
      .classList.remove("formulario__input-error-activo");
    campoP[campo] = true;
  } else {
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__${campo} svg`)
      .classList.add("fa-times-circle");
    document
      .querySelector(`#grupo__${campo} svg`)
      .classList.remove("fa-check-circle");
    document
      .querySelector(`#grupo__${campo} .formulario__input-error`)
      .classList.add("formulario__input-error-activo");
    campoP[campo] = false;
  }
};

const validarPassword2 = () => {
  const inputPassword1 = document.getElementById("passNueva");
  const inputPassword2 = document.getElementById("passConfirm");

  if (inputPassword1.value !== inputPassword2.value) {
    document
      .getElementById(`grupo__pass2`)
      .classList.add("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__pass2`)
      .classList.remove("formulario__grupo-correcto");
    document.querySelector(`#grupo__pass2 svg`).classList.add("fa-times-circle");
    document
      .querySelector(`#grupo__pass2 svg`)
      .classList.remove("fa-check-circle");
    document
      .querySelector(`#grupo__pass2 .formulario__input-error`)
      .classList.add("formulario__input-error-activo");
    campoP["password"] = false;
  } else {
    document
      .getElementById(`grupo__pass2`)
      .classList.remove("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__pass2`)
      .classList.add("formulario__grupo-correcto");
    document
      .querySelector(`#grupo__pass2 svg`)
      .classList.remove("fa-times-circle");
    document.querySelector(`#grupo__pass2 svg`).classList.add("fa-check-circle");
    document
      .querySelector(`#grupo__pass2 .formulario__input-error`)
      .classList.remove("formulario__input-error-activo");
    campoP["password"] = true;
  }
};

inputP.forEach((input) => {
  input.addEventListener("keyup", validarFormularioP);
  input.addEventListener("blur", validarFormularioP);
});

btnCancelPass.addEventListener("click", () => {
  document.querySelectorAll(".formulario__grupo-correcto").forEach((icono) => {
    icono.classList.remove("formulario__grupo-correcto");
  });

  document
    .querySelectorAll(".formulario__grupo-incorrecto")
    .forEach((icono) => {
      icono.classList.remove("formulario__grupo-incorrecto");
    });

  document
    .getElementById("formulario__mensaje")
    .classList.remove("formulario__mensaje-activo");

  document
    .querySelector(`#grupo__pass1 .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");
  document
    .querySelector(`#grupo__pass2 .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

    frmCambiarPass.reset();
  $("#cambiarPass").modal("hide");
});

btnCambiarPass.addEventListener("click", () => {
  $("#CambiarPass").modal("show");
});

frmCambiarPass.addEventListener("submit", (e) => {
  // if (campoP.password) {
  //   frm.reset();

  //   document
  //     .querySelectorAll(".formulario__grupo-correcto")
  //     .forEach((icono) => {
  //       icono.classList.remove("formulario__grupo-correcto");
  //     });
  // } else {
  //   document
  //     .getElementById("formulario__mensaje")
  //     .classList.add("formulario__mensaje-activo");
  // }

  e.preventDefault();
  const passActual = document.getElementById("passActual").value;
  const passNueva = document.getElementById("passNueva").value;
  const passConfirm = document.getElementById("passConfirm").value;

  if (passActual == "" || passNueva == "" || passConfirm == "") {
    document
      .getElementById("formulario__mensaje")
      .classList.add("formulario__mensaje-activo");
    setTimeout(() => {
      document
        .getElementById("formulario__mensaje")
        .classList.remove("formulario__mensaje-activo");
    }, 5000);

    alerta("Todos los campos son obligatorios", "", "warning");

    // return false;
  } else {
    if (passNueva != passConfirm) {
      alerta(
        "La contraseña nueva no coincide con el campo de confirmación",
        "",
        "error"
      );
      // return false;
    } else {
      //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
      const url = BASE_URL + "Usuario/updatePassword";
      //peticion ajax
      const http = new XMLHttpRequest();
      //abrimos la conexion
      //por metodo post y enviamos la url y true para especificar que es de forma asincrona
      http.open("POST", url, true);
      //enviamos la peticion con el formdata
      http.send(new FormData(frmCambiarPass));
      //onreadystatechange para verificar cada vez que cambie el readyState (status code)
      http.onreadystatechange = function () {
        //verificamos el estado del status code
        // 4 y 200 respuesta lista
        if (this.readyState == 4 && this.status == 200) {
          //mostramos la respuesta de msg en consola
          console.log(this.responseText);

          //parseamos el msg
          const res = JSON.parse(this.responseText);
          // verificamos si la espuesta es OK
          if (res == "OK") {
            alerta("¡Contraseña actualizada con éxito!", "", "success");
            document
              .querySelectorAll(".formulario__grupo-correcto")
              .forEach((icono) => {
                icono.classList.remove("formulario__grupo-correcto");
              });
              frmCambiarPass.reset();
              $('#CambiarPass').modal('hide');
              setTimeout(() => {
                window.location.reload();
              }, 1000);

          } else if (res == "ERROR1") {
            alerta(
              "La contraseña nueva no coincide con el campo de confirmación",
              "",
              "error"
            );
          } else if (res == "ERROR2") {
            alerta("Error al actualizar contraseña", "", "error");
            document
              .getElementById("formulario__mensaje")
              .classList.add("formulario__mensaje-activo");
          } else {
            alerta("Contraseña actual incorrecta", "", "error");
          }
        }
      };
    }
  }
});

// btnCancelPass.addEventListener("click", () => {
//   frm.reset();
//   $("#cambiarPass").modal("hide");
// });
