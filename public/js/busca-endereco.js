function getEnderecoPorCep(cep, id) { 
  let campoId = id.replace('cep', ''); 
  let url = `https://viacep.com.br/ws/${cep}/json/unicode/`

  let xmlHttp = new XMLHttpRequest()
  xmlHttp.open('GET', url)

  xmlHttp.onreadystatechange = () => {
    if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let dadosJSONText = xmlHttp.responseText
      let dadosJSONObj = JSON.parse(dadosJSONText)

      document.getElementById('rua' + campoId).value = dadosJSONObj.logradouro
      document.getElementById('bairro' + campoId).value = dadosJSONObj.bairro
      document.getElementById('cidade' + campoId).value = dadosJSONObj.localidade
      document.getElementById('uf' + campoId).value = dadosJSONObj.uf
    }
  }
  
  xmlHttp.send()
}