<?php
class Arquivos {
    //atributos
    private $db,$arquivo,$data,$idaluno,$idcurso,$inscricao,$tipo;
    //metodo construtor
    
    public function __construct(\PDO $db) {
        $this->db = $db;
    }
    //metodos modificadores
    public function inserir() {
        $query = "INSERT INTO `arquivos` (`arquivo`, `data_envio` ,`idaluno`, `idcurso`, `idinscricao`, `tipo`) 
                    VALUES (:arquivo, now() ,:idaluno, :idcurso, :idinscricao, :tipo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':arquivo',$this->getArquivo());
        $stmt->bindValue(':idaluno',$this->getIdaluno());
        $stmt->bindValue(':idcurso',$this->getIdcurso());
        $stmt->bindValue(':idinscricao',$this->getInscricao());
        $stmt->bindValue(':tipo',$this->getTipo());
        $stmt->execute();
    }
    public function deletar($num) {
        $query = "delete from `arquivos` where `idarq`=:num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':num', $num);
        $stmt->execute();
    }
    public function contarArquivos($id){
        //$query = "select * from inscricoes where idaluno=:idaluno and idcurso=:idcurso;";
        $query = "select count(*) from arquivos where arquivos.idaluno=1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idaluno", $id);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listaArquivos(){
        $query = "select arquivos.idarq, arquivos.arquivo , cadastroalunos.nomealuno , arquivos.tipo , arquivos.data_envio "
                . "from (arquivos inner join cadastroalunos on cadastroalunos.idaluno = arquivos.idaluno) where arquivos.idaluno=:idaluno";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idaluno", $this->getIdaluno());
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listaArquivosAluno(){
        $query = "select arquivos.idarq, arquivos.arquivo , cadastroalunos.nomealuno , arquivos.tipo , arquivos.data_envio "
                . "from (arquivos inner join cadastroalunos on cadastroalunos.idaluno = arquivos.idaluno) "
                . "where arquivos.tipo<>'Comprovante Pagamento' and arquivos.idaluno=:idaluno ORDER BY arquivos.data_envio DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idaluno", $this->getIdaluno());
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listaTodosArquivos(){
        $query = "select arquivos.idarq, arquivos.arquivo , cadastroalunos.nomealuno , arquivos.tipo , arquivos.data_envio "
                . "from (arquivos inner join cadastroalunos on cadastroalunos.idaluno = arquivos.idaluno) ORDER BY arquivos.data_envio DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    //metodos acessores
    function getArquivo() {
        return $this->arquivo;
    }

    function getData() {
        return $this->data;
    }

    function getIdaluno() {
        return $this->idaluno;
    }

    function getIdcurso() {
        return $this->idcurso;
    }

    function getInscricao() {
        return $this->inscricao;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
        return $this;
    }

    function setData($data) {
        $this->data = $data;
        return $this;
    }

    function setIdaluno($idaluno) {
        $this->idaluno = $idaluno;
        return $this;
    }

    function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
        return $this;
    }

    function setInscricao($inscricao) {
        $this->inscricao = $inscricao;
        return $this;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }
}
