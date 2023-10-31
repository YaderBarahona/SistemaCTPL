document.addEventListener("DOMContentLoaded", function () {
  var dt = $("#miTabla").DataTable();

  // Agrega un botón de exportación a Word
  var exportButton = document.getElementById("exportarWord");
  exportButton.addEventListener("click", function () {
    var tableData = dt.buttons.exportData();
    var header = dt
      .columns()
      .header()
      .toArray()
      .map(function (th) {
        return th.innerText;
      });

    var rows = [];
    tableData.body.forEach(function (row) {
      rows.push(row);
    });

    var content = [header].concat(rows);

    var doc = new jsPDF();
    doc.autoTable({
      head: content.slice(0, 1),
      body: content.slice(1),
    });

    doc.save("exported_data.pdf");
  });
});
