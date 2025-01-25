<?php
session_start();
require('resources/config.php');
require('resources/templates/session-check.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <title>Comunidade Focado</title>
  <?php
  include('resources/templates/head-config.php');
  ?>
</head>

<body>
  <?php
  include('resources/templates/header.php');
  ?>
  <section id="carousel-sec">
    <div class="container">
      <div class="carousel plat-carousel">
        <div class="carousel-info">
          <div>
            <h1 id="carousel-title">Bem vindo(a), <?php echo $sql->fetchColumn(3) ?>!</h1>
            <p id="carousel-descript">Você está no ecossistema mais completo do Marketing Digital!<br><br> Fique à vontade para assistir nossas aulas ou interagir na comunidade. Lembre-se que o seu conhecimento é a sua maior vantagem.</p>
            <div class="carousel-buttons">
              <a href="cursos.php"><button>Ver aulas</button></a>
              <a href="comunidade.php"><button>Comunidade</button></a>
            </div>
          </div>
        </div>
        <div></div>
      </div>
    </div>
  </section>
</body>
<script src="js/dropdown-menu-login.js"></script>

</html>