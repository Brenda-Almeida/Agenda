<?php 

namespace App\Models;

use MF\Model\Model;

class Endereco extends Model {
  private $id;
  private $cep;
  private $rua;
  private $numero;
  private $bairro;
  private $cidade;
  private $estado;
  private $id_contato;

  public function __get($attr) {
    return $this->$attr;
  }

  public function __set($attr, $value) {
    return $this->$attr = $value;
  }

  public function salvar() {

    $query = "INSERT INTO enderecos(cep, rua, numero, bairro, cidade, estado, id_contato)VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :id_contato)";

    $stmt = $this->db->prepare($query);

    $stmt->bindValue(':cep', $this->__get('cep'));
    $stmt->bindValue(':rua', $this->__get('rua'));
    $stmt->bindValue(':numero', $this->__get('numero'));
    $stmt->bindValue(':bairro', $this->__get('bairro'));
    $stmt->bindValue(':cidade', $this->__get('cidade'));
    $stmt->bindValue(':estado', $this->__get('estado'));
    $stmt->bindValue(':id_contato', $this->__get('id_contato'));

    $stmt->execute();

    return $this;
  }

  public function getEnderecosPorId() {
   
    $query = "SELECT cep, rua, numero, bairro, cidade, estado FROM enderecos WHERE id_contato = :id_contato";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_contato', $this->__get('id_contato'));
    $stmt->execute();    

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
  }
}
?>