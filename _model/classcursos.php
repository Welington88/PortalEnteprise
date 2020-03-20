<?php 
class Cursos {
    //metodo construtor
    private $id,$nomeCurso,$descricao,$previsao,$carga,$totaula,
            $valor,$instrutor,$vagas;
    public function __construct(\pdo $db){
        $this->db = $db;
    }
    public function find($id){
        $query = "select * from cursosenter where idcurso=:id;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();         
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function consult(){
        $query = "select * from cursosenter;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listar() {
        $query = "select * from cursosenter;";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function inserir() {
        $query = "INSERT INTO `cursosenter`(`nomecurso`, `descricao`, `instrutor`, "
        . "`previsao`, `carga`, `totaulas`, `vagas`, `valor`) "
        . "VALUES (:nomeCurso, :descricao, :instrutor, :previsao, :carga, "
        . ":totaula, :vagas, :valor);";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nomeCurso',$this->getNomeCurso());
        $stmt->bindValue(':descricao',$this->getDescricao());
        $stmt->bindValue(':instrutor',$this->getInstrutor());
        $stmt->bindValue(':previsao',$this->getPrevisao());
        $stmt->bindValue(':carga',$this->getCarga());
        $stmt->bindValue(':totaula',$this->getTotaula());
        $stmt->bindValue(':vagas',$this->getVagas());
        $stmt->bindValue(':valor',$this->getValor());
        $stmt->execute();
    }
    public function alterar() {
        $query = "update cursosenter set `nomecurso`=:nomeCurso,"
                . "`descricao`=:descricao,`instrutor`=:instrutor, "
                . "`previsao`=:previsao, `carga`=:carga ,`totaulas`=:totaula,"
                . "`vagas`=:vagas,`valor`=:valor where `idcurso`=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id',$this->getId());
        $stmt->bindValue(':nomeCurso',$this->getNomeCurso());
        $stmt->bindValue(':descricao',$this->getDescricao());
        $stmt->bindValue(':instrutor',$this->getInstrutor());
        $stmt->bindValue(':previsao',$this->getPrevisao());
        $stmt->bindValue(':carga',$this->getCarga());
        $stmt->bindValue(':totaula',$this->getTotaula());
        $stmt->bindValue(':vagas',$this->getVagas());
        $stmt->bindValue(':valor',$this->getValor());
        if($stmt->execute()){
            return true;
        };
    }
    public function numvagas($id,$vagas) {
        $query = "update `cursosenter` set `vagas`=:vagas where `idcurso`=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':vagas',$vagas);
        $stmt->execute();
    }
    public function deletar($id) {
        $query = "delete from cursosenter where `idcurso`=:id;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        if($stmt->execute()){
            return true;
        };
    }
    
    function getId() {
        return $this->id;
    }

    function getNomeCurso() {
        return $this->nomeCurso;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getCarga() {
        return $this->carga;
    }

    function getTotaula() {
        return $this->totaula;
    }

    function getValor() {
        return $this->valor;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNomeCurso($nomeCurso) {
        $this->nomeCurso = $nomeCurso;
        return $this;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    function setCarga($carga) {
        $this->carga = $carga;
        return $this;
    }

    function setTotaula($totaula) {
        $this->totaula = $totaula;
        return $this;
    }

    function setValor($valor) {
        $this->valor = $valor;
        return $this;
    }
    
    function getPrevisao() {
        return $this->previsao;
    }

    function setPrevisao($previsao) {
        $this->previsao = $previsao;
        return $this;
    }
    function getInstrutor() {
        return $this->instrutor;
    }

    function setInstrutor($instrutor) {
        $this->instrutor = $instrutor;
        return $this;
    }
    function getVagas() {
        return $this->vagas;
    }

    function setVagas($vagas) {
        $this->vagas = $vagas;
    }
}
?>