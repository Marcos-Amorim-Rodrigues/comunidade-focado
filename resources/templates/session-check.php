
<?php
if (empty($_SESSION['login'])) {
  header('Location: login.php');
  exit();
} else {
  $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :loginEmail AND password = :loginSenha");
  $sql->bindValue(':loginEmail', $_SESSION['login']);
  $sql->bindValue('loginSenha', $_SESSION['senha']);
  $sql->execute();
  if (!$sql->rowCount()) {
    header('Location: login.php');
    exit();
  }
}
?>