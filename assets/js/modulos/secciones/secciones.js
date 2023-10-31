//
let tblSecciones;

const btnNuevaSeccion = document.getElementById("btnNuevaSeccion");

//
const frmSeccion = document.getElementById("frmSeccion");
const btnModal = document.getElementById("btnModal");
const btnModal2 = document.getElementById("btnModal2");
//
const btnEditarSeccion = document.getElementById("btnEditarSeccion");
const btnEliminarSeccion = document.getElementById("btnEliminarSeccion");

document.addEventListener("DOMContentLoaded", () => {
  let defaultDatatableLeng = localStorage.getItem("datatableLeng");
  let permisoReporteSeccion = document.getElementById(
    "permisoReporteSeccion"
  ).value;
  // console.log(mostrarBotonesReportes);
  let permisoGlobalSeccion = document.getElementById(
    "permisoGlobalSeccion"
  ).value;

  let buttons = [
    // ... otros botones ...
  ];

  if (permisoReporteSeccion != "" || permisoGlobalSeccion != "") {
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
          columns: [0, 1],
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
          columns: [0, 1],
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

  tblSecciones = $("#tblSecciones").DataTable({
    ajax: {
      url: BASE_URL + "Seccion/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "sec_id",
      },
      {
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
      searchPlaceholder: "Sección o ID",
    },
    buttons: buttons,
    responsive: true,
    order: [[0, "asc"]],
  });
});

//evento al darle click al boton de nuevo en la vista estudiante
btnNuevaSeccion.addEventListener("click", () => {
  let defaultLang = localStorage.getItem("lang");

  //labels
  // Obtener el texto del Label
  let labelTextSection = document.querySelector(
    'label[for="inputSec"]'
  ).innerText;

  if (defaultLang == "es") {
    document.getElementById("title_modal").innerHTML = "Nueva sección";
    btnModal.innerHTML = "Agregar";
    document
      .getElementById("inputSec")
      .setAttribute("placeholder", labelTextSection);
  } else {
    document.getElementById("title_modal").innerHTML = "New Section";
    btnModal.innerHTML = "Add";
    document
      .getElementById("inputSec")
      .setAttribute("placeholder", labelTextSection);
  }

  frmSeccion.reset();
  //jquery
  //abrir modal mediante el id del modal para agregar usuario
  $("#nueva_seccion").modal("show");
  //limpiar id
  document.getElementById("id_hidden_seccion").value = "";
});

const inputs = document.querySelectorAll("#frmSeccion input");

const expresiones = {
  seccion: /^\d{1,2}-\d{1,2}$/,
};

const campos = {
  seccion: false,
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "inputSec":
      validarCampo(expresiones.seccion, e.target, "seccion");
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
    .querySelector(`#grupo__seccion .formulario__input-error`)
    .classList.remove("formulario__input-error-activo");
  document;

  frmSeccion.reset();
  $("#nueva_seccion").modal("hide");
});

//evento de submit del formulario
frmSeccion.addEventListener("submit", (e) => {
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

  const seccion = document.getElementById("inputSec");

  //validacion de campos vacios de forma global
  //pendiente hacer validacion para alerta para cada campo
  if (seccion.value == "") {
    //quitamos clase bst al input
    // password.classList.remove("is-invalid");
    //agregamos clase bst al input
    // user.classList.add("is-invalid");
    //posicionamos el cursor en el input

    alerta("El campo Sección es obligatorio", "", "error");
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
    const url = BASE_URL + "Seccion/postOrUpdateSeccion";
    const frm = document.getElementById("frmSeccion");
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

        if (res.msg == "¡Ya existe una sección con los mismos datos!") {
          alerta(res.msg, "", res.icono);
        } else if (res.msg == "¡Sección registrada con éxito!") {
          frm.reset();
          alerta(res.msg, "", res.icono);
          $("#nueva_seccion").modal("hide");
          tblSecciones.ajax.reload();
          document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
              icono.classList.remove("formulario__grupo-correcto");
            });
        } else if (res.msg == "¡Sección modificada con éxito!") {
          frm.reset();
          alerta(res.msg, "", res.icono);
          $("#nueva_seccion").modal("hide");
          tblSecciones.ajax.reload();
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
const editarSeccion = (id) => {
  // let id = btnEditarEstudiante.getAttribute("id_est");

  document.getElementById("title_modal").innerHTML = "Actualizar sección";
  btnModal.innerHTML = "Actualizar";
  //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
  const url = BASE_URL + "Seccion/getSeccion/" + id;
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

      document.getElementById("id_hidden_seccion").value = res.sec_id;
      document.getElementById("SEC_hidden").value = res.num_sec;

      //traemos el valor de cada campo
      document.getElementById("inputSec").value = res.num_sec;

      $("#nueva_seccion").modal("show");
    }
  };
};

const eliminarSeccion = (id) => {
  // alert(id);
  Swal.fire({
    title: "¿Estas seguro de eliminar esta sección?",
    text: "La sección se eliminará de forma permanente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar.",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      //guardamos el base_url del archivo index.php y concatenamos el controlador y el metodo
      const url = BASE_URL + "Seccion/deleteSeccion/" + id;
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

          tblSecciones.ajax.reload();
        }
      };
    }
  });
};
