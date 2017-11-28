<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Documento de funções da Classe Crud_model
 * @author Luis Eduardo Oliveira
 * @version 0.1
 * @package CI_Model
 * @copyright Copyright (c) 2014 - 2017
 */
class Crud_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  // Variável que define o nome da tabela
  public $tabela = "";

  /**
  * Insere um registro na tabela
  *
  * @param array $data Dados a serem inseridos
  *
  * @return boolean
  */
  public function Inserir($data) {
    if(!isset($data))
      return false;

    return $this->db->insert($this->tabela, $data);
  }

  /**
  * Recupera um registro a partir de um ID
  *
  * @param integer $id ID do registro a ser recuperado
  *
  * @return array
  */
  public function GetById($id) {
    if(is_null($id))
      return false;

    $this->db->where('id', $id);
    $query = $this->db->get($this->tabela);
    
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return false;
    }
  }

  /**
  * Recupera um registro a partir de uma condicao
  *
  * @param string $condicao string do where para o sql
  *
  * @return array
  */
  public function GetByCon($condicao) {
    if(is_null($condicao))
      return false;

    $this->db->where($condicao);
    $query = $this->db->get($this->tabela);
    
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return false;
    }
  }

    /**
     * Recupera um registro a partir de um login e senha
     *
     * @param string $login Login do registro a ser recuperado
     *
     * @param string $senha Senha do registro a ser recuperado
     *
     * @return array
     */
    public function GetByLoginSenha($login, $senha) {
        if(is_null($login) or is_null($senha))
            return false;

        $sql = ("SELECT * FROM usuario WHERE login = ? AND senha = ?");
        $query = $this->db->query($sql, array($login, $senha));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

  /**
  * Lista todos os registros da tabela
  *
  * @param string $sort Campo para ordenação dos registros
  *
  * @param string $order Tipo de ordenação: ASC ou DESC
  *
  * @return array
  */
  public function GetAll($sort = 'id', $order = 'asc') {
    $this->db->order_by($sort, $order);
    $query = $this->db->get($this->tabela);

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }

  }

  /**
  * Atualiza um registro na tabela
  *
  * @param integer $int ID do registro a ser atualizado
  *
  * @param array $data Dados a serem inseridos
  *
  * @return boolean
  */
  public function Atualizar($id, $data) {
    if(is_null($id) || !isset($data))
      return false;

    $this->db->where('id', $id);

    return $this->db->update($this->tabela, $data);
  }

  /**
  * Remove um registro na tabela
  *
  * @param $condicao, condicao delimitadora no where
  *
  * @return boolean
  */
  public function Excluir($condicao)
  {
      if (is_null($condicao))
          return false;

      $this->db->where($condicao);
      return $this->db->delete($this->tabela);

  }

  /**
     * Define os resultados que serão retornados para a Listagem e paginação
     *
     * @param $maximo Número máximo de registros por página
     *
     * @param $inicio Primeiro registro da página
     *
     * @param $condicao Indica o valor da comparação no parametro where
     *
     * @return mixed 
     */
    public function Listar($maximo, $inicio, $condicao){
        $this->db->from($this->tabela);
        $this->db->limit($maximo, $inicio);

        if(isset($condicao)){
          $this->db->where($condicao);
        }

        $resultado = $this->db->get()->result();
        
        return $resultado;
        
    }

    /**
     * Conta quantos registros existem nessa tabela
     *
     * @param $condicao Indica o valor da comparação no parametro where
     *
     * @return mixed
     */
    public function contaRegistros($condicao)
    {
        if(isset($condicao)){
          $this->db->where($condicao);
        }

        $this->db->where($condicao);
        $resultado = $this->db->count_all_results($this->tabela);

        return $resultado;
    }

}
