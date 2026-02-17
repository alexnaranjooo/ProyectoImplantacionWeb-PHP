    </div> <!-- Cierre del container -->
    <footer class="footer mt-5 py-3 bg-light">
        <div class="container text-center">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITIO_NOMBRE; ?></p>
            <p class="text-muted small">
                PHP <?php echo PHP_VERSION; ?> | 
                MySQL <?php 
                    try {
                        $db = Database::conectar();
                        echo $db->getAttribute(PDO::ATTR_SERVER_VERSION);
                    } catch(Exception $e) {
                        echo 'N/A';
                    }
                ?>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>