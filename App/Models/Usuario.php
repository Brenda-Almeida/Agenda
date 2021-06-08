<?php 

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {

  private $id;
  private $nome;
  private $email;
  private $senha;

  public function __get($attr) {
    return $this->$attr;
  }

  public function __set($attr, $value) {
    return $this->$attr = $value;
  }

  // cadastrar 

  public function salvar() {
    $query = "INSERT INTO usuarios(nome, email, senha)VALUES(:nome, :email, :senha)";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':nome', $this->__get('nome'));
    $stmt->bindValue(':email', $this->__get('email'));
    $stmt->bindValue(':senha', $this->__get('senha')); 

    $stmt->execute();

    return $this;
  }

  // Validação dos campos de cadastros
  public function validarCadastro() {
    $valido = true;
    
    // Verificando se o tamanho é consistente 
    if(strlen($this->__get('nome')) < 3){
      $valido = false;
    }
    if(strlen($this->__get('email')) < 8){
      $valido = false;
    }
    if(strlen($this->__get('senha')) < 3){
      $valido = false;
    }

    return $valido;
  }

  // recuperar usuario por e-mail 
  public function getUsuarioPorEmail() {
    $query = "SELECT nome, email FROM usuarios WHERE email = :email";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':email', $this->__get('email'));
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function autenticar() {
    $query = "SELECT id, nome, email FROM usuarios WHERE email = :email AND senha = :senha";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':email', $this->__get('email'));
    $stmt->bindValue(':senha', $this->__get('senha'));
    $stmt->execute();

    $usuario = $stmt->fetch();

    if($usuario){
      $this->__set('id', $usuario['id']);
      $this->__set('nome', $usuario['nome']);
    }
  }

}

?>