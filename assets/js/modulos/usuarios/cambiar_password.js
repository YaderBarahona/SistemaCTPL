const btnCancelPass = document.getElementById("btnCancelPass");
const frm = document.getElementById("frmCambiarPass");

const inputP = document.querySelectorAll("#frmCambiarPass input");

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
      .querySelector(`#grupo__${campo} i`)
      .classList.add("fa-check-circle");
    document
      .querySelector(`#grupo__${campo} i`)
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
      .querySelector(`#grupo__${campo} i`)
      .classList.add("fa-times-circle");
    document
      .querySelector(`#grupo__${campo} i`)
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
    document.querySelector(`#grupo__pass2 i`).classList.add("fa-times-circle");
    document
      .querySelector(`#grupo__pass2 i`)
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
      .querySelector(`#grupo__pass2 i`)
      .classList.remove("fa-times-circle");
    document.querySelector(`#grupo__pass2 i`).classList.add("fa-check-circle");
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

  frm.reset();
  $("#cambiarPass").modal("hide");
});

frm.addEventListener("submit", (e) => {
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

    alerta("Todos los campos son obligatorios", "error");

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
      http.send(new FormData(frm));
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
            frm.reset();
            $("#cambiarPass").modal("hide");
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

btnCancelPass.addEventListener("click", () => {
  frm.reset();
  $("#cambiarPass").modal("hide");
});
