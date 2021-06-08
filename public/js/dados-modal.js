function abrirModal(id) {
  var dados = {
    id: id,
  };
  var nome = $('#nome-contato');
  var email = $('#email-contato'); 
  var telefone = $('#telefone-contato');
  
  $.ajax({
      url: '/listarModal',
      type: 'post',
      dataType: 'JSON',
      data: dados
    })
    .done(function(json) {
      nome.html(json['nome']);
      email.html(json['email']);
      telefone.html(json['telefone0']);

      document.getElementById('nomeInput').value = json['nome'];
      
      if(json['qtdTelefone'] > 1) {
        for(var i = 2; i <= json['qtdTelefone']; i++){
          let maisTelefones = document.createElement('div');
          maisTelefones.id = "telefone-modal" + i;
          document.getElementById('telefones-modal').appendChild(maisTelefones);
          var TelefoneContato = $('#telefone-modal' + i);
          TelefoneContato.html('<h5>' + json['telefone' + (i - 1)] + '</h5>');
        }
      }

      if(json['qtdEndereco'] > 0) {          
      for(var i = 1; i <= json['qtdEndereco']; i++){
        let maisEnderecos = document.createElement('div');
        maisEnderecos.id = "endereco-modal" + i;
        document.getElementById('enderecos-modal').appendChild(maisEnderecos);
        var enderecoContato = $('#endereco-modal' + i);
        enderecoContato.html('<br><h5>CEP: ' + json['cep' + (i - 1)] + '</h5><h5>Rua: ' + json['rua' + (i - 1)] + ', ' + json['numero' + (i - 1)] + '</h5><h5>Bairro: ' + json['bairro' + (i - 1)] + '</h5><h5>Cidade: ' + json['cidade' + (i - 1)] + '</h5><h5>UF: ' + json['estado' + (i - 1)] + '</h5>');
      }
    }       
    
    })
    .fail(function(jqXHR, textStatus, msg) {
      console.log("Erro ao Buscar Dados!!! ( " + msg + " )", "", "");
    }); 
}