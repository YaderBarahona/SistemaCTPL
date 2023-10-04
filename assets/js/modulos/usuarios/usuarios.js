//
let tblUsuarios;

const frmUsuario = document.getElementById("frmUsuario");

const btnModal2 = document.getElementById("btnModal2");

const inputs = document.querySelectorAll("#frmUsuario input");

document.addEventListener("DOMContentLoaded", () => {
  let permisoReporteUsuario = document.getElementById(
    "permisoReporteUsuario"
  ).value;
  // console.log(mostrarBotonesReportes);
  let permisoGlobalUsuario = document.getElementById(
    "permisoGlobalUsuario"
  ).value;

  let buttons = [
    // ... otros botones ...
  ];

  if (permisoReporteUsuario != "" || permisoGlobalUsuario != "") {
    buttons.push(
      {
        //Botón para Excel
        extend: "excelHtml5",
        footer: true,
        title: "Reporte de usuarios",
        filename: "Reporte de usuarios",

        //Aquí es donde generas el botón personalizado
        text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>',
      },
      //Botón para PDF
      {
        extend: "pdfHtml5",
        //text: "Save as PDF",
        //tipo de hoja del pdf
        orientation: "landscape",
        download: "open",
        footer: true,
        title: "Reporte de usuarios",
        filename: "Reporte de usuarios",
        text: '<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6],
        },
      },
      //Botón para copiar
      {
        extend: "copyHtml5",
        footer: true,
        title: "Reporte de usuarios",
        filename: "Reporte de usuarios",
        text: '<span class="badge  bg-primary"><i class="fas fa-copy"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6],
        },
      },
      //Botón para print
      {
        extend: "print",
        footer: true,
        filename: "Export_File_print",
        text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',
      },
      //Botón para cvs
      {
        extend: "csvHtml5",
        footer: true,
        filename: "Export_File_csv",
        text: '<span class="badge  bg-success"><i class="fas fa-file-csv"></i></span>',
      },
      {
        extend: "colvis",
        text: '<span class="badge  bg-info"><i class="fas fa-columns"></i></span>',
        postfixButtons: ["colvisRestore"],
      }
    );
  }

  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: BASE_URL + "Usuario/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "us_id",
      },
      {
        data: "nom_us",
      },
      {
        data: "cor_us",
      },
      {
        data: "activo",
      },
      {
        data: "fec_cr_us",
      },
      {
        data: "fec_act_us",
      },
      {
        data: "tp_rol",
      },
      {
        data: "acciones",
      },
    ],
    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json",
    },
    buttons: buttons,
    responsive: true,
    order: [[0, "asc"]],
  });

  //
  const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{5,30}$/,
    // correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{8,100}$/,
    correo:
      /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+[a-zA-Z0-9-]{1,61}[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{2,63}$/,
    password:
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,100}$/,
  };

  const campos = {
    usuario: false,
    correo: false,
    password: false,
  };

  const validarFormulario = (e) => {
    switch (e.target.name) {
      case "inputUsuario":
        validarCampo(expresiones.usuario, e.target, "usuario");
        break;
      case "inputCorreo":
        validarCampo(expresiones.correo, e.target, "correo");
        break;
      case "inputPassword":
        validarCampo(expresiones.password, e.target, "nueva");
        validarPassword();
        break;
      case "inputConfirmPassword":
        validarPassword();
        break;
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

  // const validarCampo = (expresion, input, campo) => {
  //   const grupoCampo = document.getElementById(`grupo__${campo}`);
  //   const icono = grupoCampo.querySelector("svg");

  //   if (expresion.test(input.value)) {
  //     grupoCampo.classList.remove("formulario__grupo-incorrecto");
  //     grupoCampo.classList.add("formulario__grupo-correcto");

  //     // Agregar clase para icono correcto
  //     icono.classList.add("fa-solid", "fa-circle-check");
  //     icono.classList.remove("fa-solid", "fa-circle-xmark");

  //     grupoCampo
  //       .querySelector(".formulario__input-error")
  //       .classList.remove("formulario__input-error-activo");

  //     campos[campo] = true;
  //   } else {
  //     grupoCampo.classList.add("formulario__grupo-incorrecto");
  //     grupoCampo.classList.remove("formulario__grupo-correcto");

  //     // Agregar clase para icono incorrecto
  //     icono.classList.add("fa-solid", "fa-circle-xmark");
  //     icono.classList.remove("fa-solid", "fa-circle-check");

  //     grupoCampo
  //       .querySelector(".formulario__input-error")
  //       .classList.add("formulario__input-error-activo");

  //     campos[campo] = false;
  //   }
  // };

  const validarPassword = () => {
    const inputPassword1 = document.getElementById("inputPassword");
    const inputPassword2 = document.getElementById("inputConfirmPassword");

    if (inputPassword1.value !== inputPassword2.value) {
      document
        .getElementById(`grupo__confirmar`)
        .classList.add("formulario__grupo-incorrecto");
      document
        .getElementById(`grupo__confirmar`)
        .classList.remove("formulario__grupo-correcto");
      document
        .querySelector(`#grupo__confirmar svg`)
        .classList.add("fa-times-circle");
      document
        .querySelector(`#grupo__confirmar svg`)
        .classList.remove("fa-check-circle");
      document
        .querySelector(`#grupo__confirmar .formulario__input-error`)
        .classList.add("formulario__input-error-activo");
      campos["password"] = false;
    } else {
      document
        .getElementById(`grupo__confirmar`)
        .classList.remove("formulario__grupo-incorrecto");
      document
        .getElementById(`grupo__confirmar`)
        .classList.add("formulario__grupo-correcto");
      document
        .querySelector(`#grupo__confirmar svg`)
        .classList.remove("fa-times-circle");
      document
        .querySelector(`#grupo__confirmar svg`)
        .classList.add("fa-check-circle");
      document
        .querySelector(`#grupo__confirmar .formulario__input-error`)
        .classList.remove("formulario__input-error-activo");
      campos["password"] = true;
    }
  };

  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });
});

