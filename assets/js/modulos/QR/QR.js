document.addEventListener("DOMContentLoaded", function () {
  const video = document.getElementById("videoElement");
  const canvas = document.createElement("canvas");
  const context = canvas.getContext("2d");
  const ced_est = document.getElementById("ced_est");
  const scannerSound = document.getElementById("scannerSound");
  const iniciarEscaneoButton = document.getElementById("iniciarEscaneo");
  const mensajeError = document.getElementById("mensajeError");

  let escaneoActivo = true;

  iniciarEscaneoButton.addEventListener("click", function () {
    mensajeError.style.display = "none";
    iniciarEscaneoButton.style.display = "none";
    escaneoActivo = true;
    iniciarEscaneo();
  });

  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    if (video.srcObject) {
      video.srcObject.getTracks().forEach((track) => track.stop());
    }

    navigator.mediaDevices
      .getUserMedia({ video: true })
      .then((stream) => {
        video.srcObject = stream;
        video.play();
        scanQRCode();
      })
      .catch((err) => {
        console.error("Error al acceder a la cámara: ", err);

        if (err.name === "NotAllowedError") {
          mensajeError.innerText = "No se ha permitido el acceso a la cámara";
          //instrucciones
          //iniciarEscaneoButton.style.display = "block";
        } else if (
          err.name === "NotFoundError" ||
          err.name === "DevicesNotFoundError"
        ) {
          mensajeError.innerText =
            "No se ha encontrado una cámara. ¿Desea volver a intentarlo?";
          iniciarEscaneoButton.style.display = "block";
        } else if (
          err.name === "NotReadableError" ||
          err.name === "TrackStartError"
        ) {
          mensajeError.innerText =
            "No se puede acceder a la cámara. ¿Desea volver a intentarlo?";
          iniciarEscaneoButton.style.display = "block";
        } else if (
          err.name === "OverconstrainedError" ||
          err.name === "ConstraintNotSatisfiedError"
        ) {
          mensajeError.innerText =
            "La configuración de la cámara no es compatible. ¿Desea volver a intentarlo?";
          iniciarEscaneoButton.style.display = "block";
        } else {
          mensajeError.innerText =
            "Se ha producido un error al acceder a la cámara. ¿Desea volver a intentarlo?";
        }
        mensajeError.style.display = "block";
      });
  }

  function scanQRCode() {
    if (escaneoActivo) {
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
      const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
      const code = jsQR(imageData.data, imageData.width, imageData.height);

      if (code) {
        ced_est.value = code.data;

        const url = BASE_URL + "QR/verificarAsistencia";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        http.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);

            if (res === "INGRESADO") {
              Swal.fire({
                title: "¿Estas seguro de volver a ingresar este estudiante?",
                text: "El estudiante ya se ha ingresado el día de hoy",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, ingresar.",
                cancelButtonText: "Cancelar",
              }).then((result) => {
                if (result.isConfirmed) {
                  ced_est.value = code.data;

                  const url = BASE_URL + "QR/registrarAsistencia";
                  const http = new XMLHttpRequest();
                  http.open("POST", url, true);
                  http.setRequestHeader(
                    "Content-Type",
                    "application/x-www-form-urlencoded"
                  );
                  http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                      const res = JSON.parse(this.responseText);
                      if (res === "OK") {
                        scannerSound.play();
                        alerta2("Asistencia registrada con éxito.", "success");
                      } else if (res === "NOEXISTE") {
                        alerta2(
                          "El código QR no coincide con ningún estudiante en la base de datos.",
                          "error"
                        );
                      } else {
                        alerta2("Error al registrar asistencia", "error");
                      }
                    }
                  };
                  http.send("ced_est=" + encodeURIComponent(code.data));

                  escaneoActivo = false;

                  // Pausar 5 segundos antes del siguiente escaneo
                  setTimeout(() => {
                    escaneoActivo = true;
                  }, 5000);
                }
              });
            } else if (res === "NOINGRESADO") {
              ced_est.value = code.data;

              const url = BASE_URL + "QR/registrarAsistencia";
              const http = new XMLHttpRequest();
              http.open("POST", url, true);
              http.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
              );
              http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                  // console.log(this.responseText);
                  const res = JSON.parse(this.responseText);
                  // console.log(res);
                  if (res === "OK") {
                    scannerSound.play();
                    alerta2("Asistencia registrada con éxito.", "success");
                  } else if (res === "NOEXISTE") {
                    alerta2(
                      "El código QR no coincide con ningún estudiante en la base de datos.",
                      "error"
                    );
                  } else {
                    alerta2("Error al registrar asistencia", "error");
                  }
                }
              };
              http.send("ced_est=" + encodeURIComponent(code.data));

              escaneoActivo = false;

              // Pausar 5 segundos antes del siguiente escaneo
              setTimeout(() => {
                escaneoActivo = true;
              }, 5000);
            } else if (res === "NOEXISTE") {
              alerta2(
                "El código QR no coincide con ningún estudiante en la base de datos.",
                "error"
              );
            } else {
              alerta2("Error al registrar asistencia", "error");
            }
          }
        };
        http.send("ced_est=" + encodeURIComponent(code.data));

        escaneoActivo = false;

        // Pausar 5 segundos antes del siguiente escaneo
        setTimeout(() => {
          escaneoActivo = true;
        }, 5000);
      }

      requestAnimationFrame(scanQRCode);
    } else {
      // Esperar 1 segundo antes de intentar escanear nuevamente
      setTimeout(() => {
        requestAnimationFrame(scanQRCode);
      }, 1000);
    }
  }

  function iniciarEscaneo() {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      if (video.srcObject) {
        video.srcObject.getTracks().forEach((track) => track.stop());
      }

      navigator.mediaDevices
        .getUserMedia({ video: true })
        .then((stream) => {
          video.srcObject = stream;
          video.play();
          scanQRCode();
        })
        .catch((err) => {
          console.error("Error al acceder a la cámara: ", err);

          if (err.name === "NotAllowedError") {
            mensajeError.innerText =
              "No se ha permitido el acceso a la cámara. ¿Desea volver a intentarlo?";
          } else if (
            err.name === "NotFoundError" ||
            err.name === "DevicesNotFoundError"
          ) {
            mensajeError.innerText =
              "No se ha encontrado una cámara. ¿Desea volver a intentarlo?";
          } else if (
            err.name === "NotReadableError" ||
            err.name === "TrackStartError"
          ) {
            mensajeError.innerText =
              "No se puede acceder a la cámara. ¿Desea volver a intentarlo?";
          } else if (
            err.name === "OverconstrainedError" ||
            err.name === "ConstraintNotSatisfiedError"
          ) {
            mensajeError.innerText =
              "La configuración de la cámara no es compatible. ¿Desea volver a intentarlo?";
          } else {
            mensajeError.innerText =
              "Se ha producido un error al acceder a la cámara. ¿Desea volver a intentarlo?";
          }

          mensajeError.style.display = "block";
        });
    }
  }
});
