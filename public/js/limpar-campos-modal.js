function closeModal() {
  $('#modalCadastrar').find('input').val('');  
  
  let node = document.getElementById('maisTelefones');
  let parent = node.parentNode
  if(parent) {
    parent.removeChild(node);
    let divTelefone = document.createElement('div');
    divTelefone.id = 'maisTelefones';
    parent.appendChild(divTelefone);
  }

  let node2 = document.getElementById('maisEndereco');
  let parent2 = node2.parentNode
  if(parent2) {
    parent2.removeChild(node2);
    let divEndereco = document.createElement('div');
    divEndereco.id = 'maisEndereco';
    parent2.appendChild(divEndereco);
  }
}

function closeModalContato() {
  let node = document.getElementById('enderecos-modal');
  let parent = node.parentNode
  if(parent) {
    parent.removeChild(node);
    let divEnderecos = document.createElement('div');
    divEnderecos.id = 'enderecos-modal';
    parent.appendChild(divEnderecos);
  }
}