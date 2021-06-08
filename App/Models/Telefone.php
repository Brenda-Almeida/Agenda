<?php 

namespace App\Models;

use MF\Model\Model;

class Telefone extends Model {
  private $id;
  private $numero;
  private $id_contato;

  public function __get($attr) {
    return $this->$attr;
  }

  public function __set($attr, $value) {
    return $this->$attr = $value;
  }

  public function salvar() {

    $query = "INSERT INTO telefones(numero, id_contato)VALUES(:numero, :id_contato)";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':numero', $this->__get('numero'));
    $stmt->bindValue(':id_contato', $this->__get('id_contato'));
    $stmt->execute();

    return $this;
  } 

  public function getTelefonesPorId() {
    $query = "SELECT numero FROM telefones WHERE id_contato = :id_contato";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_contato', $this->__get('id_contato'));
    $stmt->execute();    

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
?>