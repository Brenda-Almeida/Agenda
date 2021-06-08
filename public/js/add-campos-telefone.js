let countTel = 1;
function addTelefone() {
  countTel++;

  let divRow = document.createElement('div');
  divRow.className = 'row justify-content-center';

  let input = document.createElement('input');
  input.className = 'form-control';
  input.type = 'text';
  input.name = 'telefone' + countTel;
  input.id = 'telefone' + countTel;
  input.placeholder = 'Telefone';

  divRow.appendChild(input);

  document.getElementById('maisTelefones').appendChild(divRow);

  $("#telefone" + countTel).mask("(00) 00000-0000");

}