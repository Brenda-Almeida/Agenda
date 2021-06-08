<?php 

namespace App\Models;

use MF\Model\Model;
// use MF\Model\Container;

class Contato extends Model {
  private $id;
  private $id_usuario;
  private $nome;
  private $email;
  
  public function __get($attr) {
    return $this->$attr;
  }

  public function __set($attr, $value) {
    return $this->$attr = $value;
  }

  // salvar contato
  public function salvar() {

    $query = "INSERT INTO contatos(id_usuario, nome, email)VALUES(:id_usuario, :nome, :email)";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
    $stmt->bindValue(':nome', $this->__get('nome'));
    $stmt->bindValue(':email', $this->__get('email'));
    $stmt->execute();

    return $this;
  }

  public function getContatoPorNome() {
    $query = "SELECT id, nome FROM contatos WHERE nome = :nome AND id_usuario = :id_usuario";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':nome', $this->__get('nome'));
    $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
    $stmt->execute();

    $contato = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    if($contato) {
      $this->__set('id', $contato[0]['id']);
    }

    return $contato;
  }

  public function getContatoPorId() {
    $query = "SELECT nome, email FROM contatos WHERE id = :id";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id', $this->__get('id'));
    $stmt->execute();  

    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function listarContatos() {
    $query = "SELECT id, nome FROM contatos WHERE id_usuario = :id_usuario ORDER BY nome";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function retornaPesquisa($key) {
    $query = "SELECT id, nome FROM contatos WHERE nome LIKE '%$key%' AND id_usuario = :id_usuario";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function apagarContato() {
    $query = "DELETE FROM contatos WHERE id = :id";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id', $this->__get('id'));
    $stmt->execute();

    return $this;
  }
}
?>