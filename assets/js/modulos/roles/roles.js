//
let tblRoles;
// const tblRoless = document.getElementById("tblRoles");

const btnNuevoRol = document.getElementById("btnNuevoRol");

//
const frmRol = document.getElementById("frmRol");
const btnModal = document.getElementById("btnModal");
const btnModal2 = document.getElementById("btnModal2");
//
const btnEditarRol = document.getElementById("btnEditarRol");
const btnEliminarRol = document.getElementById("btnEliminarRol");

document.addEventListener("DOMContentLoaded", () => {
  let defaultDatatableLeng = localStorage.getItem("datatableLeng");
  let permisoReporteRol = document.getElementById("permisoReporteRol").value;
  // console.log(mostrarBotonesReportes);
  let permisoGlobalRol = document.getElementById("permisoGlobalRol").value;

  let buttons = [];

  if (permisoReporteRol != "" || permisoGlobalRol != "") {
    buttons.push(
      {
        extend: "excelHtml5",
        footer: true,
        title: "Reporte de usuarios",
        filename: "Reporte de roles",

        text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>',
      },
      {
        extend: "pdfHtml5",
        //text: "Save as PDF",
        //tipo de hoja del pdf
        orientation: "landscape",
        download: "open",
        footer: true,
        title: "Reporte de roles",
        filename: "Reporte de roles",
        text: '<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2],
        },
      },
      {
        extend: "copyHtml5",
        footer: true,
        title: "Reporte de roles",
        filename: "Reporte de roles",
        text: '<span class="badge  bg-primary"><i class="fas fa-copy"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2],
        },
      },
      {
        extend: "print",
        footer: true,
        filename: "Export_File_print",
        text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',
      },
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
  tblRoles = $("#tblRoles").DataTable({
    ajax: {
      url: BASE_URL + "Rol/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "rol_id",
      },
      {
        data: "tp_rol",
      },
      {
        data: "desc_rol",
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
      url: defaultDatatableLeng,
    },

    buttons: buttons,
    responsive: true,
    order: [[0, "asc"]],
  });
});

//evento al darle click al boton de nuevo en la vista estudiante
btnNuevoRol.addEventListener("click", () => {
  let defaultLang = localStorage.getItem("lang");

  //labels
  // Obtener el texto del Label
  let labelTextRol = document.querySelector(
    'label[for="inputTipoRol"]'
  ).innerText;
  let labelTextDescripcion = document.querySelector(
    'label[for="inputDescripcion"]'
  ).innerText;

  if (defaultLang == "es") {
    document.getElementById("title_modal").innerHTML = "Nuevo Rol";
    document.getElementById("btnModal").innerHTML = "Agregar";
    document
      .getElementById("inputTipoRol")
      .setAttribute("placeholder", labelTextRol);
    document
      .getElementById("inputDescripcion")
      .setAttribute("placeholder", labelTextDescripcion);
  } else {
    document.getElementById("title_modal").innerHTML = "New Rol";
    document.getElementById("btnModal").innerHTML = "Add";
    document
      .getElementById("inputTipoRol")
      .setAttribute("placeholder", labelTextRol);
    document
      .getElementById("inputDescripcion")
      .setAttribute("placeholder", labelTextDescripcion);
  }

  document.getElementById("frmRol").reset();
  //jquery
  //abrir modal mediante el id del modal para agregar usuario
  $("#nuevo_rol").modal("show");
  //limpiar id
  document.getElementById("id_rol_hidden").value = "";
});

const formulario = document.getElementById("frmRol");
const inputs = document.querySelectorAll("#frmRol input");
const textarea = document.querySelectorAll("#frmRol textarea");

const expresiones = {
  tipo: /^[a-zA-ZÀ-ÿ\s\_\-]{1,30}$/, //

  descripcion: /^[a-zA-ZÀ-ÿ\s\_\-\,\.]{1,100}$/,
};

