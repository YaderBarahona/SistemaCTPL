<?php include "Views/Templates/header.php"; ?>

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Página no encontrada</p>
            <p class="text-gray-500 mb-0">Parece que encontraste un fallo en la matrix...</p>
            <a href="<?php echo BASE_URL; ?>Principal">&larr; Volver al panel</a>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>