// Script para fazer o carrossel da primeira seção

//declaração de variáveis e seleção de elementos do carrossel
let carousel = document.querySelector('.carousel');
let carouselTitle = document.getElementById('carousel-title');
let carouselDescript = document.getElementById('carousel-descript');
let carouselBullet = document.getElementById('marcos');
carouselBullet.style.backgroundColor = '#fff600';

//função para alterar o carrossel para o slide de Atendimento
function trocarDan() {
  carousel.style.backgroundImage = `url('../images/banner2.png')`;
  carouselTitle.innerText = 'Encante seu cliente';
  carouselDescript.innerText =
    'Confira todas as técnicas usadas pelo time de sucesso do cliente na Foco Marketing para encantar sua jornada, baseada no modelo de encantamento Disney.';
}

//função para alterar o carrossel para o slide de Vendas
function trocarMeireles() {
  carousel.style.backgroundImage = `url('../images/banner3.png')`;
  carouselTitle.innerText = 'Venda sem dificuldades';
  carouselDescript.innerText =
    'Crie o seu processo de vendas baseado na metodologia que a Foco Marketing utilizou desde o começo para atender mais de 1000 clientes em menos de 3 anos.';
}

//função para alterar o carrossel para o slide de Tráfego
function trocarMarcos() {
  carousel.style.backgroundImage = `url('../images/banner.png')`;
  carouselTitle.innerText = 'Tráfego pago avançado';
  carouselDescript.innerText =
    'Aprenda as técnicas avançadas que levaram a Foco Marketing gerenciar mais de 10 milhões de reais em anúncios online em menos de 3 anos.';
}

//função para troca recorrente dos slides do carrossel
function trocarBanner() {
  if (carouselTitle.innerText === 'Tráfego pago avançado') {
    trocarDan();
    carouselTitle = document.getElementById('carousel-title');
    carouselBullet.style.backgroundColor = 'grey';
    carouselBullet = document.getElementById('daniel');
    carouselBullet.style.backgroundColor = '#fff600';
  } else if (carouselTitle.innerText === 'Encante seu cliente') {
    trocarMeireles();
    carouselTitle = document.getElementById('carousel-title');
    carouselBullet.style.backgroundColor = 'grey';
    carouselBullet = document.getElementById('meireles');
    carouselBullet.style.backgroundColor = '#fff600';
  } else if (carouselTitle.innerText === 'Venda sem dificuldades') {
    trocarMarcos();
    carouselTitle = document.getElementById('carousel-title');
    carouselBullet.style.backgroundColor = 'grey';
    carouselBullet = document.getElementById('marcos');
    carouselBullet.style.backgroundColor = '#fff600';
  }
}

//timer para a troca recorrente do carrossel
const interval = setInterval(trocarBanner, 10000);