const campos = {
  rol: false,
  descripcion: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "inputTipoRol":
      validarCampo(expresiones.tipo, e.target, "tipo");
      break;
    case "inputDescripcion":
      validarCampo(expresiones.descripcion, e.target, "descripcion");
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

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

textarea.forEach((textarea) => {
  textarea.addEventListener("keyup", validarFormulario);
  textarea.addEventListener("blur", validarFormulario);
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
    .querySelector(`#grupo__tipo .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  document
    .querySelector(`#grupo__descripcion .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  frmRol.reset();
  $("#nuevo_rol").modal("hide");
});

//evento de submit del formulario
frmRol.addEventListener("submit", (e) => {
  e.preventDefault();

  // if (campos.cedula && campos.nombre && campos.ap1 && campos.ap2) {
  //   formulario.reset();
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

  const cedula = document.getElementById("inputTipoRol");
  const nombre = document.getElementById("inputDescripcion");

  //validacion de campos vacios de forma global
  //pendiente hacer validacion para alerta para cada campo
  if (cedula.value == "" || nombre.value == "") {
    //quitamos clase bst al input
    // password.classList.remove("is-invalid");
    //agregamos clase bst al input
    // user.classList.add("is-invalid");
    //posicionamos el cursor en el input

    alerta("Todos los campos son obligatorios", "", "error");
    document
      .getElementById("formulario__mensaje")
      .classList.add("formulario__mensaje-activo");
    setTimeout(() => {
      document
        .getElementById("formulario__mensaje")
        .classList.remove("formulario__mensaje-activo");
    }, 5000);

    // document.getElementById("salida").innerHTML = "Ya se encuentra registrado";

    // } else if (password.value != confirmPassword.value) {
    //   // user.classList.remove("is-invalid");
    //   // password.classList.add("is-invalid");
    //   // password.focus();
  } else {
    //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
    const url = BASE_URL + "Rol/postOrUpdateRol";
    //peticion ajax
    const http = new XMLHttpRequest();
    //abrimos la conexion
    //por metodo post y enviamos la url y true para especificar que es de forma asincrona
    http.open("POST", url, true);
    //enviamos la peticion con el formdata
    http.send(new FormData(frmRol));
    //onreadystatechange para verificar cada vez que cambie el readyState (status code)
    http.onreadystatechange = function () {
      //verificamos el estado del status code
      // 4 y 200 respuesta lista
      if (this.readyState == 4 && this.status == 200) {
        //mostramos la respuesta de msg en consola
        console.log(this.responseText);

        //parseamos el msg
        const res = JSON.parse(this.responseText);

        if (res.msg == "Las contraseñas no coinciden") {
          alerta(res.msg, "", res.icono);
        } else if (res.msg == "¡Ya existe un estudiante con la misma cédula!") {
          alerta(res.msg, "", res.icono);
        } else if (res.msg == "¡Rol registrado con éxito!") {
          frmRol.reset();
          document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
              icono.classList.remove("formulario__grupo-correcto");
            });
          $("#nuevo_rol").modal("hide");
          tblRoles.ajax.reload();
          alerta(res.msg, "", res.icono);
        } else if (res.msg == "¡Rol modificado con éxito!") {
          frmRol.reset();
          document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
              icono.classList.remove("formulario__grupo-correcto");
            });
          $("#nuevo_rol").modal("hide");
          tblRoles.ajax.reload();
          alerta(res.msg, "", res.icono);
        } else {
          alerta(res.msg, "", res.icono);
        }
      }
    };
  }
});

//funcion para el backend en el controlador
const editarRol = (id) => {
  // let id = btnEditarEstudiante.getAttribute("id_est");

  document.getElementById("title_modal").innerHTML = "Actualizar rol";
  btnModal.innerHTML = "Actualizar";
  //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
  const url = BASE_URL + "Rol/getRol/" + id;
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

      document.getElementById("id_rol_hidden").value = res.rol_id;
      document.getElementById("tipo_rol_hidden").value = res.tp_rol;

      //traemos el valor de cada campo
      document.getElementById("inputTipoRol").value = res.tp_rol;
      document.getElementById("inputDescripcion").value = res.desc_rol;

      $("#nuevo_rol").modal("show");
    }
  };
};

const eliminarRol = (id) => {
  alert(id);
  Swal.fire({
    title: "¿Estas seguro de eliminar este estudiante?",
    text: "El estudiante se eliminará de forma permanente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar.",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
      const url = BASE_URL + "Rol/deleteRol/" + id;
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

          alerta(res.msg, "", res.icono);

          tblRoles.ajax.reload();
        }
      };
    }
  });
};
