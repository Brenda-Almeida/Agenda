<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
  
  public function main() {

    $this->validaAutenticacao();

    $contato = Container::getModel('contato');

    $contato->__set('id_usuario', $_SESSION['id']);

    $contatos = $contato->listarContatos();
    
    $this->view->contatos = $contatos;
    
    $this->view->contatoCadastrado = isset($_GET['contatoCadastrado']) ? $_GET['contatoCadastrado'] : "";
    $this->view->nomeContatoExistente = isset($_GET['nomeContatoExistente']) ? $_GET['nomeContatoExistente'] : "";

    $this->render('main');
    
  }

  public function salvarContato() {

    $this->validaAutenticacao();

    $contato = Container::getModel('contato');
    $contato->__set('nome', $_POST['nome']);
    $contato->__set('email', $_POST['email']);
    $contato->__set('id_usuario', $_SESSION['id']);

    if(count($contato->getContatoPorNome()) == 0){
      $contato->salvar();

      $idContato = $contato->getContatoPorNome();

      $telefone = Container::getModel('telefone');
      $telefone->__set('numero', $_POST['telefone1']);
      $telefone->__set('id_contato', $idContato[0]['id']);
      
      $telefone->salvar();        

      $countTelefones = 2;
      while($countTelefones > 0){
        if(isset($_POST['telefone' . $countTelefones])){
          $telefone->__set('numero', $_POST['telefone' . $countTelefones]);
          $telefone->salvar();
          $countTelefones++;
        }else {
          $countTelefones = 0;
        }
      }

      if(isset($_POST['cep1'])) {
        if($_POST['cep1'] != ''){
          $endereco = Container::getModel('endereco');

          $endereco->__set('cep', $_POST['cep1']);
          $endereco->__set('rua', $_POST['rua1']);
          $endereco->__set('numero', $_POST['numero1']);
          $endereco->__set('bairro', $_POST['bairro1']);
          $endereco->__set('cidade', $_POST['cidade1']);
          $endereco->__set('estado', $_POST['uf1']);
          $endereco->__set('id_contato', $idContato[0]['id']);

          $endereco->salvar();

          $countEndereco = 2;
          while($countEndereco > 0){
            if(isset($_POST['cep' . $countEndereco])){
              $endereco->__set('cep', $_POST['cep' . $countEndereco]);
              $endereco->__set('rua', $_POST['rua' . $countEndereco]);
              $endereco->__set('numero', $_POST['numero'  . $countEndereco]);
              $endereco->__set('bairro', $_POST['bairro'  . $countEndereco]);
              $endereco->__set('cidade', $_POST['cidade'  . $countEndereco]);
              $endereco->__set('estado', $_POST['uf'  . $countEndereco]);
  
              $endereco->salvar();
  
              $countEndereco++;
            }else {
              $countEndereco = 0;
            }
          }     
        }
      }
      header('Location: /main?contatoCadastrado=success');

    } else {
      header('Location: /main?nomeContatoExistente=erro');
    } 
  }

  public function pesquisar() {
    $this->validaAutenticacao();

    $key = $_POST['key'];

    $contato = Container::getModel('contato');
    $contato->__set('id_usuario', $_SESSION['id']);
    $result = $contato->retornaPesquisa($key);

    foreach($result as $cont){
      ?>
          <li>
              <a data-toggle="modal" data-target=".modalContato"><?php echo $cont['nome']; ?></a>
          </li>
      <?php 
    } 
  }

  public function listarModal() {
    $this->validaAutenticacao();

    $id_contato = $_POST['id'];

    $contato = Container::getModel('contato');
    $telefone = Container::getModel('telefone');
    $endereco = Container::getModel('endereco');

    $contato->__set('id', $id_contato);
    $telefone->__set('id_contato', $id_contato);
    $endereco->__set('id_contato', $id_contato);

    $cont = $contato->getContatoPorId();
    $telefones = $telefone->getTelefonesPorId();
    $enderecos = $endereco->getEnderecosPorId();
    
    if($cont){
      $json = array();
      $json['nome'] = $cont['nome'];
      $json['email'] = $cont['email'];
      foreach($telefones as $indice => $tel){
        $json['telefone' . $indice] = $tel['numero'];
        $json['qtdTelefone'] = $indice + 1;
      }
      if($endereco) {
        foreach($enderecos as $indice => $end){
          $json['cep' . $indice] = $end['cep'];
          $json['rua' . $indice] = $end['rua'];
          $json['numero' . $indice] = $end['numero'];
          $json['bairro' . $indice] = $end['bairro'];
          $json['cidade' . $indice] = $end['cidade'];
          $json['estado' . $indice] = $end['estado'];
          $json['qtdEndereco'] = $indice + 1;
        }
      }else {
        $json['qtdEndereco'] = 0;
      }
      echo json_encode($json);
    }else{
        echo false;
    }    

  }

  public function apagarContato() {
    $this->validaAutenticacao();
    
    $contato = Container::getModel('contato');
    $contato->__set('nome', $_POST['nomeInput']);
    $contato->__set('id_usuario', $_SESSION['id']);
    

    if(count($contato->getContatoPorNome()) > 0) {
      $contato->apagarContato();
    }

    header("Location: /main");

  }

  public function validaAutenticacao() {
    session_start();

    if(!isset($_SESSION) || $_SESSION['id'] == '') {
      header('Location: /login?login=erro');     
    }
  }

}
?>