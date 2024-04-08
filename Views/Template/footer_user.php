<footer class="footer mt-auto py-5 bg-light">
    <div class="container" id="nosotros">
      <div class="row">
        <!-- Sección ABOUT -->
        <div class="col-md-4 mb-4">
          <h5 class="text-uppercase font-weight-bold text-dark">ACERCA DE</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-muted">Sobre nosotros</a></li>
            <li><a href="#" class="text-muted">Comentarios</a></li>
            <li><a href="#" class="text-muted">Política de privacidad</a></li>
            <li><a href="#" class="text-muted">Términos de servicio</a></li>
          </ul>
        </div>

        <!-- Sección MORE ABOUT US -->
        <div class="col-md-4 mb-4">
          <h5 class="text-uppercase font-weight-bold text-dark">MÁS SOBRE NOSOTROS</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-muted">Contactanos</a></li>
            <li><a href="#" class="text-muted">Términos y condiciones</a></li>
            <li><a href="<?php echo base_url(); ?>perfil" class="text-muted">Perfil</a></li>
            <li><a href="<?php echo base_url(); ?>carrito" class="text-muted">Carrito</a></li>
            <li><a href="#catalogo" class="text-muted">Catálogo</a></li>
            <li><a href="#ubicaciones" class="text-muted">Ubicaciones</a></li>
          </ul>
        </div>

        <!-- Sección SIGN UP AND SAVE -->
        <div class="col-md-4 mb-4">
          <h5 class="text-uppercase font-weight-bold text-dark">REGÍSTRATE</h5>
          <p class="text-muted">Suscríbete para recibir promociones.</p>
          <form>
            <div class="form-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="Tu correo electrónico">
            </div>
            <button type="submit" class="btn btn-primary">Suscribirse</button>
          </form>
        </div>
        <div class="row mt-3">
          <div class="col-md-12 text-center">
            <a href="#" class="btn btn-social-icon btn-instagram mr-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-social-icon btn-facebook mr-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-social-icon btn-tiktok"><i class="fab fa-tiktok"></i></a>
          </div>
        </div>
      </div>

      <!-- Sección Social Media -->

    </div>
  </footer>





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- jQuery and Popper.js first, then Bootstrap JS -->
  <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
  <script src="<?= media(); ?>/js/popper.min.js"></script>
  <script src="<?= media(); ?>/js/bootstrap.min.js"></script>

</body>

</html>