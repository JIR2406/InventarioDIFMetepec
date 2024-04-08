<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="<?= media();?>/images/logo.ico">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- Incluye el enlace a Font Awesome para el icono del carrito -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />



  <!-- CSS  Assets-->

  <link rel="stylesheet" href="<?=media();?>/css/EstilosHome.css">

  <link rel="stylesheet" href="<?=media();?>/css/Paralax.css">

  <link rel="stylesheet" href="<?=media();?>/css/ActualizadosHome.css">



  <title>
    <?= $data['page_tag']; ?>
  </title>


</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <!-- Formulario de búsqueda (visible solo en pantallas grandes) -->
      <div class="col-md-4 text-center d-none d-lg-block">
        <form class="form-inline">
          <div class="input-group">
            <input type="text" class="form-control custom-text-input" placeholder="Buscar..." aria-label="Buscar"
              aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-custom" type="button">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Logo (visible en pantallas grandes y pequeñas) -->
      <div class="col-md-4 text-center">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <img src="http://localhost/Petipa/Assets/images/logo.jpg" alt="Logo"
            style="width: 120px; height: 80px; border-radius: 50%;">
        </a>
      </div>

      <!-- Icono de búsqueda y botones en pantallas pequeñas -->
      <div class="col-md-4 d-md-none">
        <div class="row">
          <!-- Botones en la esquina superior izquierda -->
          <div class="col-6 col-md-12 mb-3">
            <button class="btn btn-outline-custom" type="button">
              <i class="fa fa-search"></i>
            </button>
          </div>
          <!-- Botones en la esquina superior derecha -->
          <div class="col-6 col-md-12 mb-3">
            <div class="text-right">
              <a href="<?php echo base_url(); ?>login" class="btn btn-outline-custom">
                <i class="fas fa-user"></i>
              </a>
              <a href="<?php echo base_url(); ?>carrito" class="btn btn-outline-custom">
                <i class="fas fa-shopping-cart"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Botones de usuario y carrito (visible solo en pantallas grandes) -->
      <div class="col-md-4 text-right d-none d-lg-flex align-items-center">
        <a href="#nosotros" class="btn btn-outline-custom mx-2">
          Nosotros
        </a>
        <a href="#catalogo" class="btn btn-outline-custom mx-2">
          Catalogo
        </a>
        <a href="#ubicaciones" class="btn btn-outline-custom mx-2">
          Ubicaciones
        </a>
        <a href="<?php echo base_url(); ?>login" class="btn btn-outline-custom mx-2">
          <i class="fas fa-user"></i>
        </a>
        <a href="<?php echo base_url(); ?>carrito" class="btn btn-outline-custom mx-2 order-md-last">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </div>
    </div>
  </nav>