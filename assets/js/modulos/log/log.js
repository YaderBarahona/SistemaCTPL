let tblRegistro;

document.addEventListener("DOMContentLoaded", () => {
  let defaultDatatableLeng = localStorage.getItem("datatableLeng");
  // console.log(mostrarBotonesReportes);
  let permisoGlobalRegistro = document.getElementById(
    "permisoGlobalRegistro"
  ).value;

  let buttons = [];

  if (permisoGlobalRegistro != "") {
    buttons.push(
      {
        extend: "excelHtml5",
        footer: true,
        title: "Reporte de asistencias",
        filename: "Reporte de asistencias",

        text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>',
      },
      {
        extend: "pdfHtml5",
        //text: "Save as PDF",
        //tipo de hoja del pdf
        orientation: "landscape",
        download: "open",
        footer: true,
        title: "Reporte de asistencias",
        filename: "Reporte de asistencias",
        text: '<span class="badge  bg-danger"><i class="fas fa-file-pdf"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6],
        },
      },
      {
        extend: "copyHtml5",
        footer: true,
        title: "Reporte de asistencias",
        filename: "Reporte de asistencias",
        text: '<span class="badge  bg-primary"><i class="fas fa-copy"></i></span>',
        // exportOptions: {
        //   columns: [0, ":visible"],
        // },
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6],
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
  tblRegistro = $("#tblRegistro").DataTable({
    ajax: {
      url: BASE_URL + "Log/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "registro_id",
      },
      {
        data: "usuario",
      },
      {
        data: "tipo_acceso",
      },
      {
        data: "navegador",
      },
      {
        data: "direccion_ip",
      },
      {
        data: "fecha",
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