//evento al darle al boton de cancelar
btnModal2.addEventListener("click", () => {
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
    .querySelector(`#grupo__usuario .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");
  document
    .querySelector(`#grupo__correo .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  document
    .querySelector(`#grupo__nueva .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  document
    .querySelector(`#grupo__confirmar .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  frmUsuario.reset();
  $("#nuevo_usuario").modal("hide");
});

function abrirModal() {
  document.getElementById("title_modal").innerHTML = "Nuevo usuario";
  document.getElementById("btnModal").innerHTML = "Registrar";
  document.getElementById("frmUsuario").reset();
  document.getElementById("contraseñas").classList.remove("d-none");
  //jquery
  //abrir modal mediante el id del modal para agregar usuario
  $("#nuevo_usuario").modal("show");
  //limpiar id
  document.getElementById("id_hidden").value = "";
}

function frmRegistrarUser(e) {
  e.preventDefault();

  const user = document.getElementById("inputUsuario");
  const correo = document.getElementById("inputCorreo");
  const password = document.getElementById("inputPassword");
  const confirmPassword = document.getElementById("inputConfirmPassword");

  //validacion de campos vacios
  if (
    user.value == "" ||
    correo.value == "" ||
    password.value == "" ||
    confirmPassword.value == ""
  ) {
    //quitamos clase bst al input
    // password.classList.remove("is-invalid");
    //agregamos clase bst al input
    // user.classList.add("is-invalid");
    //posicionamos el cursor en el input

    alerta("Todos los campos son obligatorios", "", "error");
    // } else if (password.value != confirmPassword.value) {
    //   // user.classList.remove("is-invalid");
    //   // password.classList.add("is-invalid");
    //   // password.focus();
    //   Swal.fire({
    //     position: "top-end",
    //     icon: "error",
    //     title: "Las contraseñas no coinciden",
    //     showConfirmButton: false,
    //     timer: 2500,
    //   });
  } else {
    //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
    const url = BASE_URL + "Usuario/registrarUsuario";
    const frm = document.getElementById("frmUsuario");
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
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "success",
            title: "¡Usuario registrado con éxito!",
          });
          frm.reset();
          $("#nuevo_usuario").modal("hide");
          tblUsuarios.ajax.reload();
        } else if (res == "MODIFICADO") {
          alerta("Usuario modificado con éxito!", "", "success");
          $("#nuevo_usuario").modal("hide");
          tblUsuarios.ajax.reload();
        } else {
          alerta("Error", "", "error");
        }
      }
    };
  }
}

