async function mostrarAlertas() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  await new Promise((resolve) => {
    // Agregar una pequeña espera para asegurarse de que la animación termine
    setTimeout(() => {
      resolve();
    }, 3000); // Puedes ajustar este tiempo según lo necesites
  });

  await Toast.fire({
    title: "¡Datos de ingreso correctos!",
    icon: "success",
  });

  let timerInterval;
  await Swal.fire({
    title: "Redireccionando al panel..",
    html: "Estaremos dentro en <b></b> milisegundos..",
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
      const b = Swal.getHtmlContainer().querySelector("b");
      timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft();
      }, 100);
    },
    willClose: () => {
      clearInterval(timerInterval);
    },
  });

  //redireccionamos hacia la vista mediante el base_url y el principal (por defecto a index)
  window.location = BASE_URL + "Principal";
}

async function mostrarAlertas2(title1, title2, text) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  await new Promise((resolve) => {
    // Agregar una pequeña espera para asegurarse de que la animación termine
    setTimeout(() => {
      resolve();
    }, 3000); // Puedes ajustar este tiempo según lo necesites
  });

  await Toast.fire({
    title: title1,
    icon: "success",
  });

  await Swal.fire({
    position: "center",
    title: title2,
    text: text,
    icon: "success",
    showConfirmButton: true,
    confirmButtonColor: "#4e73df",
    timer: 5000,
  });

  //redireccionamos hacia la vista mediante el base_url y el principal (por defecto a index)
  window.location = BASE_URL + "Principal";
}

function shakeForm() {
  // Devolver una promesa que se resolverá después de completar el efecto "shake"
  return new Promise((resolve) => {
    $("#frmLogin").effect("shake", { times: 2 }, 800, resolve);
  });
}

function frmLogin(e) {
  e.preventDefault();

  const user = document.getElementById("inputUser");
  const password = document.getElementById("inputPassword");

  //validacion de campos vacios
  if (user.value == "") {
    //quitamos clase bst al input
    password.classList.remove("is-invalid");
    //agregamos clase bst al input
    user.classList.add("is-invalid");
    //posicionamos el cursor en el input
    user.focus();

    $("#frmLogin").effect("shake");

    alerta(
      "El campo usuario es requerido, por favor digite un usuario válido",
      "",
      "warning"
    );
  } else if (password.value == "") {
    user.classList.remove("is-invalid");
    password.classList.add("is-invalid");
    password.focus();
    $("#frmLogin").effect("shake");
    alerta(
      "El campo contraseña es requerido, por favor digite una contraseña válida",
      "",
      "warning"
    );
  } else {
    //Añadimos la imagen de carga en el contenedor
    // $("#content").html(
    //   '<div class="loading"><img src="http://localhost/sistema_CTPL/Assets/img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>'
    // );

    // $("#btnLogin").html(
    //   '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' +
    //     '<span class="visually-hidden">Loading...</span>' +
    //     "Validando datos"
    // );
    // $("#btnLogin").attr("disabled", "disabled");

    // Antes de enviar la petición AJAX
    //     const btnLogin = document.getElementById("btnLogin"); // Reemplaza con el ID de tu botón

    //     // Agregar el efecto de "cargando" antes de enviar la petición AJAX
    //     const loadingSpinner = `
    //   <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    //   <span class="visually-hidden">Loading...</span>
    //   Validando datos
    // `;

    //     btnLogin.innerHTML = loadingSpinner;
    //     btnLogin.disabled = true; // Deshabilitar el botón

    const btnLogin = document.getElementById("btnLogin");

    btnLogin.classList.add("loading");

    //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
    const url = BASE_URL + "Usuario/validar";
    const frm = document.getElementById("frmLogin");
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
        // Eliminar el efecto de "cargando"
        // $("#content").html("");
        // $("#btnLogin").removeAttr("disabled");

        // setTimeout(function () {
        //   $("#content").html("");
        //   $("#btnLogin").removeAttr("disabled");
        // }, 3000);

        setTimeout(function () {
          btnLogin.classList.remove("loading"); // Remueve la clase "loading" del botón
        }, 3000);

        //mostramos la respuesta de msg en consola
        console.log(this.responseText);

        //parseamos el msg
        const res = JSON.parse(this.responseText);

        if (res == "OK") {
          mostrarAlertas();
        } else if (res == "ERROR") {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "El usuario no existe o se encuentra desactivado",
                "",
                "error"
              );
            });
          }, 3000);
        } else {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "Contraseña incorrecta",
                "Por favor digita la contraseña correcta",
                "error"
              );
            });
          }, 3000);
          // document.getElementById("alerta").classList.remove("d-none");
          // document.getElementById("alerta").innerHTML = res;
        }
      }
    };
  }
}

