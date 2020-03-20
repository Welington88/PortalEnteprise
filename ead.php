<?php session_start();//inicio da sessao 
 if(isset($_REQUEST['curso'])){
     $_SESSION['curso'] = $_REQUEST['curso'];
 }?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php 
if(isset($_REQUEST['curso'])){
            $_SESSION['curso'] = $_REQUEST['curso'];
            header("Location: consulta.php");exit;
    }
if(isset($_SESSION['emails'])){    
}else {
    header("Location: login.php?acesso='logar'");exit;
} ?>
<?php
    //incio do banco de dados
    $idcurso = trim(strip_tags($_SESSION['curso']));
    $idaluno = trim(strip_tags($_SESSION['ids'])); 
    //incio do banco de dados
    if(isset($_SESSION['curso'])){
    if(isset($_SESSION['emails'])){
    require_once './_model/classinscricao.php';
    require_once './_model/UrlDb.php';
        $url = new UrlBD();
		$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $inscricao = new Inscricao($conexao);
    //$resultado = $inscricao->find($_REQUEST['id']);
    $inscricao->setIdcurso($idcurso);
    $inscricao->setIdaluno($idaluno);
    $resultado = $inscricao->find($idaluno,$idcurso);
    $consultaid = $resultado['idaluno'];
    $inscricao->find($consultaid,$idcurso);
    $statuspgto = $resultado['statuspgto'];
    $inscricao->setStatuspgto($statuspgto);
    $inscricao->setNomeCurso($resultado['nomecurso']);
    $inscricao->setDescricao($resultado['descricao']);
    $inscricao->setInstrutor($resultado['instrutor']);
    $inscricao->setPrevisao($resultado['previsao']);
    $inscricao->setCarga($resultado['carga']);
    $inscricao->setTotaula($resultado['totaulas']);
    $inscricao->setValor($resultado['valor']); 
    //incio do banco de dados
    require_once './_model/classaluno.php';
    //$resultado = $inscricao->find($_REQUEST['id']);
    $inscricao->setId($resultado['idaluno']);
    $inscricao->setNome($resultado['nomealuno']);
    $inscricao->setCpf($resultado['cpf']);
    $inscricao->setRg($resultado['rg']);
    $inscricao->setEmail($resultado['email']);
    $inscricao->setNascimento($resultado['nascimento']);
    $inscricao->setSexo($resultado['sexo']);
    $inscricao->setEscolaridade($resultado['escolaridade']);
    $inscricao->setProfissao($resultado['profissao']);
    $inscricao->setRua($resultado['rua']);
    $inscricao->setN($resultado['n']);
    $inscricao->setComplemento($resultado['complemento']);
    $inscricao->setBairro($resultado['bairro']);
    $inscricao->setCidade($resultado['cidade']);
    $inscricao->setUf($resultado['uf']);
    $inscricao->setCep($resultado['cep']);
    $inscricao->setTel($resultado['tel']);
    $inscricao->setCel($resultado['cel']);
    $inscricao->setSenha($resultado['senha']);
    $inscricao->setDatainscricao($resultado['datainscricao']);
    $inscricao->setInscricao($resultado['idinscricao']);
    $inscricao->setDesconto($resultado['desconto']);
    $inscricao->setChave($resultado['chave']);
    }}
    date_default_timezone_set('America/Sao_Paulo');
    $dataHoraAtual = date('Y-m-d H:i');    ?>    
<hgroup class="pagina">
    <li>Enterprise >> Cursos & Treinamentos>> Vídeos</li><br/>
    <h1 class="center"><i>Vídeos do Treinamento.</i></h1>
<?php require_once './_model/classaluno.php';
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);$aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);
    if(isset($_SESSION['emails'])){
        $usuario = explode(" ", $aluno->getNome());//echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
		} ?>
   <h1><i class="fab fa-youtube"></i> &nbsp;&nbsp;EAD<br/><br/>&nbsp;&nbsp; &nbsp;&nbsp;<a href="ead.php">
 <i class="fas fa-arrow-circle-left"></i>Voltar</a></h1>
