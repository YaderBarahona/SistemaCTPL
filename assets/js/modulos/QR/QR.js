document.addEventListener("DOMContentLoaded", function () {
  const video = document.getElementById("videoElement");
  const canvas = document.getElementById("qrCanvas");
  const context = canvas.getContext("2d");
  const qrResult = document.getElementById("qrResult");

  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then((stream) => {
      video.srcObject = stream;
      video.play();
    })
    .catch((err) => console.error("Error al acceder a la cámara: ", err));

  function scanQRCode() {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    const code = jsQR(imageData.data, imageData.width, imageData.height);

    if (code) {
      qrResult.innerText = code.data;
      // Reproducir el sonido
      const beepSound = document.getElementById("beepSound");
      beepSound.volume = 1;
      beepSound.play();
    }

    requestAnimationFrame(scanQRCode);
  }

  scanQRCode();
});