function frmEnviarCorreo(e) {
  e.preventDefault();

  const correo = document.getElementById("inputCorreo");

  //validacion de campos vacios
  if (correo.value == "") {
    //quitamos clase bst al input
    password.classList.remove("is-invalid");
    //agregamos clase bst al input
    user.classList.add("is-invalid");
    //posicionamos el cursor en el input
    user.focus();

    $("#frmRecuperar").effect("shake");

    alerta(
      "El campo correo electrónico es requerido, por favor digite un correo electrónico válido",
      "",
      "warning"
    );
  } else {
    const btnLogin = document.getElementById("btnLogin");

    btnLogin.classList.add("loading");

    //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
    const url = BASE_URL + "Usuario/enviarCorreo";
    const frm = document.getElementById("frmLogin");
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
        setTimeout(function () {
          btnLogin.classList.remove("loading"); // Remueve la clase "loading" del botón
        }, 3000);

        //mostramos la respuesta de msg como json en consola
        console.log(this.responseText);

        // Agrega esta línea para imprimir la respuesta sin analizarla como JSON
        console.log("Response as plain text:", this.responseText);

        //parseamos el msg
        // const res = JSON.parse(this.responseText);

        if (this.responseText.includes("INVALIDO")) {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "Error",
                "El correo digitado no se encuentra registrado, por favor digita un correo electrónico que se encuentre asociado a tu cuenta.",
                "error"
              );
            });
          }, 3000);
        } else if (this.responseText.includes("OK")) {
          mostrarAlertas2(
            "¡Correo electrónico válido!",
            "¡Correo electrónico enviado con éxito!",
            "Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña."
          );
        } else if (this.responseText.includes("ERROR1")) {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "Error",
                "El campo correo es requerido, por favor rellene este campo.",
                "warning"
              );
            });
          }, 3000);
        } else if (this.responseText.includes("ERROR2")) {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "Error",
                "El correo eléctronico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba '@' seguido del dominio y por ultimo una extensión (.com,.co,etc).",
                "error"
              );
            });
          }, 3000);
        } else if (this.responseText.includes("ERROR3")) {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "Error",
                "Hubo un error al enviar el correo electrónico. Por favor, intenta de nuevo más tarde.",
                "error"
              );
            });
          }, 3000);
        } else {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "Error",
                "Hubo un error al guardar el token. Por favor, intenta de nuevo más tarde.",
                "error"
              );
            });
          }, 3000);
          // document.getElementById("alerta").classList.remove("d-none");
          // document.getElementById("alerta").innerHTML = res;
        }
      }
    };
  }
}

function frmRecuperarPassword(e) {
  e.preventDefault();

  const password = document.getElementById("inputPass");

  //validacion de campos vacios
  if (password.value == "") {
    user.classList.remove("is-invalid");
    password.classList.add("is-invalid");
    password.focus();
    $("#frmLogin").effect("shake");
    alerta(
      "El campo contraseña es requerido, por favor digite una contraseña válida",
      "",
      "warning"
    );
  } else {
    const btnLogin = document.getElementById("btnLogin");

    btnLogin.classList.add("loading");

    //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
    const url = BASE_URL + "Usuario/recuperarPassword";
    const frm = document.getElementById("frmLogin");
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
        setTimeout(function () {
          btnLogin.classList.remove("loading"); // Remueve la clase "loading" del botón
        }, 3000);

        //mostramos la respuesta de msg en consola
        console.log(this.responseText);

        // Agrega esta línea para imprimir la respuesta sin analizarla como JSON
        // console.log("Response as plain text:", this.responseText);

        //parseamos el msg
        const res = JSON.parse(this.responseText);

        if (res == "OK") {
          mostrarAlertas2(
            "¡Contraseña actualizada correctamente!",
            "¡Contraseña actualizada correctamente!",
            "Ya puedes iniciar sesión con la nueva contraseña"
          );
        } else if (res == "ERROR1") {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta("Patron invalido", "", "error");
            });
          }, 3000);
        } else if (res == "ERROR2") {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta("Error al actualizar contraseña", "", "error");
            });
          }, 3000);
          // document.getElementById("alerta").classList.remove("d-none");
          //  document.getElementById("alerta").innerHTML = res;
        } else {
          setTimeout(function () {
            shakeForm().then(() => {
              alerta(
                "Token inválido o expirado. Por favor, solicita un nuevo enlace de recuperación de contraseña.",
                "",
                "error"
              );
            });
          }, 3000);
        }
      }
    };
  }
}
