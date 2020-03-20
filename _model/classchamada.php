<?php
/*Description of classchamada @author welington*/
class Chamada {
    //atributos
    private $id,$inscricao,$aula,$tipo,$dia;
    //metodo construtor
    public function __construct(\PDO $db) {
        $this->db = $db;
    }    
    //crud
    //metodos modificadores
    public function inserir() {
        $query = "INSERT INTO `chamada` (`Inscricao`, `aula`, `data`, `tipo`) 
                    VALUES (:inscricao, :aula , :dia, :tipo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':inscricao',$this->getInscricao());
        $stmt->bindValue(':aula',$this->getAula());
        $stmt->bindValue(':dia',$this->getDia());
        $stmt->bindValue(':tipo',$this->getTipo());
        $stmt->execute();
    }
    public function deletar($num) {
        $query = "delete from `chamada` where `id`=:num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':num', $num);
        $stmt->execute();
    }
    public function alterar() {
        $query = "UPDATE `chamada` SET `tipo`=:tipo WHERE `Inscricao`=:inscricao";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':inscricao',$this->getInscricao());
        //$stmt->bindValue(':aula',$this->getAula());
        //$stmt->bindValue(':dia',$this->getDia());
        $stmt->bindValue(':tipo',$this->getTipo());
        $stmt->execute();
    }
    public function statusAula($curso,$aula){
        $query = "SELECT `Inscricao`, `aula`, `data`, `tipo`, `inscricoes`.`idcurso`, `inscricoes`.`idaluno`
            FROM (`chamada` INNER JOIN `inscricoes` On SUBSTRING(`chamada`.`Inscricao`,2,10)=`inscricoes`.`idinscricao`) 
                WHERE `inscricoes`.`idcurso`=:status and `chamada`.`aula`=:aula";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':status',$curso);
        $stmt->bindValue(':aula',$aula);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function find($num){
        $query = "SELECT * FROM chamada WHERE Inscricao=" . $num;
        $stmt = $this->db->prepare($query);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function findCursos(){
        $query = "SELECT * FROM `cursosenter`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listaChamada($idcurso){
        $query = "SELECT inscricoes.idinscricao, inscricoes.idcurso,inscricoes.idaluno, "
                . "cadastroalunos.nomealuno,cursosenter.nomecurso, cursosenter.totaulas "
                . "FROM ((inscricoes INNER JOIN cursosenter ON inscricoes.idcurso=cursosenter.idcurso) "
                . "INNER JOIN cadastroalunos on cadastroalunos.idaluno=inscricoes.idaluno) WHERE inscricoes.idcurso=:idcurso ORDER BY cadastroalunos.nomealuno ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idcurso", $idcurso);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    function getId() {
        return $this->id;
    }

    function getInscricao() {
        return $this->inscricao;
    }

    function getAula() {
        return $this->aula;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getDia() {
        return $this->dia;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setInscricao($inscricao) {
        $this->inscricao = $inscricao;
        return $this;
    }

    function setAula($aula) {
        $this->aula = $aula;
        return $this;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    function setDia($dia) {
        $this->dia = $dia;
        return $this;
    }
}