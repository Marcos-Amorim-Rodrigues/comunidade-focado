<?php
require('resources/config.php');
$loginWarning = '';
$loginEmail = '';
$loginSenha = '';
if (!empty($_POST["email"])) $loginEmail = htmlspecialchars($_POST["email"]);
if (!empty($_POST["senha"])) $loginSenha = htmlspecialchars($_POST["senha"]);
if ($loginEmail && $loginSenha) {
  $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :loginEmail AND password = :loginSenha");
  $sql->bindValue(':loginEmail', $loginEmail);
  $sql->bindValue('loginSenha', $loginSenha);
  $sql->execute();
  if ($sql->rowCount()) {
    session_start();
    $_SESSION['login'] = $loginEmail;
    $_SESSION['senha'] = $loginSenha;
    header("Location: plataforma.php");
    exit();
  } else {
    $loginWarning = 'Login ou senha incorreto';
  }
} else if ($loginEmail && !$loginSenha) {
  $loginWarning = 'Digite a sua senha';
} else if (!$loginEmail && $loginSenha) {
  $loginWarning = 'Digite o seu email';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <title>Login Comunidade Focado</title>
  <?php
  include('resources/templates/head-config.php');
  ?>
</head>

<body>
  <section>
    <div class="container principal">
      <img src="images/focox.png" alt="">

      <div>
        <form action="" method="POST">
          <h2><span>Comunidade Focado</span></h2>
          <p>Faça o seu Login abaixo</p>
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" value="<?= $loginEmail ?>">
          <label for="senha">Senha:</label>
          <div>
            <input type="password" name="senha" id="senha">
            <svg onclick="togglePasswordEye()" class="password-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="#000" d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13" />
            </svg>
            <svg onclick="togglePasswordEye()" class="password-eye2 eye-hide" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="#000" d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
            </svg>
          </div>
          <button>Entrar</button>
          <?php if ($loginWarning): ?>
            <span id="warning-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path fill="currentColor" d="M8 1a7 7 0 1 1-7 7a7.01 7.01 0 0 1 7-7M2 8c0 1.418.504 2.79 1.423 3.87l8.447-8.447A5.993 5.993 0 0 0 2 8m12 0c0-1.418-.504-2.79-1.423-3.87L4.13 12.577A5.993 5.993 0 0 0 14 8" />
              </svg>
              <?php
              echo $loginWarning;
              ?>
            </span>
          <?php endif; ?>

        </form>
      </div>
      <hr width="50%" color="#FFF600">
      <div class="venda-login">
        <div class="venda-conteudo">
          <h2>Ainda <span>não possui</span> o acesso?</h2>
          <p>Adquira agora mesmo a Comunidade Focado e entre para a comunidade de Marketing Digital que mais cresce no Brasil.</p>
          <a href="https://pay.kiwify.com.br/oF1xj9S"><button>Adquirir agora</button></a>
        </div>
      </div>
    </div>
  </section>

  <script src="./js/toggle-password-eye.js"></script>

</body>

</html>