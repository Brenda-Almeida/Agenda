let countEnderecos = 1; 
  
function addEndereco() {
  countEnderecos++;

  let divContent = document.createElement('div');

  let divRow1 = document.createElement('div');
  divRow1.className = 'row justify-content-center groupEndereco';

  let divCol1 = document.createElement('div');
  divCol1.className = 'col-3';

  divRow1.appendChild(divCol1);

  let inputCep = document.createElement('input');
  inputCep.className = 'form-control';
  inputCep.type = 'text';
  inputCep.name = 'cep' + countEnderecos;
  inputCep.id = 'cep' + countEnderecos;
  inputCep.placeholder = 'CEP';
  inputCep.setAttribute('onblur', 'getEnderecoPorCep(this.value, id)');

  $("#cep" + countEnderecos).mask("00000-000");

  divCol1.appendChild(inputCep);

  let divCol2 = document.createElement('div');
  divCol2.className = 'col-8';

  divRow1.appendChild(divCol2);

  let inputRua = document.createElement('input');
  inputRua.className = 'form-control';
  inputRua.type = 'text';
  inputRua.name = 'rua' + countEnderecos;
  inputRua.id = 'rua' + countEnderecos;
  inputRua.placeholder = 'Rua';

  divCol2.appendChild(inputRua); 
  
  let divColN = document.createElement('div');
  divColN.className = 'col-1';

  divRow1.appendChild(divColN);

  let inputNumero = document.createElement('input');
  inputNumero.className = 'form-control';
  inputNumero.type = 'text';
  inputNumero.name = 'numero' + countEnderecos;
  inputNumero.id = 'numero' + countEnderecos;
  inputNumero.placeholder = 'Nº';

  divColN.appendChild(inputNumero); 

  let divRow2 = document.createElement('div');
  divRow2.className = 'row justify-content-center';

  let divCol3 = document.createElement('div');
  divCol3.className = 'col-4';

  let inputBairro = document.createElement('input');
  inputBairro.className = 'form-control';
  inputBairro.type = 'text';
  inputBairro.name = 'bairro' + countEnderecos;
  inputBairro.id = 'bairro' + countEnderecos;
  inputBairro.placeholder = 'Bairro';

  divCol3.appendChild(inputBairro);

  let divCol4 = document.createElement('div');
  divCol4.className = 'col-6';

  let inputCidade = document.createElement('input');
  inputCidade.className = 'form-control';
  inputCidade.type = 'text';
  inputCidade.name = 'cidade' + countEnderecos;
  inputCidade.id = 'cidade' + countEnderecos;
  inputCidade.placeholder = 'Cidade';

  divCol4.appendChild(inputCidade);

  let divCol5 = document.createElement('div');
  divCol5.className = 'col-2';

  let inputUF = document.createElement('input');
  inputUF.className = 'form-control';
  inputUF.type = 'text';
  inputUF.name = 'uf' + countEnderecos;
  inputUF.id = 'uf' + countEnderecos;
  inputUF.placeholder = 'UF';

  divCol5.appendChild(inputUF);

  divRow2.appendChild(divCol3);
  divRow2.appendChild(divCol4);
  divRow2.appendChild(divCol5);

  divContent.appendChild(divRow1);
  divContent.appendChild(divRow2);

  document.getElementById('maisEndereco').appendChild(divContent)

}