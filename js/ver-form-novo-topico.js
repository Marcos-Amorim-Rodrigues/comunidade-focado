let newForm = document.querySelector('#new-topic-form');
function abrirNewTopic() {
  if (newForm.style.display == 'flex') newForm.style.display = 'none';
  else newForm.style.display = 'flex';
}