</hgroup>
<div class="texto">  
	<h2>Vídeos de Treinamentos - EAD</h2>
	<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <?php if(isset($_REQUEST['basico'])): ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if (($statuspgto == "PAGO" || $statuspgto == "GRATUITO")
                        &&($inscricao->getIdcurso()>=1&&$inscricao->getIdcurso()<=7)){//if ($statuspgto != ""){
                        echo '<h2>EAD Filme: Pirates of Silicon Valley (Piratas da Informática ou Piratas do Vale do Silício)</h2>'
                            .'Até o surgimento de Steve Jobs e Bill Gates, a informática era algo distante, que não fazia parte do universo das pessoas comuns. Os dois, ainda estudantes, lideraram uma revolução que integrou os computadores ao nosso dia a dia.<br/><b>Data de lançamento:</b> 20 de junho de 1999 (EUA)<br/><b>Direção:</b> Martyn Burke<br/><b>Roteiro:</b> Martyn Burke<br/><b>Indicações:</b> Prêmio Emmy do Primetime: Melhor Filme Feito Para Televisão, MAIS<br/><b>Autores:</b> Paul Freiberger, Michael Swaine<br/><b><i class="fab fa-imdb"></i></b>7,3/10 (22.617 V)'
                            . '<br/><a href="https://onedrive.live.com/embed?cid=D4A9C21E594FFC65&resid=D4A9C21E594FFC65%21549349&authkey=AIzJ2zn0gO4Z7nY" target="_blank" > <img alt="Pirates Of Silicon Valley" src="_imagens/Filme01.png" /></a>';									
                        echo '<h2>EAD Filme: <em>The Imitation Game</em> O Jogo da Imitação </h2>'
                            . 'II Guerra Mundial 1939, Alemanha Nazista iria ganhar a guerra. Até que Alan Turing, um aluno da Universidade de Cambridge UK,'
                            . ' junto com sua equipe busca entender os códigos nazistas, o "Enigma", que criptógrafos acreditavam inquebrável e impossível.'
                            .'<br/><b>Data de lançamento:</b> 8 de janeiro de 2015 (EUA)<br/><b>Direção:</b>  Morten Tyldum <br/><b>Roteiro:</b> Graham Moore<br/>'
                            . '<br/><b>Prêmios:</b>  Oscar de Melhor Roteiro Adaptado'
                            .'<b>Indicações:</b> - Melhor Filme - Melhor Direção - Melhor Ator (Benedict Cumberbatch) - Melhor Atriz Coadjuvante - (Keira Knightley)- Melhor Roteiro Adaptado - Melhor Montagem - Melhor Trilha Sonora - Melhor Design de Produção<br/>'
                            .'<b><i class="fab fa-imdb"></i></b> 8,0/10 (622.081 V) '
                            . '<br/><a href="https://onedrive.live.com/embed?cid=D4A9C21E594FFC65&resid=D4A9C21E594FFC65%21549350&authkey=AOVUnWaNC0W-WzI" target="_blank" > <img alt="Imitation The Game" src="_imagens/Filme02.jpg" /></a>';									
                        echo '<h2><i class="fab fa-microsoft"></i> EAD 01 = A história da Microsoft</h2>'
                            . '<iframe width="380" height="315" src="https://www.youtube.com/embed/_3ZztePQ3Nc?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                        echo '<h2><i class="fab fa-microsoft"></i> EAD 02 = A história do Windows</h2>'
                            . '<iframe width="380" height="315" src="https://www.youtube.com/embed/0Fjwg6q_cfI?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                        
                        $statuspgto = $inscricao->getStatuspgto();
                        if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                            if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                                echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                                echo '<ul><li><a target="_blank" href="http://tiny.cc/mhhcbz">Aula 01 – Excel Básico - Atalhos Cap Nº3</a></li>';
                                echo '<li><a target="_blank" href="http://tiny.cc/6ihcbz">Aula 02 – Excel Básico - Funções Básicas Cap Nº6</a></li>';
                                echo '<li><a target="_blank" href="http://tiny.cc/qkhcbz">Aula 03 – Excel Básico - Gráficos Cap Nº8</a></li>';
                                echo '<li><a target="_blank" href="http://tiny.cc/u6hcbz">Aula 04 – Excel Básico - Exercícios Extra Cap Nº 11</a></li></ul>';
                            }
                        }
                        if ($dataHoraAtual >= "2019-06-29 17:00" 
                            && $dataHoraAtual <= "2019-06-30 23:59"){
                            echo '<ul><li><a href="https://1drv.ms/xs/s!AmX8T1kewqnUocMllLepsHHSHcdzoA?wdFormId=%7B6250DF64%2D5543%2D4359%2DB64A%2DB969BDEE5EFB%7D" 
                            target="_blank">==> Questionário Filme Piratas Vale do Silício</a></li>
                            <li><a href="https://1drv.ms/xs/s!AmX8T1kewqnUodFGtdmiBt0nOC1JqA?wdFormId=%7B14A90761%2D41C5%2D4EE6%2D8A45%2D86AAE36C8947%7D" 
                            target="_blank">==> Questionário Filme o Jogo da Imitação</a></li></ul>';
                        }
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
       <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <?php elseif(isset($_REQUEST['avancap1'])): //avançado capitulo 1 ?> 
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<ul><li><a target="_blank" href="http://tiny.cc/lb0caz">Atividade 1 – Importando arquivos de texto para o Excel</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/di0caz">Atividade 2 – Importando arquivos de dados para o Excel .csv</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/ao5caz">Atividade 3 – Criando consultas de base de dados dentro do Excel</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/1q5caz">Atividade 4 – Vinculando dados do Excel no Access</a></li></ul>';
                        }
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
	<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <?php elseif(isset($_REQUEST['avancap2'])): //avançado capitulo 2 ?>
                    <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<ul><li><a target="_blank" href="http://tiny.cc/dr6caz">Atividade 2 – Classificação || Atividade 3 – Classificação com Duas Chaves</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/9t6caz">Atividade 4 – Classificando por cores || Atividade 5 – Conhecendo o filtro Avançado</a></li></ul>';
                        }
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
		<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <?php elseif(isset($_REQUEST['avancap3'])): //avançado capitulo 3 ?>
              <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<ul><li><a target="_blank" href="http://tiny.cc/q26caz">Atividade 1 – Aplicando as funções de texto || Atividade 2 – Copiando Fórmulas e planilhas</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/156caz">Atividade 3 – Conhecendo as funções de Banco de Dados Parte 1</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/886caz">Atividade 3 – Conhecendo as funções de Banco de Dados Parte 2</a></li></ul>';
                        }
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
		<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <?php elseif(isset($_REQUEST['avancap4'])): //avançado capitulo 4 ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<ul><li><a target="_blank" href="http://tiny.cc/9r7caz">Atividade 1, 2, 3 e 4 – Tabela Dinâmica</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/4u7caz">Atividade 5, 6 e 7 – Tabela Dinâmica</li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/hx7caz">Atividade 9 – Consolidando planilhas pelo Menu</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/jz7caz">Atividade 10 – Estrutura de Tópicos || Atividade 11 – Criando Subtotais</a></li></ul>';
                        }
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
		<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['avancap5'])): //avançado capitulo 5 ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<ul><li><a target="_blank" href="http://tiny.cc/d67caz">Atividade 1 – Conhecendo a Validação de dados.</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/277caz">Atividade 2 – Conhecendo a Guia Mensagem de Entrada e Alerta de Erro.</a></li></ul>';
                        }
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
		<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['avancap6'])): //avançado capitulo 6 ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<ul><li><a target="_blank" href="http://tiny.cc/m78caz">Atividade 1 – Conhecendo a Função CONT.SE</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/098caz">Atividade 2 – Conhecendo a Função SOMASE</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/kg9caz">Atividade 6 – Formatando Datas || Atividade 7 – Projetando Dias Corridos de uma Data</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/fp9caz">Atividade 8 – Projetando Dias Úteis de uma Data || Atividade 9 – Formatação Condicional e Cálculo</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/9w9caz">Atividade 9 - Parte 2 </a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/oz9caz">Atividade 10 – Diferença entre datas, resultando o número de dias úteis.</a></li></ul>';
                        }
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
		<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['avancap7'])): //avançado capitulo 7  ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<ul><li><a target="_blank" href="http://tiny.cc/r69caz">Atividade 1 – Conhecendo a Função E || Atividade 2 – Conhecendo a Função OU</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/v79caz">Atividade 3, 4 – Conhecendo a Função SE 	e SE Aninhada</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/z89caz">Atividade 5 – Função Se aninhada com OU</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/aaadaz">Atividade 6 – Função Se aninhada com E</a></li></ul>';
                        }					
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
		<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['avancap8'])): //avançado capitulo 8  ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<ul><h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<li><a target="_blank" href="http://tiny.cc/xfadaz">Atividade 1 – Usando Procv e Proch Parte 1</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/niadaz">Atividade 1 – Usando Procv e Proch Parte 2</a></li>';
                            echo '<li><a target="_blank" href="http://tiny.cc/1jadaz">Atividade 2 – Usando Corresp -- Atividade 3 – Usando Índice</a>';
                            echo '<li><a target="_blank" href="http://tiny.cc/518dez">Atividade 4 , 5  e 6– Auditoria de Fórmulas</a></li></ul>';
                        }					
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['avancap9'])): //avançado capitulo 9  ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<ul><h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<li><a target="_blank" href="http://tiny.cc/o28dez">Atividade 1, 2 e 3  – Atingir Meta e Solver</a></li></ul>';
                        }					
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['avancap10'])): //avançado capitulo 10  ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<ul><h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<li><a target="_blank" href="http://tiny.cc/u38dez">Atividade 1, 2 e 3  – Criando Cenários, Exibindo e Mesclando Cenários</a></li></ul>';
                        }					
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['avancap11'])): //avançado capitulo 11  ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=7) { //cursos
                            echo '<ul><h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<li><a target="_blank" href="http://tiny.cc/z48dez">Atividade 1, 2 , 3 e 4  – Criando Macros</a></li></ul>';
                        }					
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
				<?php elseif(isset($_REQUEST['powerbi'])): //avançado Power BI  ?>
                <?php $statuspgto = $inscricao->getStatuspgto();
                    if ($statuspgto == "PAGO" || $statuspgto == "GRATUITO"){//if ($statuspgto != ""){
                        if ($inscricao->getIdcurso()>=1 && $inscricao->getIdcurso()<=0) { //cursos
                            echo '<ul><h1><em><u>Área do Aluno - EAD</u></em></h1>';
                            echo '<li><a target="_blank" href="">Power Query</a></li></ul>';
                        }					
                    }else{
                        echo "<h1>Não Temos Aulas Dísponivéis para esse Curso Consulte seu professor</h1>";   
                    } ?>
		<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <?php else: //menu ?>
    <h4>Menu Vídeos EAD</h4>
    <ul>
        <b><li><a href="ead.php?basico=true">EAD - Excel</a></li></b>
        <b><li><a href="ead.php?avancap1=true">Excel Avançado - Capítulo 1 Importando Dados</a></li></b>
        <b><li><a href="ead.php?avancap2=true">Excel Avançado - Capítulo 2 Filtro, Classificação de dados e Filtro Avançado</a></li></b>
        <b><li><a href="ead.php?avancap3=true">Excel Avançado - Capítulo 3 Funções de Texto e Banco de Dados</a></li></b>
        <b><li><a href="ead.php?avancap4=true">Excel Avançado - Capítulo 4 Tabela Dinâmica e Consolidação de Dados</a></li></b>
		<b><li><a href="ead.php?avancap5=true">Excel Avançado - Capítulo 5 Consolidação de Dados</a></li></b>
		<b><li><a href="ead.php?avancap6=true">Excel Avançado - Capítulo 6 Funções Estatísticas, Matemáticas, Estatísticas, Informações e Datas</a></li></b>
		<b><li><a href="ead.php?avancap7=true">Excel Avançado - Capítulo 7 Funções Lógicas e Condicionais</a></li></b>
		<b><li><a href="ead.php?avancap8=true">Excel Avançado - Capítulo 8 Funções Pesquisas e Auditoria de Fórmulas</a></li></b>
        <b><li><a href="ead.php?avancap9=true">Excel Avançado - Capítulo 9 Compartilhar, Análise de Dados e Simulações</a></li></b>
        <b><li><a href="ead.php?avancap10=true">Excel Avançado - Capítulo 10 Cenários</a></li></b>
        <b><li><a href="ead.php?avancap11=true">Excel Avançado - Capítulo 11 Macros Interativas</a></li></b>
        <b><li><a href="ead.php?powerbi=true">EAD - Power BI</a></li></b>
    </ul>
    <?php endif;?>
</div>
<?php require_once "./footer.php"; ?>
<?php 
if (isset($_REQUEST['inscricao'])){
    echo '<script  type="text/javascript"  type="text/javascript">'
        . 'alert("Inscrição Realizada com Sucesso! \n'
        . 'Parabéns pela sua Escolha, você está invenstindo no seu futuro!");</script>';
}
if (isset($_REQUEST['ninscricao'])){
    echo '<script  type="text/javascript"  type="text/javascript">'
    . 'alert("Você já está inscrito nesse curso!");</script>';
}
?>