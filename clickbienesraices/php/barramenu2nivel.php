<!-- CODIGO PARA INSERTAR EL MENU DE 2DO NIVEL -->

<nav class=barramenu>
      <a class="arealogo"> <img id="imglogo"
                  src="../imagenes_site/logo barra menu.webp"></a>
      <ul class="menu">
            <li>
                  <a class="opcionmenu" href="../index.php">Inicio
                  </a>
            </li>

            <li class="contenedorsubmenu">
                  <a class="opcionmenu" href="ofertas-urbanas.php">Ofertas Urbanas</a>
                  <ul>
                        <?php 
                              foreach ($arraycategoriasurbanas as $categoria) {
                                    $varcategoriamenu = $categoria["Categoria"];
                                    $varcodigocategoria = $categoria["Codigo_Categoria"];
                                    echo "<li class='btnopcion'>
                                          <a class='opcionsubmenu' href='desplegarpredio.php?codigocategoria=" .  $varcodigocategoria . "&codigopredio=TODOS'>$varcategoriamenu</a> </li>";
                              };
                        ?>
                  </ul>
            </li>
            <li class="contenedorsubmenu">
                  <a class="opcionmenu" href="ofertas-rurales.php">Ofertas Rurales</a>
                  <ul>
                        <?php 
                              foreach ($arraycategoriasrurales as $categoria) {
                                    $varcategoriamenu = $categoria["Categoria"];
                                    $varcodigocategoria = $categoria["Codigo_Categoria"];
                                    echo "<li class='btnopcion'>
                                          <a class='opcionsubmenu' href='desplegarpredio.php?codigocategoria=" .  $varcodigocategoria . "&codigopredio=TODOS'>$varcategoriamenu</a> </li>";
                              };
                        ?>
                  </ul>
            </li>
            <li>
                  <a class="opcionmenu" href="desplegarnoticias.php?idnoticia=TODAS">Noticias
                  </a>
            </li>
            <li>
                  <a class="opcionmenu" href="consultarpredios.php">Consultar Predios
                  </a>
            </li>
      </ul>
</nav>