function btnEditarUser(id) {
  document.getElementById("title_modal").innerHTML = "Actualizar usuario";
  document.getElementById("btnModal").innerHTML = "Actualizar";
  //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
  const url = BASE_URL + "Usuario/editarUsuario/" + id;
  //peticion ajax
  const http = new XMLHttpRequest();
  //abrimos la conexion
  //por metodo post y enviamos la url y true para especificar que es de forma asincrona
  http.open("GET", url, true);
  //enviamos la peticion con el formdata
  http.send();
  //onreadystatechange para verificar cada vez que cambie el readyState (status code)
  http.onreadystatechange = function () {
    //verificamos el estado del status code
    // 4 y 200 respuesta lista
    if (this.readyState == 4 && this.status == 200) {
      //respuesta del servidor
      // console.log(this.responseText);

      const res = JSON.parse(this.responseText);

      document.getElementById("id_hidden").value = res.us_id;

      document.getElementById("inputUsuario").value = res.nom_us;
      document.getElementById("inputCorreo").value = res.cor_us;
      document.getElementById("inputPassword").value = res.con_us;
      document.getElementById("inputConfirmPassword").value = res.con_us;
      document.getElementById("selectRol").value = res.rol_id;

      //quitando el div row de las contraseñas
      document.getElementById("contraseñas").classList.add("d-none");

      $("#nuevo_usuario").modal("show");
    }
  };
}

function btnEliminarUser(id) {
  // alert(id);
  Swal.fire({
    title: "¿Estas seguro de eliminar este usuario?",
    text: "El usuario se eliminará de forma permanente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar.",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
      const url = BASE_URL + "Usuario/deleteUsuario/" + id;
      //peticion ajax
      const http = new XMLHttpRequest();
      //abrimos la conexion
      //por metodo post y enviamos la url y true para especificar que es de forma asincrona
      http.open("GET", url, true);
      //enviamos la peticion con el formdata
      http.send();
      //onreadystatechange para verificar cada vez que cambie el readyState (status code)
      http.onreadystatechange = function () {
        //verificamos el estado del status code
        // 4 y 200 respuesta lista
        if (this.readyState == 4 && this.status == 200) {
          //respuesta del servidor
          // console.log(this.responseText);

          const res = JSON.parse(this.responseText);

          if (res == "OK") {
            alerta(
              "¡Usuario eliminado!",
              "El usuario ha sido eliminado con éxito",
              "success"
            );
            tblUsuarios.ajax.reload();
          } else {
            alerta("Error", res, "error");
          }
        }
      };
    }
  });
}

function btnDesactivarUser(id) {
  // alert(id);
  Swal.fire({
    title: "¿Estas seguro de desactivar este usuario?",
    text: "El usuario no se eliminará de forma permanente, el estado cambiará a inactivo",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, desactivar.",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
      const url = BASE_URL + "Usuario/desactivarUsuario/" + id;
      //peticion ajax
      const http = new XMLHttpRequest();
      //abrimos la conexion
      //por metodo post y enviamos la url y true para especificar que es de forma asincrona
      http.open("GET", url, true);
      //enviamos la peticion con el formdata
      http.send();
      //onreadystatechange para verificar cada vez que cambie el readyState (status code)
      http.onreadystatechange = function () {
        //verificamos el estado del status code
        // 4 y 200 respuesta lista
        if (this.readyState == 4 && this.status == 200) {
          //respuesta del servidor
          // console.log(this.responseText);

          const res = JSON.parse(this.responseText);

          if (res == "OK") {
            alert(
              "¡Usuario desactivado!",
              "El usuario ha sido desactivo con éxito",
              "success"
            );
            tblUsuarios.ajax.reload();
          } else {
            alerta("Error", res, "error");
          }
        }
      };
    }
  });
}

function btnActivarUser(id) {
  // alert(id);
  Swal.fire({
    title: "¿Estas seguro de reactivar este usuario?",
    text: "El estado del usuario cambiará a activo",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, activar.",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
      const url = BASE_URL + "Usuario/activarUsuario/" + id;
      //peticion ajax
      const http = new XMLHttpRequest();
      //abrimos la conexion
      //por metodo post y enviamos la url y true para especificar que es de forma asincrona
      http.open("GET", url, true);
      //enviamos la peticion con el formdata
      http.send();
      //onreadystatechange para verificar cada vez que cambie el readyState (status code)
      http.onreadystatechange = function () {
        //verificamos el estado del status code
        // 4 y 200 respuesta lista
        if (this.readyState == 4 && this.status == 200) {
          //respuesta del servidor
          console.log(this.responseText);

          const res = JSON.parse(this.responseText);

          if (res == "OK") {
            alerta(
              "¡Usuario activado!",
              "El usuario ha sido reactivado con éxito",
              "success"
            );
            tblUsuarios.ajax.reload();
          } else {
            alerta("Error", res, "error");
          }
        }
      };
    }
  });
}
