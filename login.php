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
          <input type="password" name="senha" id="senha">
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
</body>

</html>