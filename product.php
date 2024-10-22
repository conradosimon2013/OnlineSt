<?php
include './library/configServer.php';
include './library/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Productos</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-product">
    <?php include './inc/navbar.php'; ?>
    <section id="store">
       <br>
        <div class="container">
            <div class="page-header">
              <h1>Tienda <small class="tittles-pages-logo">Cat Electronics</small></h1>
            </div>
            <br><br>
            <div class="row">
              <div class="col-xs-12">
                  <ul id="store-links" class="nav nav-tabs" role="tablist">
                      <li role="presentation"><a href="#all-product" role="tab" data-toggle="tab" aria-controls="all-product" aria-expanded="false">Todos los productos</a></li>
                      <li role="presentation" class="dropdown active">
                          <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Categorías <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                              <!-- ==================== Lista categorias =============== -->
                              <?php
                              $categorias = ejecutarSQL::consultar("SELECT * FROM categoria");
                              while ($cate = mysqli_fetch_array($categorias)) {
                                  echo '
                                      <li>
                                          <a href="#' . htmlspecialchars($cate['CodigoCat']) . '" tabindex="-1" role="tab" id="' . htmlspecialchars($cate['CodigoCat']) . '-tab" data-toggle="tab" aria-controls="' . htmlspecialchars($cate['CodigoCat']) . '" aria-expanded="false">' . htmlspecialchars($cate['Nombre']) . '
                                          </a>
                                      </li>';
                              }
                              ?>
                              <!-- ==================== Fin lista categorias =============== -->
                          </ul>
                      </li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade" id="all-product" aria-labelledby="all-product-tab">
                          <br><br>
                          <div class="row">
                              <?php
                              $consulta = ejecutarSQL::consultar("SELECT * FROM producto WHERE Stock > 0");
                              if ($consulta && mysqli_num_rows($consulta) > 0) {
                                  while ($fila = mysqli_fetch_array($consulta)) {
                                      echo '
                                      <div class="col-xs-12 col-sm-6 col-md-4">
                                          <div class="thumbnail">
                                              <img src="assets/img-products/' . htmlspecialchars($fila['Imagen']) . '">
                                              <div class="caption">
                                                  <h3>' . htmlspecialchars($fila['Marca']) . '</h3>
                                                  <p>' . htmlspecialchars($fila['NombreProd']) . '</p>
                                                  <p>$' . htmlspecialchars($fila['Precio']) . '</p>
                                                  <p class="text-center">
                                                      <a href="infoProd.php?CodigoProd=' . htmlspecialchars($fila['CodigoProd']) . '" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                                      <button value="' . htmlspecialchars($fila['CodigoProd']) . '" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                                  </p>
                                              </div>
                                          </div>
                                      </div>';
                                  }
                              } else {
                                  echo '<h2>No hay productos en esta categoría</h2>';
                              }
                              ?>
                          </div>
                      </div><!-- Fin del contenedor de todos los productos -->
          
                      <!-- ==================== Contenedores de categorias =============== -->
                      <?php
                      $consultar_categorias = ejecutarSQL::consultar("SELECT * FROM categoria");
                      while ($categ = mysqli_fetch_array($consultar_categorias)) {
                          echo '<div role="tabpanel" class="tab-pane fade" id="' . htmlspecialchars($categ['CodigoCat']) . '" aria-labelledby="' . htmlspecialchars($categ['CodigoCat']) . '-tab"><br>';
                          $consultar_productos = ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoCat='" . htmlspecialchars($categ['CodigoCat']) . "' AND Stock > 0");
                          if ($consultar_productos && mysqli_num_rows($consultar_productos) > 0) {
                              while ($prod = mysqli_fetch_array($consultar_productos)) {
                                  echo '
                                  <div class="col-xs-12 col-sm-6 col-md-4">
                                      <div class="thumbnail">
                                          <img src="assets/img-products/' . htmlspecialchars($prod['Imagen']) . '">
                                          <div class="caption">
                                              <h3>' . htmlspecialchars($prod['Marca']) . '</h3>
                                              <p>' . htmlspecialchars($prod['NombreProd']) . '</p>
                                              <p>$' . htmlspecialchars($prod['Precio']) . '</p>
                                              <p class="text-center">
                                                  <a href="infoProd.php?CodigoProd=' . htmlspecialchars($prod['CodigoProd']) . '" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                                  <button value="' . htmlspecialchars($prod['CodigoProd']) . '" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                              </p>
                                          </div>
                                      </div>
                                  </div>';
                              }
                          } else {
                              echo '<h2>No hay productos en esta categoría</h2>';
                          }
                          echo '</div>';
                      }
                      ?>
                      <!-- ==================== Fin contenedores de categorias =============== -->
                  </div>
              </div>
          </div>
          
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $('#store-links a:first').tab('show');
        });
    </script>
</body>
</html>