// função para mostrar os comentários dos tópicos quando clicar no tópico

function abrirComentarios(topico) {
  let seta = document.querySelector(`#seta-${topico}`);
  seta.classList.toggle('flip-vert');
  let comentarios = document.querySelectorAll(`.comentario-${topico}`);
  comentarios.forEach((comentario) => {
    if (comentario.style.display === 'flex') {
      comentario.style.display = 'none';
    } else comentario.style.display = 'flex';
  });
}
