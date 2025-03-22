const listarTopicos = async () => {
  var inicio = document.getElementById('topics-container').childElementCount;
  if (inicio == 0) inicio += 1;
  const dados = await fetch('./listarTopicos.php?inicio=' + inicio);
  const resposta = await dados.text();

  document
    .getElementById('topics-container')
    .insertAdjacentHTML('beforeend', resposta);
  if (resposta.includes('Todos os tópicos já foram carregados!')) {
    var button = document.getElementById('load-more');
    button.disabled = 'true';
  }
};

listarTopicos();
