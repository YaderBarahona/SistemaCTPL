<?php
include "Views/Templates/header.php"; ?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/QR.css">
<div class="page-wrapper">
  <div class="page-content">
    <div class="scanner-container">
      <video id="videoElement" autoplay playsinline></video>
      <canvas id="qrCanvas" style="display:none;"></canvas>
      <div id="qrResult" class="qr-result"></div>
    </div>
    <audio id="beepSound" src="<?php echo BASE_URL; ?>assets/audio/barcode.mp3" hidden></audio>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/QR/QR.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jsQR-master/dist/jsQR.js"></script>
<?php include "Views/Templates/footer.php"; ?>