// função para mostrar as divs das aulas quando clicar no módulo

function abrirAulas(modulo) {
  let seta = document.querySelector(`#seta-${modulo}`);
  seta.classList.toggle('flip-vert');
  let aulas = document.querySelectorAll(`.aula-${modulo}`);
  aulas.forEach((aula) => {
    if (aula.style.display === 'flex') {
      aula.style.display = 'none';
    } else aula.style.display = 'flex';
  });
  let links = document.querySelectorAll(`.link-${modulo}`);
  links.forEach((link) => {
    if (link.style.display === 'block') {
      link.style.display = 'none';
    } else link.style.display = 'block';
  });
}
