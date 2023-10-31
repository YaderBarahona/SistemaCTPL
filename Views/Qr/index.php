<?php include "Views/Templates/header.php"; ?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/QR.css">
<div class="page-wrapper">
  <div class="page-content">
    <div class="scanner-container">
      <!-- <div id="mensajeError" style="display:none; text-align: center; margin-bottom: 16px;">
        Hubo un error al acceder a la cámara. ¿Desea volver a intentarlo?
        <button id="reintentar">Reintentar</button>
      </div> -->
      <video id="videoElement" autoplay playsinline></video>
      <canvas id="qrCanvas" style="display:none;"></canvas>
      <div id="qrResult" class="qr-result">
        <input id="ced_est" name="ced_est" type="text" disabled>
      </div>
    </div>

    <div id="mensajeError" style="display:none; text-align: center; margin-bottom: 16px;">
      Hubo un error al acceder a la cámara. ¿Desea volver a intentarlo?
    </div>
    <button id="iniciarEscaneo" style="display:none; margin: 16px auto;">Abrir cámara</button>

    <audio id="scannerSound" src="<?php echo BASE_URL; ?>assets/audio/barcode.mp3" hidden></audio>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/QR/QR.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jsQR-master/dist/jsQR.js"></script>
<?php include "Views/Templates/footer.php"; ?>