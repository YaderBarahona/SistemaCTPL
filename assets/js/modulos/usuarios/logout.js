const btnLogout = document.getElementById("btnLogout");

btnLogout.addEventListener("click", function () {
  //peticion ajax
  const http = new XMLHttpRequest();
  const url = BASE_URL + "Log/postLog2";
  //abrimos la conexion
  //por metodo post y enviamos la url y true para especificar que es de forma asincrona
  http.open("POST", url, true);
  http.send();
  //onreadystatechange para verificar cada vez que cambie el readyState (status code)
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //mostramos la respuesta de msg en consola
      console.log(this.responseText);

      //parseamos el msg
      const res = JSON.parse(this.responseText);
    }
  };
});
