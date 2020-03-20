<?php
class Aluno {
    //metodo construtor
    private $db,$id,$nome,$cpf,$rg,$email,$nascimento,$sexo,$escolaridade,$rua,
            $n,$complemento,$bairro,$cidade,$uf,$tel,$cel,$senha,$cep,$profissao; 
    public function __construct(\pdo $db){
        $this->db = $db;
    }
    public function find($id){
        $query = "select * from cadastroalunos where idaluno=:id;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();         
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function login($email){
        $query = "select * from cadastroalunos where email=:email;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function listar() {
        $query = "select * from cadastroalunos order by nomealuno;";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function inserir() {
        $query = "INSERT INTO `cadastroalunos`(`nomealuno`,`cpf` ,`email`,`tel`, `cel`,`senha`) 
      VALUES (:nome,:cpf,:email,:tel,:cel,:senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome',$this->getNome());
        $stmt->bindValue(':cpf',$this->getCpf());
        $stmt->bindValue(':email',$this->getEmail());
        $stmt->bindValue(':tel',$this->getTel());
        $stmt->bindValue(':cel',$this->getCel());
        $stmt->bindValue(':senha',$this->getSenha());
        $stmt->execute();
    }
    public function alterar() {
        $query = "update cadastroalunos set nomealuno=:nome,cpf=:cpf,"
                . "rg=:rg,email=:email,nascimento=:nascimento,"
                . "sexo=:sexo,escolaridade=:escolaridade, profissao=:profissao,rua=:rua,n=:n,"
                . "complemento=:complemento,bairro=:bairro,"
                    . "cidade=:cidade,uf=:uf,cep=:cep, tel=:tel, cel=:cel"
                    . " where idaluno=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id',$this->getId());
        $stmt->bindValue(':nome',$this->getNome());
        $stmt->bindValue(':cpf',$this->getCpf());
        $stmt->bindValue(':rg',$this->getRg());
        $stmt->bindValue(':email',$this->getEmail());
        $stmt->bindValue(':nascimento',$this->getNascimento());
        $stmt->bindValue(':sexo',$this->getSexo());
        $stmt->bindValue(':escolaridade',$this->getEscolaridade());
        $stmt->bindValue(':profissao', $this->getProfissao());
        $stmt->bindValue(':rua',$this->getRua());
        $stmt->bindValue(':n',$this->getN());
        $stmt->bindValue(':complemento',$this->getComplemento());
        $stmt->bindValue(':bairro',$this->getBairro());
        $stmt->bindValue(':cidade',$this->getCidade());
        $stmt->bindValue(':uf',$this->getUf());
        $stmt->bindValue(':cep', $this->getCep());
        $stmt->bindValue(':tel',$this->getTel());
        $stmt->bindValue(':cel',$this->getCel());
        if($stmt->execute()){
            return true;
        };
    }
    public function alterarSenha() {
        $query = "UPDATE `cadastroalunos` SET `senha` =:senha WHERE `cadastroalunos`.`idaluno` =:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id',$this->getId());
        $stmt->bindValue(':senha',$this->getSenha());
        if($stmt->execute()){
            return true;
        }
    }
    public function alterarRoot() {
        $query = "update cadastroalunos set nomealuno=:nome,cpf=:cpf,"
                . "rg=:rg,email=:email,nascimento=:nascimento,"
                . "sexo=:sexo,escolaridade=:escolaridade, profissao=:profissao,rua=:rua,n=:n,"
                . "complemento=:complemento,bairro=:bairro,"
                . "cidade=:cidade,uf=:uf,cep=:cep, tel=:tel,cel=:cel "
                . "where idaluno=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id',$this->getId());
        $stmt->bindValue(':nome',$this->getNome());
        $stmt->bindValue(':cpf',$this->getCpf());
        $stmt->bindValue(':rg',$this->getRg());
        $stmt->bindValue(':email',$this->getEmail());
        $stmt->bindValue(':nascimento',$this->getNascimento());
        $stmt->bindValue(':sexo',$this->getSexo());
        $stmt->bindValue(':escolaridade',$this->getEscolaridade());
        $stmt->bindValue(':profissao', $this->getProfissao());
        $stmt->bindValue(':rua',$this->getRua());
        $stmt->bindValue(':n',$this->getN());
        $stmt->bindValue(':complemento',$this->getComplemento());
        $stmt->bindValue(':bairro',$this->getBairro());
        $stmt->bindValue(':cidade',$this->getCidade());
        $stmt->bindValue(':uf',$this->getUf());
        $stmt->bindValue(':cep', $this->getCep());
        $stmt->bindValue(':tel',$this->getTel());
        $stmt->bindValue(':cel',$this->getCel());
        if($stmt->execute()){
            return true;
        };
    }
    public function deletar($id) {
        $query = "delete from cadastroalunos where idaluno=:id;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        if($stmt->execute()){
            return true;
        };
    }
    public function resetarSenha($id){
        $senha = password_hash("1234", PASSWORD_DEFAULT);
        $query = "update `cadastroalunos` set `senha`=:senha where `idaluno`=:id;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
    public function resetarSenhaEmail($email,$senha){
        $senhaForte = password_hash($senha, PASSWORD_DEFAULT);
        $query = "update `cadastroalunos` set `senha`=:senha where email=:email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':senha', $senhaForte);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }
    public function consultarSenha($email){
        $query = "select * from cadastroalunos where email=:email;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();         
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function contarEmail($email) {
       $query = "select * from cadastroalunos where email=:email;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();         
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($resultado['email']<>""){return 1;}else{
        return 0;}
    }
    public function contarCPF($cpf) {
       $query = "select * from cadastroalunos where cpf=:cpf;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":cpf", $cpf);
        $stmt->execute();         
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($resultado['cpf']<>""){return 1;}else{
        return 0;}
    }
    public function arrumarCPF($cpf){
        $cpf = str_replace("-","",$cpf);
	$cpf = str_replace(".","",$cpf);
	$cpf = strrev($cpf);
	$vetor = str_split($cpf);
	var_dump($vetor);
	$cpf = "";
	$c =0;
	foreach($vetor as $v){
		switch($c){
		case 2:
			$cpf.= "-".$v;
			break;
		case 5:
			$cpf.= ".".$v;
			break;
		case 8:
			$cpf.= ".".$v;
			break;
		default:
			$cpf.= $v;
		}
		$c++;
	}
        $cpf = strrev($cpf);
        return $cpf;
    }
    public function numCPF($cpf){
        $cpf = str_replace("-", "", $cpf);
        $cpf = str_replace(".", "", $cpf);
        return $cpf;
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
    function getEmail() {
        return $this->email;
    }
    function setDb($db) {
        $this->db = $db;
        return $this;
    }
    function setId($id) {
        $this->id = $id;
        return $this;
    }
    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    function getSenha() {
        return $this->senha;
    }
    function setSenha($senha) {
        $this->senha = $senha;
        return $this->senha;
    }
    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
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

    function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    function setRg($rg) {
        $this->rg = $rg;
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
    function getCep() {
        return $this->cep;
    }

    function getProfissao() {
        return $this->profissao;
    }

    function setCep($cep) {
        $this->cep = $cep;
        return $this;
    }

    function setProfissao($profissao) {
        $this->profissao = $profissao;
        return $this;
    }
}
?>