<?php
session_start();
require('resources/config.php');
require('resources/templates/session-check.php');
$userInfo = $sql->fetch(PDO::FETCH_ASSOC);
$userId = $userInfo['id'];
if (isset($_FILES['userUpload'])) {
  $userUpload = $_FILES['userUpload'];
  if ($userUpload['error']) echo  "<script>alert('Falha ao enviar o arquivo.');</script>";
  if ($userUpload['size'] > 2097152) echo  "<script>alert('O arquivo selecionado excede o tamanho esperado. Utilize um arquivo com menos de 2MB.');</script>";
  $caminho = "images/userImages/";
  $nomeDoArquivo = $userUpload['name'];
  $novoNomeDoArquivo = uniqid();
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'webp') echo  "<script>alert('Tipo de arquivo não aceito.');</script>";
  $path = $caminho . $novoNomeDoArquivo . "." . $extensao;
  $deuCerto = move_uploaded_file($userUpload["tmp_name"], $path);
  if ($deuCerto) {
    echo "<script>alert('Foto de perfil atualizada com sucesso!');</script>";
    $pdo->query("UPDATE usuarios SET imagepath = '$path' WHERE id = '$userId'");
    header("Refresh:0");
  } else echo "<script>alert('Falha ao enviar o arquivo.');</script>";
}

if (!empty($_POST["password"])) {
  $novaSenha = $_POST["password"];
  $novoNome = $_POST["name"];
  $novoEmail = $_POST["email"];
  if ($_POST["password"] == $userInfo['password']) {
    $pdo->query("UPDATE usuarios SET name = '$novoNome', email = '$novoEmail' WHERE id = '$userId'");
    $_SESSION['login'] = $novoEmail;
    echo "<script>alert('Informações alteradas com sucesso.');</script>";
    header("Refresh:0");
  } else echo "<script>alert('Senha inválida. Tente novamente.');</script>";
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
  <section class="userConfig">
    <div class="container">
      <div class="settingsContainer">
        <div>
          <?php
          if ($userInfo['imagepath']) {
          ?>
            <img src="<?= $userInfo['imagepath'] ?>" alt="" id="settingImage">
          <?php
          }
          ?>
          <p>Selecione uma foto de perfil:</p>
          <form method="POST" enctype="multipart/form-data" action="">
            <label for="file-upload" class="profileImage">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                <path fill="#444" d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2ZM5 5v14h14V5H5Zm13 12H6l3-4l1 1l3-4l5 7Zm-9.5-6a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3Z" />
              </svg>
              <p id="load-image">Carregar foto</p>
            </label>
            <input name="userUpload" id="file-upload" type="file" onchange="imageLoaded()" />
            <button>Atualizar foto</button>
          </form>
        </div>
        <div class="principal">
          <form action="" method="POST">
            <h2>Configurações</h2>
            <label for="name">Nome de usuário:</label>
            <input type="text" name="name" id="name" value="<?= $userInfo['name'] ?>">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" value="<?= $userInfo['email'] ?>">
            <label for="password">Confirme sua senha:</label>
            <input type="password" name="password" id="password">
            <button>Atualizar informações</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
<script src="js/dropdown-menu-login.js"></script>
<script src="js/changing-user-image.js"></script>

</html>