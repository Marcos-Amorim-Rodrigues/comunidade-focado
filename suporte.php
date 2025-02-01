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

      <div class="faq">
        <h1><span>FAQ:</span></h1>
        <div class="question" id="question-1" onclick="abrirFaq(this.id)">
          <h3>Posso compartilhar o meu acesso?</h3>
          <svg id="seta-question-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 11l-3 3l-3-3" />
          </svg>
        </div>
        <div class="answer answerHide" id="answer-for-question-1">
          <p>Não. Você pagou para ter acesso a sua conta e um conteúdo exclusivo, que foi feito a partir de muito trabalho e dedicação da equipe responsável. Não permita que outras pessoas tenham acesso gratuito a isso.</p>
        </div>
        <div class="question" id="question-2" onclick="abrirFaq(this.id)">
          <h3>Quando é a renovação da minha assinatura?</h3>
          <svg id="seta-question-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 11l-3 3l-3-3" />
          </svg>
        </div>
        <div class="answer answerHide" id="answer-for-question-2">
          <p>A renovação da sua assinatura será renovada automaticamente através da plataforma Kiwify. Caso queira cancelar a renovação automática, você pode acessar a plataforma e desativá-la.</p>
        </div>
        <div class="question" id="question-3" onclick="abrirFaq(this.id)">
          <h3>Quando serão lançadas novas aulas?</h3>
          <svg id="seta-question-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 11l-3 3l-3-3" />
          </svg>
        </div>
        <div class="answer answerHide" id="answer-for-question-3">
          <p>Novas aulas são lançadas todos os meses sobre todos os temas e cursos. Fique atento e acompanhe a inserção de novas aulas.</p>
        </div>
      </div>
      <div class="second-suport-section">
        <div class="suport-form">
          <div>
            <h2>Ainda tem dúvidas?<br>Entre em contato:</h2>
            <a href="https://wa.me/5538988015975"><button>Entrar em contato</button></a>
          </div>
        </div>
        <div class="suport-image">
          <img src="images/suport-image.png" alt="">
        </div>
      </div>
    </div>
  </section>
</body>
<script src="js/dropdown-menu-login.js"></script>
<script src="js/ver-faq.js"></script>

</html>