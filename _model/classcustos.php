<?php
/**
 * Description of Custo
 * @author welington
 */
class Custos {
    //metodo construtor
    private $db,$idcusto,$idcurso, $produto, $qtd, $un, $valor, $total;
    
    public function __construct(\pdo $db) {
        $this->db=$db;
    }
    //query's do sql
    public function find($idcurso){
        $query = "select * from (custos inner join cursosenter on custos.idcurso = cursosenter.idcurso) "
                . "where  cursosenter.idcurso=:idcurso order by produto";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idcurso", $idcurso);
        $stmt->execute();         
        return $stmt->fetchALL(\PDO::FETCH_ASSOC);
    }
    public function findCusto($idcusto){
        $query = "select * from (custos inner join cursosenter on custos.idcurso = cursosenter.idcurso) "
                . "where  custos.idcusto=:idcusto";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idcusto", $idcusto);
        $stmt->execute();         
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function listar() {
        $query = "select * from custos;";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function inserir() {
        $query = "INSERT INTO `custos`(`idcurso`, `produto`, `qtd`, `un`, `datalancamento`, `valorunit`, `total`) 
      VALUES (:idcurso,:produto,:qtd,:un,:datalancamento,:valor,:total)";
        $data = date("d/m/Y");
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':idcurso',$this->getIdcurso());
        $stmt->bindValue(':produto',$this->getProduto());
        $stmt->bindValue(':qtd',$this->getQtd());
        $stmt->bindValue(':un',$this->getUn());
        $stmt->bindValue(':datalancamento',$data);
        $stmt->bindValue(':valor',$this->getValor());
        $stmt->bindValue(':total',$this->getTotal());
        $stmt->execute();
    }
    public function alterar() {
        $query = "UPDATE `custos` SET `idcurso`=:idcurso,`produto`=:produto,"
            . "`qtd`=:qtd,`un`=:un,`datalancamento`=:datalancamento,"
                . "`valorunit`=:valor,`total`=:total WHERE `idcusto`=:idcusto";
        $data = date("d/m/Y");
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':idcurso',$this->getIdcurso());
        $stmt->bindValue(':produto',$this->getProduto());
        $stmt->bindValue(':qtd',$this->getQtd());
        $stmt->bindValue(':un',$this->getUn());
        $stmt->bindValue(':datalancamento',$data);
        $stmt->bindValue(':valor',$this->getValor());
        $stmt->bindValue(':total',$this->getTotal());
        $stmt->bindValue(':idcusto',$this->getIdcusto());
        $stmt->execute();
    }
    public function deletar() {
        $query = "delete from custos where `idcusto`=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->getIdcusto());
        $stmt->execute();
    }
    //metodos acessores
    function getIdcurso() {
        return $this->idcurso;
    }

    function getProduto() {
        return $this->produto;
    }

    function getQtd() {
        return $this->qtd;
    }

    function getUn() {
        return $this->un;
    }

    function getValor() {
        return $this->valor;
    }

    function getTotal() {
        return $this->total;
    }

    function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
        return$this;
    }

    function setProduto($produto) {
        $this->produto = $produto;
        return$this;
    }

    function setQtd($qtd) {
        if($qtd<=0){
          $qtd =1;  
        }
        $this->qtd = $qtd;
        return$this;
    }

    function setUn($un) {
        $this->un = $un;
        return$this;
    }

    function setValor($valor) {
        if($valor<=0){
           $valor =1; 
        }
        $this->valor = $valor;
        return$this;
    }

    function setTotal($total) {
        if($total<=0){
           $total=1; 
        }
        $this->total = $total;
        return$this;
    }
    function getIdcusto() {
        return $this->idcusto;
    }

    function setIdcusto($idcusto) {
        $this->idcusto = $idcusto;
    }
}