function abrirFaq(question) {
  let answer = document.querySelector(`#answer-for-${question}`);
  answer.classList.toggle('answerHide');
  let seta = document.querySelector(`#seta-${question}`);
  seta.classList.toggle('flip-vert');
}
