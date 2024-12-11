<?php headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"><?= $data['page_title']; ?></a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Donaciones</h3>
        <div class="tile-body">
          <canvas id="ventasChart" style="height: 300px;"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Usuarios</h3>
        <div class="tile-body">
          <canvas id="usuariosChart" style="height: 300px;"></canvas>
        </div>
      </div>
    </div>
  </div>
  <!-- Nueva fila para los gráficos adicionales -->
  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Productos</h3>
        <div class="tile-body">
          <canvas id="productosChart" style="height: 300px;"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Categoria productos</h3>
        <div class="tile-body">
          <canvas id="rendimientoChart" style="height: 300px;"></canvas>
        </div>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Datos de ejemplo para los gráficos
  var ventasData = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [{
      label: 'Registros Inventario',
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1,
      data: [65, 59, 80, 81, 56, 55]
    }]
  };

  var usuariosData = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [{
      label: 'Usuarios Activos',
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1,
      data: [28, 48, 40, 19, 86, 27]
    }]
  };

  // Configuración de los gráficos
  var ventasChart = new Chart(document.getElementById('ventasChart'), {
    type: 'bar',
    data: ventasData,
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  var usuariosChart = new Chart(document.getElementById('usuariosChart'), {
    type: 'line',
    data: usuariosData,
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
  var productosData = {
    labels: ["Producto A", "Producto B", "Producto C", "Producto D", "Producto E"],
    datasets: [{
      label: 'Categorias Productos',
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)'
      ],
      borderWidth: 1,
      data: [12, 19, 3, 5, 2]
    }]
  };

  var rendimientoData = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [{
      label: 'Administradores Almacen',
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1,
      data: [65, 59, 80, 81, 56, 55]
    }]
  };

  // Configuración de los nuevos gráficos
  var productosChart = new Chart(document.getElementById('productosChart'), {
    type: 'pie',
    data: productosData
  });

  var rendimientoChart = new Chart(document.getElementById('rendimientoChart'), {
    type: 'radar',
    data: rendimientoData,
    options: {
      scale: {
        ticks: {
          beginAtZero: true
        }
      }
    }
  });
</script>
