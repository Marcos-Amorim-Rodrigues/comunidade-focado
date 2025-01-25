<?php
session_start();
require('resources/config.php');
require('resources/templates/session-check.php');
$sqlCursos = $pdo->prepare("SELECT * FROM cursos");
$sqlCursos->execute();
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
  <section>
    <div class="container cursos-container">
      <h1>Confira a trilha que preparamos para você:</h1>
      <?php foreach ($sqlCursos as list($id, $curso, $descricao)) { ?>

        <div class="list-cursos">
          <div class="list-cursos-info">
            <h2>Curso: <?php echo $curso ?></h2>
            <p class="curso-descript"><?php echo $descricao ?></p>
            <?php
            $sqlModulos = $pdo->prepare("SELECT * FROM modules WHERE course = '$curso'");
            $sqlModulos->execute();
            $contadorModulo = 1;
            foreach ($sqlModulos as list($id, $module, $course)) {
            ?>
              <div class="list-modulo">
                <p>Módulo <?php echo $contadorModulo;
                          $contadorModulo++;
                          ?> -
                  <?php echo $module ?></p>
                <p class="ver-mais ver-mais-modulo" id="<?php echo $id ?>" onclick="abrirAulas(this.id)">Ver aulas <svg id='seta-<?php echo $id ?>' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 11l-3 3l-3-3" />
                  </svg></p>
              </div>
              <?php
              $sqlClasses = $pdo->prepare("SELECT * FROM classes WHERE course = '$course' AND module = '$module'");
              $sqlClasses->execute();
              $contadorClass = 1;
              foreach ($sqlClasses as list($idclass, $class, $courseClass, $moduleClass)) {
              ?>
                <a href="aula.php?id=<?= $idclass ?>" class="links-modules link-<?php echo $id ?>">
                  <div class="list-aula aula-<?php echo $id ?>">
                    <p>Aula <?php echo $contadorClass ?> - <?php echo $class ?></p>
                    <p class="ver-mais"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 20H9m-5-6.2V8.2c0-1.12 0-1.68.218-2.108c.192-.377.497-.682.874-.874C5.52 5 6.08 5 7.2 5h9.6c1.12 0 1.68 0 2.107.218c.377.192.683.497.875.874c.218.427.218.987.218 2.105v5.606c0 1.118 0 1.677-.218 2.104a2 2 0 0 1-.875.875c-.427.218-.986.218-2.104.218H7.197c-1.118 0-1.678 0-2.105-.218a2 2 0 0 1-.874-.875C4 15.48 4 14.92 4 13.8M14.5 11L10 8v6z" />
                      </svg> Assistir aula</p>
                  </div>
                </a>
              <?php $contadorClass++;
              } ?>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
</body>
<script src="js/dropdown-menu-login.js"></script>
<script src="js/ver-modulos-script.js"></script>

</html>