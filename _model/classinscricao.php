q<?php
class Inscricao {
    //metodo construtor
    private $inscricao,$idcurso,$idaluno,$statuspgto,$datainscricao,$desconto,$chave;
    private $nomeCurso,$descricao,$previsao,$carga,$totaula,
            $valor,$instrutor,$vagas;
    private $db,$id,$nome,$cpf,$rg,$email,$nascimento,$sexo,$escolaridade,$rua,
            $n,$complemento,$bairro,$cidade,$uf,$tel,$cel,$senha,$cep,$profissao; 
    public function __construct(\pdo $db){
        $this->db = $db;
    }
    public function find($idaluno,$idcurso){
        //$query = "select * from inscricoes where idaluno=:idaluno and idcurso=:idcurso;";
        $query = "select * from ((cadastroalunos inner join inscricoes on "
                . "cadastroalunos.idaluno=inscricoes.idaluno) "
                . "inner join cursosenter on cursosenter.idcurso=inscricoes.idcurso)"
                . "where cadastroalunos.idaluno=:idaluno and cursosenter.idcurso=:idcurso order by nomealuno";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idaluno", $idaluno);
        $stmt->bindValue(":idcurso", $idcurso);
        $stmt->execute();         
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function findinscricoes($idaluno){
        //$query = "select * from inscricoes where idaluno=:idaluno and idcurso=:idcurso;";
        $query = "select * from ((cadastroalunos inner join inscricoes on "
                . "cadastroalunos.idaluno=inscricoes.idaluno) "
                . "inner join cursosenter on cursosenter.idcurso=inscricoes.idcurso)"
                . "where cadastroalunos.idaluno=:idaluno order by nomealuno";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idaluno", $idaluno);
        $stmt->execute();         
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function findcurso($idcurso){
        //$query = "select * from inscricoes where idaluno=:idaluno and idcurso=:idcurso;";
        $query = "select * from ((cadastroalunos inner join inscricoes on "
                . "cadastroalunos.idaluno=inscricoes.idaluno) "
                . "inner join cursosenter on cursosenter.idcurso=inscricoes.idcurso)"
                . "where cursosenter.idcurso=:idcurso order by nomealuno";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idcurso", $idcurso);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
        public function contarinscritos($idcurso){
        //$query = "select * from inscricoes where idaluno=:idaluno and idcurso=:idcurso;";
        $query = "select count(*) from ((cadastroalunos inner join inscricoes on "
                . "cadastroalunos.idaluno=inscricoes.idaluno) "
                . "inner join cursosenter on cursosenter.idcurso=inscricoes.idcurso)"
                . "where cursosenter.idcurso=:idcurso";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idcurso", $idcurso);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function inscrAluno($idaluno){
        $query = "select * from ((cadastroalunos inner join inscricoes on "
                . "cadastroalunos.idaluno=inscricoes.idaluno) "
                . "inner join cursosenter on cursosenter.idcurso=inscricoes.idcurso)"
                . "where cadastroalunos.idaluno=:idaluno";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":idaluno", $idaluno);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function inscrNum($num){
        $query = "select * from ((cadastroalunos inner join inscricoes on "
                . "cadastroalunos.idaluno=inscricoes.idaluno) "
                . "inner join cursosenter on cursosenter.idcurso=inscricoes.idcurso)"
                . "where inscricoes.idinscricao=:num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":num", $num);
        $stmt->execute();         
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function listar() {
        $query = "select * from inscricoes;";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function inserir() {
        $query = "INSERT INTO `inscricoes`(`idcurso`,`idaluno` , `datainscricao` ,`statuspgto`,`desconto`,`chave`) 
      VALUES (:idcurso,:idaluno,:datainscricao,:statuspgto,default,:chave)";
        $data = date("d/m/Y");
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':idcurso',$this->getIdcurso());
        $stmt->bindValue(':idaluno',$this->getIdaluno());
        $stmt->bindValue(':datainscricao',$data);
        $stmt->bindValue(':statuspgto',$this->getStatuspgto());
        $stmt->bindValue(':chave',$this->getChave());
        $stmt->execute();
    }
    public function alterar() {
        $query = "UPDATE `inscricoes` SET `statuspgto`=:statuspgto,`desconto`=:desconto,`idcurso`=:curso WHERE `idinscricao`=:num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':num',$this->getInscricao());
        $stmt->bindValue(':statuspgto',$this->getStatuspgto());
        $stmt->bindValue(':desconto',$this->getDesconto());
        $stmt->bindValue(':curso',$this->getIdcurso());
        $stmt->execute();
    }
    public function deletar() {
        $query = "delete from inscricoes where `idinscricao`=:num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':num', $this->getInscricao());
        $stmt->execute();
    }
    public function listarArquivos($num) {
        $query = "select * from (arquivos inner join cursosenter on cursosenter.idcurso = arquivos.idcurso) where arquivos.idaluno=:num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':num', $num);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function statusPresenca($num) {
        $query = "SELECT `Inscricao`, `aula`, `data`, `tipo` 
        FROM (`chamada` INNER JOIN `inscricoes` On SUBSTRING(`chamada`.`Inscricao`,2,10)=`inscricoes`.`idinscricao`) 
        WHERE `inscricoes`.`idinscricao`=:num";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':num', $num);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getInscricao() {
        return $this->inscricao;
    }

    function getIdcurso() {
        return $this->idcurso;
    }

    function getIdaluno() {
        return $this->idaluno;
    }

    function getStatuspgto() {
        return $this->statuspgto;
    }

    function setInscricao($inscricao) {
        $this->inscricao = $inscricao;
        return $this;
    }

    function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
        return $this;
    }

    function setIdaluno($idaluno) {
        $this->idaluno = $idaluno;
        return $this;
    }

    function setStatuspgto($statuspgto) {
        $this->statuspgto = $statuspgto;
        return $this;
    }
    function getDatainscricao() {
        return $this->datainscricao;
    }

    function setDatainscricao($datainscricao) {
        $this->datainscricao = $datainscricao;
        return $this;
    }
    function getNomeCurso() {
        return $this->nomeCurso;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getPrevisao() {
        return $this->previsao;
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

    function getInstrutor() {
        return $this->instrutor;
    }

    function getVagas() {
        return $this->vagas;
    }

    function getDb() {
        return $this->db;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function getEmail() {
        return $this->email;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getEscolaridade() {
        return $this->escolaridade;
    }

    function getRua() {
        return $this->rua;
    }

    function getN() {
        return $this->n;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function getTel() {
        return $this->tel;
    }

    function getCel() {
        return $this->cel;
    }

    function getSenha() {
        return $this->senha;
    }

    function getCep() {
        return $this->cep;
    }

    function getProfissao() {
        return $this->profissao;
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

    function setPrevisao($previsao) {
        $this->previsao = $previsao;
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

    function setInstrutor($instrutor) {
        $this->instrutor = $instrutor;
        return $this;
    }

    function setVagas($vagas) {
        $this->vagas = $vagas;
        return $this;
    }

    function setDb($db) {
        $this->db = $db;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    function setRg($rg) {
        $this->rg = $rg;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
        return $this;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
        return $this;
    }

    function setEscolaridade($escolaridade) {
        $this->escolaridade = $escolaridade;
        return $this;
    }

    function setRua($rua) {
        $this->rua = $rua;
        return $this;
    }

    function setN($n) {
        $this->n = $n;
        return $this;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
        return $this;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
        return $this;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
        return $this;
    }

    function setUf($uf) {
        $this->uf = $uf;
        return $this;
    }

    function setTel($tel) {
        $this->tel = $tel;
        return $this;
    }

    function setCel($cel) {
        $this->cel = $cel;
        return $this;
    }

    function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }

    function setCep($cep) {
        $this->cep = $cep;
        return $this;
    }

    function setProfissao($profissao) {
        $this->profissao = $profissao;
        return $this;
    }
    function getChave() {
        return $this->chave;
    }

    function setChave($chave) {
        $this->chave = $chave;
        return $this;
    }
    function getDesconto() {
        return $this->desconto;
    }
    
    function setDesconto($desconto) {
        if($desconto<0 || $desconto>1){
            $desconto=1;
        };
        $this->desconto = $desconto;
        return $this;
    }
}
?>