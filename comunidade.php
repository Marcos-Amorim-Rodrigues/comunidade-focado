<?php
session_start();
require('resources/config.php');
require('resources/templates/session-check.php');
$userInfo = $sql->fetch(PDO::FETCH_ASSOC);
$userId = $userInfo['id'];

if (!empty($_POST["comentario"])) {
  $idTopicoComentario = $_GET['id'];
  $novoComentario = $_POST["comentario"];
  $pdo->query("INSERT INTO comentariostopicos (comentario, usuario, topico) VALUES ('$novoComentario', '$userId', '$idTopicoComentario')");
}

if (isset($_FILES['topicUpload'])) {
  $topicUpload = $_FILES['topicUpload'];
  $nomeDoTopico = $_POST["topicname"];
  $descDoTopico = $_POST["topicdescript"];
  if ($topicUpload['error']) {
    echo "<script>alert('Novo tópico iniciado com sucesso!');</script>";
    $pdo->query("INSERT INTO topicos (topico, descricao, usuario) VALUES ('$nomeDoTopico', '$descDoTopico', '$userId')");
    header("Refresh:0");
  } else {


    if ($topicUpload['size'] > 2097152) echo  "<script>alert('O arquivo selecionado excede o tamanho esperado. Utilize um arquivo com menos de 2MB.');</script>";
    $caminho = "images/userImages/";
    $nomeDoArquivo = $topicUpload['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'webp') echo  "<script>alert('Tipo de arquivo não aceito.');</script>";
    $path = $caminho . $novoNomeDoArquivo . "." . $extensao;
    $deuCerto = move_uploaded_file($topicUpload["tmp_name"], $path);
    if ($deuCerto) {
      echo "<script>alert('Novo tópico iniciado com sucesso!');</script>";
      $pdo->query("INSERT INTO topicos (topico, descricao, usuario, imagepath) VALUES ('$nomeDoTopico', '$descDoTopico', '$userId', '$path')");
      header("Refresh:0");
    } else echo "<script>alert('Falha ao enviar o arquivo.');</script>";
  }
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
  <section id="comunidade">
    <div class="container">
      <div id="header-comunidade">
        <h1>Acompanhe a comunidade:</h1>
        <p>Seja educado, não ofenda, não levante pautas militantes e não promova produtos/serviços.</p>
      </div>
      <div id="new-topic"><button onclick="abrirNewTopic()"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h4m0 0h4m-4 0v4m0-4V8m0 13a9 9 0 1 1 0-18a9 9 0 0 1 0 18" />
          </svg> Criar novo tópico</button>
      </div>
      <div class="topics-container" id="new-topic-form">
        <div class="newTopicForm">
          <form action="" method="POST" enctype="multipart/form-data">
            <label for="topicname">
              <h3>Digite o tema do tópico:</h3>
            </label>
            <input type="text" name="topicname" id="topicname" placeholder="Ex: Novas tendências de anúncios">
            <label for="topicdescript">
              <h3>Digite o que você quer discutir:</h3>
            </label>
            <textarea type="text" name="topicdescript" id="topicdescript" placeholder="Ex: Estive pesquisando sobre as tendências de provas sociais nos EUA..."></textarea>
            <label for="file-upload" class="topicNewImage">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                <path fill="#444" d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2ZM5 5v14h14V5H5Zm13 12H6l3-4l1 1l3-4l5 7Zm-9.5-6a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3Z" />
              </svg>
              <p id="load-image">Carregar foto</p>
            </label>
            <input name="topicUpload" id="file-upload" type="file" onchange="imageLoaded()" />
            <button>Publicar</button>

          </form>
        </div>
      </div>
      <div class="topics-container" id="topics-container">
      </div>
      <div class="previous-next-buttons">
        <button onclick="listarTopicos()" id="load-more">Carregar mais</button>
      </div>
  </section>
</body>
<script src="js/dropdown-menu-login.js"></script>
<script src="js/ver-comentarios-topicos.js"></script>
<script src="js/ver-form-novo-topico.js"></script>
<script src="js/listar-topicos.js"></script>

</html>