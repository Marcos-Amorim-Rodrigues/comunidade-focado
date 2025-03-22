<?php
session_start();
require('resources/config.php');
require('resources/templates/session-check.php');
$idClass = $_GET['id'];
$sqlClass = $pdo->prepare("SELECT * FROM classes WHERE id = '$idClass'");
$sqlClass->execute();
$classInfo = $sqlClass->fetch(PDO::FETCH_ASSOC);

$nextClassFlag = 0;
$nextClass = 0;

$previousClassFlag = 0;
$previousClass = 0;

$userInfo = $sql->fetch(PDO::FETCH_ASSOC);
$userId = $userInfo['id'];

if (!empty($_POST["comentario"])) {
  $novoComentario = $_POST["comentario"];
  $pdo->query("INSERT INTO comentarios (classe, comentario, usuario) VALUES ('$idClass', '$novoComentario', '$userId')");
}
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
    <div class="container cursos-container">
      <div>
        <a href="cursos.php">
          <p class="ver-mais ver-mais-modulo"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 15l-3-3l3-3" />
            </svg>Cursos</p>
        </a>
        <h3 style="font-weight: 400"><?= $classInfo['course'] ?> / <?= $classInfo['module'] ?> / <span style="font-weight: 800; font-size: 1.5rem"><?= $classInfo['class'] ?></span></h3>
      </div>
      <div class="list-cursos">
        <p>Aulas do curso:</p>
        <div class="otherClassContainer">
          <?php
          $selectedCourse = $classInfo['course'];
          $sqlMoreClasses = $pdo->prepare("SELECT * FROM classes WHERE course = '$selectedCourse'");
          $sqlMoreClasses->execute();
          foreach ($sqlMoreClasses as list($otherId, $otherClass, $otherCourse, $otherModule)) {
            if ($nextClassFlag == 1) {
              $nextClass = $otherId;
              $nextClassFlag = 0;
            }
            if ($otherId === $classInfo['id']) {
              $nextClassFlag = 1;
              $previousClassFlag = 1;
            }
            if ($previousClassFlag == 0) {
              $previousClass = $otherId;
            }
          ?>
            <a href="aula.php?id=<?= $otherId ?>">
              <div class="otherClass <?php if ($otherClass == $classInfo['class']) {
                                        echo 'actualClass';
                                      } ?>"><?= $otherClass ?></div>
            </a>
          <?php } ?>
        </div>
        <iframe class="classes" src="https://www.youtube.com/embed/DxGmyheUwQI?si=kgDe_J05RrgsHwhP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <div class="classButtons">
          <a href=<?php
                  if ($previousClass == 0) echo 'cursos.php';
                  else echo "aula.php?id=$previousClass";
                  ?>><button><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 15l-3-3l3-3" />
              </svg>Aula anterior</button> </a>
          <a href=<?php
                  if ($nextClass == 0) echo 'cursos.php';
                  else echo "aula.php?id=$nextClass";
                  ?>><button>Próxima aula<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11 9l3 3l-3 3" />
              </svg></button></a>
        </div>
        <div class="classRating">
          <p>Avalie esta aula: </p>
          <?php
          for ($loop = 0; $loop < 5; $loop++) {
          ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" id="star<?= $loop ?>" onclick="putRating(this.id)">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.335 10.337a.5.5 0 0 1 .28-.864l6.004-.712a.5.5 0 0 0 .396-.287l2.532-5.49a.5.5 0 0 1 .908 0l2.532 5.49a.5.5 0 0 0 .395.287l6.004.712a.5.5 0 0 1 .28.864l-4.438 4.105a.5.5 0 0 0-.15.464l1.177 5.93a.5.5 0 0 1-.735.534l-5.275-2.953a.5.5 0 0 0-.488 0l-5.276 2.952a.5.5 0 0 1-.735-.533l1.178-5.93a.5.5 0 0 0-.15-.464z" />
            </svg>
          <?php
          }
          ?>
        </div>
        <div class="comments">
          <h2>Comentários:</h2>
          <?php
          $sqlComentarios = $pdo->prepare("SELECT * FROM comentarios WHERE classe = '$idClass'");
          $sqlComentarios->execute();
          foreach ($sqlComentarios as list($idComentario, $classeComentario, $comentarioComentario, $usuarioComentario)) {
          ?>
            <div class="comment">
              <div>
                <div class="userPhoto">
                  <?php
                  $sqlUsuarioComentario = $pdo->prepare("SELECT * FROM usuarios WHERE id = '$usuarioComentario'");
                  $sqlUsuarioComentario->execute();
                  $usuarioComentarioInfo = $sqlUsuarioComentario->fetch(PDO::FETCH_ASSOC);
                  if ($usuarioComentarioInfo['imagepath']) {
                  ?>
                    <img src="<?= $usuarioComentarioInfo['imagepath'] ?>" alt="" width="100%" height="100%" style="border-radius:50%">
                  <?php
                  } else {
                  ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="70%" height="auto" viewBox="0 0 24 24">
                      <path fill="black" fill-rule="evenodd" d="M7.75 7.5a4.25 4.25 0 1 1 8.5 0a4.25 4.25 0 0 1-8.5 0M12 4.75a2.75 2.75 0 1 0 0 5.5a2.75 2.75 0 0 0 0-5.5m-4 10A2.25 2.25 0 0 0 5.75 17v1.188c0 .018.013.034.031.037c4.119.672 8.32.672 12.438 0a.04.04 0 0 0 .031-.037V17A2.25 2.25 0 0 0 16 14.75h-.34a.3.3 0 0 0-.079.012l-.865.283a8.75 8.75 0 0 1-5.432 0l-.866-.283a.3.3 0 0 0-.077-.012zM4.25 17A3.75 3.75 0 0 1 8 13.25h.34q.28.001.544.086l.866.283a7.25 7.25 0 0 0 4.5 0l.866-.283c.175-.057.359-.086.543-.086H16A3.75 3.75 0 0 1 19.75 17v1.188c0 .754-.546 1.396-1.29 1.517a40.1 40.1 0 0 1-12.92 0a1.54 1.54 0 0 1-1.29-1.517z" clip-rule="evenodd" />
                    </svg>
                  <?php
                  }
                  ?>
                </div>
              </div>
              <div>
                <h3><?= $usuarioComentarioInfo['name'] ?></h3>
                <p><?= $comentarioComentario ?> </p>
              </div>
            </div>
          <?php
          }
          ?>
          <div class="newComment">
            <form action="" method="POST">
              <input type="text" name="comentario" placeholder="Deixe o seu comentário...">
              <button>Comentar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
<script src="js/dropdown-menu-login.js"></script>
<script src="js/class-rating.js"></script>

</html>