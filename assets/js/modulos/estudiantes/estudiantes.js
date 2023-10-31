//
let tblEstudiantes;

const btnNuevoEstudiante = document.getElementById("btnNuevoEstudiante");

//
const frmEstudiante = document.getElementById("frmEstudiante");
const btnModal = document.getElementById("btnModal");
const btnModal2 = document.getElementById("btnModal2");
//
const btnEditarEstudiante = document.getElementById("btnEditarEstudiante");
const btnEliminarEstudiante = document.getElementById("btnEliminarEstudiante");

document.addEventListener("DOMContentLoaded", () => {
  let defaultDatatableLeng = localStorage.getItem("datatableLeng");
  let permisoReporteEstudiante = document.getElementById(
    "permisoReporteEstudiante"
  ).value;
  // console.log(mostrarBotonesReportes);
  let permisoGlobalEstudiante = document.getElementById(
    "permisoGlobalEstudiante"
  ).value;

  let buttons = [];

  if (permisoReporteEstudiante != "" || permisoGlobalEstudiante != "") {
    buttons.push(
      {
        extend: "excelHtml5",
        footer: true,
        title: "Reporte de estudiantes",
        filename: "Reporte de estudiantes",

        text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>',
      },
      {
        extend: "pdfHtml5",
        //text: "Save as PDF",
        //tipo de hoja del pdf
        orientation: "landscape",
        download: "open",
        footer: true,
        title: "Reporte de estudiantes",
        filename: "Reporte de estudiantes",
        text: '<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5],
        },
      },
      {
        extend: "copyHtml5",
        footer: true,
        title: "Reporte de estudiantes",
        filename: "Reporte de estudiantes",
        text: '<span class="badge  bg-primary"><i class="fas fa-copy"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5],
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
  tblEstudiantes = $("#tblEstudiantes").DataTable({
    ajax: {
      url: BASE_URL + "Estudiante/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "est_id",
      },
      {
        data: "ced_est",
      },
      {
        data: "nom_est",
      },
      {
        data: "pa_est",
      },
      {
        data: "sa_est",
      },
      {
        //numero de la seccion
        data: "num_sec",
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
btnNuevoEstudiante.addEventListener("click", () => {
  let defaultLang = localStorage.getItem("lang");

  //labels
  // Obtener el texto del Label
  let labelTextCed = document.querySelector('label[for="inputCed"]').innerText;
  let labelTextNombre = document.querySelector(
    'label[for="inputNombre"]'
  ).innerText;
  let labelTextPa = document.querySelector('label[for="inputPa"]').innerText;
  let labelTextSa = document.querySelector('label[for="inputSa"]').innerText;

  if (defaultLang == "es") {
    document.getElementById("title_modal").innerHTML = "Nuevo Estudiante";
    document.getElementById("btnModal").innerHTML = "Agregar";
    document
      .getElementById("inputCed")
      .setAttribute("placeholder", labelTextCed);
    document
      .getElementById("inputNombre")
      .setAttribute("placeholder", labelTextNombre);
    document.getElementById("inputPa").setAttribute("placeholder", labelTextPa);

    document.getElementById("inputSa").setAttribute("placeholder", labelTextSa);
  } else {
    document.getElementById("title_modal").innerHTML = "New Student";
    document.getElementById("btnModal").innerHTML = "Add";
    document
      .getElementById("inputCed")
      .setAttribute("placeholder", labelTextCed);
    document
      .getElementById("inputNombre")
      .setAttribute("placeholder", labelTextNombre);
    document.getElementById("inputPa").setAttribute("placeholder", labelTextPa);

    document.getElementById("inputSa").setAttribute("placeholder", labelTextSa);
  }

  document.getElementById("frmEstudiante").reset();
  //jquery
  //abrir modal mediante el id del modal para agregar usuario
  $("#nuevo_estudiante").modal("show");
  //limpiar id
  document.getElementById("id_hidden_estudiante").value = "";
});

const formulario = document.getElementById("frmEstudiante");
const inputs = document.querySelectorAll("#frmEstudiante input");

const expresiones = {
  cedula: /^[a-zA-Z0-9\_\-]{8,15}$/, // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,30}$/, // Letras y espacios, pueden llevar acentos.
  ap1: /^[a-zA-ZÀ-ÿ\s]{1,30}$/, //
  ap2: /^[a-zA-ZÀ-ÿ\s]{1,30}$/,
};

const campos = {
  cedula: false,
  nombre: false,
  ap1: false,
  ap2: false,
  // seccion: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "inputCed":
      validarCampo(expresiones.cedula, e.target, "cedula");
      break;
    case "inputNombre":
      validarCampo(expresiones.nombre, e.target, "nombre");
      break;
    case "inputPa":
      validarCampo(expresiones.ap1, e.target, "apellido1");
      break;
    case "inputSa":
      validarCampo(expresiones.ap2, e.target, "apellido2");
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
    .querySelector(`#grupo__cedula .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");
  document
    .querySelector(`#grupo__nombre .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  document
    .querySelector(`#grupo__apellido1 .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  document
    .querySelector(`#grupo__apellido2 .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");

  frmEstudiante.reset();
  $("#nuevo_estudiante").modal("hide");
});

//evento de submit del formulario
frmEstudiante.addEventListener("submit", (e) => {
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

  const cedula = document.getElementById("inputCed");
  const nombre = document.getElementById("inputNombre");
  const primer_apellido = document.getElementById("inputPa");
  const segundo_apellido = document.getElementById("inputSa");
  const seccion = document.getElementById("selectSec");

  //validacion de campos vacios de forma global
  //pendiente hacer validacion para alerta para cada campo
  if (
    cedula.value == "" ||
    nombre.value == "" ||
    primer_apellido.value == "" ||
    segundo_apellido.value == "" ||
    seccion.value == ""
  ) {
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
    const url = BASE_URL + "Estudiante/postOrUpdateEstudiante";
    const frm = document.getElementById("frmEstudiante");
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

        if (res.msg == "Las contraseñas no coinciden") {
          alerta(res.msg, "", res.icono);
        } else if (res.msg == "¡Ya existe un estudiante con la misma cédula!") {
          alerta(res.msg, "", res.icono);
        } else if (res.msg == "¡Estudiante registrado con éxito!") {
          frm.reset();
          alerta(res.msg, "", res.icono);
          $("#nuevo_usuario").modal("hide");
          tblEstudiantes.ajax.reload();
          document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
              icono.classList.remove("formulario__grupo-correcto");
            });
        } else if (res.msg == "¡Estudiante modificado con éxito!") {
          frm.reset();
          alerta(res.msg, "", res.icono);
          $("#nuevo_usuario").modal("hide");
          tblEstudiantes.ajax.reload();
          document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
              icono.classList.remove("formulario__grupo-correcto");
            });
        } else {
          alerta(res.msg, "", res.icono);
        }
      }
    };
  }
});

//funcion para el backend en el controlador
const EditarEstudiante = (id) => {
  // let id = btnEditarEstudiante.getAttribute("id_est");

  document.getElementById("title_modal").innerHTML = "Actualizar estudiante";
  btnModal.innerHTML = "Actualizar";
  //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
  const url = BASE_URL + "Estudiante/getEstudiante/" + id;
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

      document.getElementById("id_hidden_estudiante").value = res.est_id;
      document.getElementById("CED_hidden").value = res.ced_est;

      //traemos el valor de cada campo
      document.getElementById("inputCed").value = res.ced_est;
      document.getElementById("inputNombre").value = res.nom_est;
      document.getElementById("inputPa").value = res.pa_est;
      document.getElementById("inputSa").value = res.sa_est;
      document.getElementById("selectSec").value = res.sec_id;

      $("#nuevo_estudiante").modal("show");
    }
  };
};

const eliminarEstudiante = (id) => {
  // alert(id);
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
      const url = BASE_URL + "Estudiante/deleteEstudiante/" + id;
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

          tblEstudiantes.ajax.reload();
        }
      };
    }
  });
};

// btnEliminarEstudiante.addEventListener("click", eliminarEstudiante());
