<?php
session_start();
require('resources/config.php');
require('resources/templates/session-check.php');

$inicio = filter_input(INPUT_GET, "inicio", FILTER_SANITIZE_NUMBER_INT);

if (!empty($inicio)) {
  if ($inicio == 1) $inicio = $inicio - 1;

  $qnt_result_pg = 3;

  $query_topicos = "SELECT id, topico, descricao, usuario, imagepath FROM topicos ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
  $result_topicos = $pdo->prepare($query_topicos);
  $result_topicos->execute();
  $dados = "";

  if ($result_topicos->rowCount() == 0) {
    echo "<h3 style='color: #fff000; padding: 2rem;'>Todos os tópicos já foram carregados!</h3>";
  } else {
    while ($row_topico = $result_topicos->fetch(PDO::FETCH_ASSOC)) {
      extract($row_topico);

      $imageOwner = "";
      $sqlUsuario = $pdo->prepare("SELECT * FROM usuarios WHERE id = $usuario");
      $sqlUsuario->execute();
      $sqlUsuarioInfo = $sqlUsuario->fetch(PDO::FETCH_ASSOC);
      if ($sqlUsuarioInfo['imagepath'] != '') $imageOwner = $sqlUsuarioInfo['imagepath'];
      else $imageOwner = 'images/userImages/default-image.jpg';

      $topicImage = "";
      if ($imagepath) $topicImage = "<img src='$imagepath' alt='' class='topic-image'>";

      $sqlTopicoComentarios = $pdo->prepare("SELECT * FROM comentariostopicos WHERE topico = $id");
      $sqlTopicoComentarios->execute();
      $quantidadeDeComentarios = $sqlTopicoComentarios->rowCount();

      $comentarios = "";
      foreach ($sqlTopicoComentarios as list($idComentario, $descComentario, $usuarioComentario, $topicoComentario)) {
        $imageOwnerComentario = "";
        $sqlUsuarioComentario = $pdo->prepare("SELECT * FROM usuarios WHERE id = $usuarioComentario");
        $sqlUsuarioComentario->execute();
        $usuarioComentarioInfo = $sqlUsuarioComentario->fetch(PDO::FETCH_ASSOC);
        if ($usuarioComentarioInfo['imagepath']) $imageOwnerComentario = $usuarioComentarioInfo['imagepath'];
        else $imageOwnerComentario = 'images/userImages/default-image.jpg';
        $nomeUsuarioComentario = $usuarioComentarioInfo['name'];
        $comentarios .= "<div class='topic-comment comentario-$id'> <div class='topic-owner topic-theme'> <img src='$imageOwnerComentario' alt='' class='profile-photo-comunidade comment-photo-comunidade'> <div class='comment-texts comment-theme'> <h3>$nomeUsuarioComentario</h3> <p>$descComentario</p> </div> </div> </div>";
      }

      $topico_code = "<div class='topic-comunidade'><h2>Tópico: <span> $topico</span></h2><div class='topic-owner'><img src='"
        .
        $imageOwner
        .
        "' alt='' class='profile-photo-comunidade'><h3>"
        .
        $sqlUsuarioInfo['name']
        .
        "</h3></div><p class='topic-theme'> $descricao </p>"
        .
        $topicImage
        .
        "<p class='ver-comentarios' id='$id' onclick='abrirComentarios(this.id)'>Ver comentários ("
        .
        $quantidadeDeComentarios
        .
        ")<svg id='seta-$id' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m15 11l-3 3l-3-3' /></svg></p>"
        .
        $comentarios
        .
        "<div class='newComment'> <form action='comunidade.php?id=$id' method='POST'> <input type='text' name='comentario' placeholder='Deixe o seu comentário...'> <button>Comentar</button> </form> </div> </div>";
      $dados .= $topico_code;
    }

    echo $dados;
  }
} else {
  echo "<p style='color: #fff000;'>Erro: nenhum post encontrado!</p>";
}
