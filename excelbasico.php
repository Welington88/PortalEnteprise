<?php session_start();//inicio da sessao ?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php  
    if(isset($_REQUEST['curso'])){
        unset($_SESSION['curso']);
        $_SESSION['curso'] = $_REQUEST['curso'];
        header("Location: inscricao.php?curso=2&inscrever=true");exit;
    }
?>
<hgroup class="pagina">
<h3>Enterprise >> Cursos>> Excel Básico</h3>
<h1>Curso Excel Básico<br/>
<a href="cursos.php" ><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Voltar</a></h1>
<?php require_once './_model/classaluno.php';
	require_once './_model/UrlDb.php';
        $url = new UrlBD();
		$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
		
    try {$conexao= new \PDO($dsn, $username, $passwd);} catch (\PDOException $ex) {
        die('Não foi possível estabelecer conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());}
    if (isset($_SESSION['emails'])){
        $aluno = new aluno($conexao);$resultado = $aluno->find($_SESSION['ids']);
        $aluno->setId($resultado['idaluno']);$aluno->setNome($resultado['nomealuno']);}
    if(isset($_SESSION['emails'])){
    $usuario = explode(" ", $aluno->getNome());
    //echo "<h5 id=usuario>Usuário Logado=> $usuario[0] </h5>";
	} ?>
</hgroup>
<figure id="iconeCurso">    
     <img src="_imagens/excellogo.jpg" alt="Excel Básico"/>
</figure>
<div class="texto">
    <h2><i class="fas fa-file-excel"></i> &nbsp;&nbsp;Excel Básico & Intermediário</h2>
    <font size="1" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Obs.: Compatível também com as versão 2007, 2010, 2013, 2016, 2019 e Office365</font>
    <h2>Descrição</h2>
    <p>O <b><i>Excel</i></b> é o software mais utilizado e conhecido no mundo. É um editor de planilhas que auxilia em qualquer tarefa no seu dia a dia, pois é uma ferramenta com grande suporte para cálculos e construções de gráficos, com o implemento de <i>VB(Visual Basic)</i>. Por Virtude desse fato, empresas vem procurando profissionais capacitados e com o domínio dessa ferramenta. Assim, você estará preparado para atuar em qualquer segmento no mercado de trabalho.</p>

    <h2>Utilização</h2>
<p>Hoje, o <b><i>Excel</i></b> é um dos software mais utilizados em todos os setores no mundo corporativo, seja para situações mais simples, como elaboração de planilhas para controle de estoque, até para atividades mais complexas, como o gerenciamento de projetos e muito mais. </p>

<h2>Microsoft <b><i>Excel</i></b> | <b><i>Excel</i></b> Básico | <b><i>Excel</i></b> VBA</h2>

<p>Ao todo serão <em>10 capítulos</em>, apresentados durante as aulas presenciais do curso:<br/><br/>
 Utilizando de uma metodologia com aulas práticas e dinâmicas, você aprenderá a utilizar o <b><i>Excel</i></b> de forma completa tirando suas dúvidas e praticando em sala de aula, como exemplo, planilhas profissionais nos moldes utilizadas em grandes empresas. E essa será com certeza um diferencial em sua carreira, o que lhe abrirá portas na busca por um novo posicionamento no mercado de trabalho ou/e crescimento e sucesso profissional.
</p>

<h2>Mercado de Trabalho</h2>
<p>
Dominar o <b><i>Excel</i></b> é essencial, independente do segmento de atuação. Área Administrativa, Engenharia, Tecnologia de Informação, Recursos Humanos, Contábil e etc. Todas exigem o conhecimento de <b><i>Excel</i></b>, com isso, gera um diferencial na busca por melhores oportunidades de trabalho.
</p>

<p>
Segundo os principais Recrutadores e Agências de RH, o <b><i>Excel</i></b> é exigido em praticamente todos os cargos de destaque e liderança. Em processos de exames de seleção ou testes de conhecimentos é praticamente obrigatório o domínio do <b><i>Excel</i></b>. Com o nosso curso você dominará e se tornará destaque no mercado de trabalho. 
</p>
<p>
Quer conquistar as habilidades necessárias para dominar o <b><i>Excel</i></b> e ter a oportunidade de aplicar estes conhecimentos? Nós Temos o curso para você!
</p>
<h2>Programa
    e Metodologia <b><i>Excel</i></b> - Básico & Intermediário</h2>
<ol type='1' >     
    <li>Capítulo</li>
        <ul type='disc'>
            <li>Introdução ao Microsoft Excel</li>
            <li>Formas diferentes de iniciar o Excel</li>
            <li>Como iniciar os trabalhos utilizando um modelo</li>
        </ul>
    <li>Capítulo</li>
        <ul type='disc'>
            <li>Funcionalidades da Barra de Título</li>
            <li>Controle de Janelas</li>
            <li>Descrição da Barra de Acesso Rápido</li>
            <li>Inserir botões de comando na Barra de Acesso Rápido</li>
            <li>Alterar a posição da Barra de Acesso Rápido</li>
            <li>Conceitos de Planilha e Pasta de Trabalho</li>
        </ul>   
    <li>Capítulo</li>
        <ul type='disc'>
            <li>Funcionamento da Faixa de Opções</li>
            <li>Guia Arquivo (ou Botão Backstage)</li>
            <li>Trabalhando com documentos recentes</li>
            <li>Fixar / Desafixar documentos na barra de documentos recentes</li>
            <li>Conceito de Guias e Galerias</li>
            <li>Reconhecendo as funcionalidades das Guias</li>
        </ul>   
<li>Capítulo</li>
    <ul type='disc'>
        <li>Identificando as referências de uma célula</li>
        <li>Conceitos e formas de uso da Caixa de Nome</li>
        <li>Nomeando células contínuas e células intercaladas</li>
        <li>Como utilizar nomes atribuídos em funções</li>
        <li>Apagar nomes atribuídos</li>
        <li>Utilização da caixa de diálogo Colar Nome</li>
    </ul>   
<li>Capítulo</li>
    <ul type='disc'>
        <li>Definição da Barra de Fórmulas</li>
        <li>Ampliar a área da Barra de Fórmulas.</li>
        <li>Botão Inserir Função</li>
        <li>Localizando funções por categoria</li>
        <li>Utilizando as barras de rolagem vertical e horizontal</li>
        <li>Como inserir dados em um Assistente de Função</li>
        <li>Editar o conteúdo de uma célula (F2)</li>
        <li>Quantidade de Linhas e Colunas de uma planilha</li>
    </ul>       
<li>Capítulo</li>
    <ul type='disc'>
        <li>Renomear uma planilha</li>
        <li>Trocar a cor de uma guia da planilha</li>
        <li>Copiar uma planilha para a mesma pasta de trabalho</li>
        <li>Copiar uma planilha para outra pasta de trabalho</li>
        <li>Mover uma planilha entre pastas de trabalho</li>
        <li>Ocultar uma planilha</li>
        <li>Reexibir uma planilha</li>
        <li>Agrupar e Desagrupar planilhas</li>
    </ul>    
<li>Capítulo</li>
    <ul type='disc'>
        <li>Utilizando atalhos para movimentar-se pela planilha</li>
        <li>CTRL + Setas de Direção</li>
        <li>CTRL + Home || CTRL + End</li>
        <li>CTRL & + || CTRL & -</li>
        <li>Modos de inserção de dados em uma célula</li>
        <li>O ENTER</li>
        <li>CTRL + ENTER</li>
        <li>ALT  + =</li>
        <li>Aumentando e diminuindo o Zoom (CTRL + Botão de Rolagem do Mouse)</li>
        <li>Selecionando Colunas e linhas com o teclado</li>
        <li>CTRL + Barra de Espaço</li>
        <li>Repetindo último comando ou formatação F4</li>
        <li>SHIFT + Barra de Espaço</li>
        <li>Selecionando células</li>
        <li>Mesclar células</li>
    </ul>     
<li>Capítulo</li>
    <ul type='disc'>
       <li>Entendendo funções x fórmulas</li>
       <li>Barra de Status (Modos de Edição de Célula)</li>
       <li>Formatos das Pastas de Trabalhos .xls, .xlsx, .xlsm e .xlsb </li>
       <li>Colar Especial (Valores, Formulas e Outros)</li>
    </ul>    
<li>Capítulo</li>
  <ul type='disc'>
     <li>Como escrever fórmulas e funções</li>
     <li>Modos de Exibição da planilha (Normal, Layout de Página e Visualização de Quebra de Página)</li>
     <li>Dividir Janelas Horizontalmente</li>
     <li>Dividir Janelas Verticalmente</li>
     <li>Congelar painéis</li>
     <li>Descongelar painéis</li>
  </ul>  
<li>Capítulo</li>
   <ul type='disc'>
       <li>Operador matemático de Soma ( + )</li>
       <li>Operador matemático de Subtração ( - ) </li>
       <li>Diversas operações de exemplo</li>
   </ul> 
</ol>
<?php if(isset($_SESSION['curso'])){
    require_once './_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $id = $_SESSION['curso'];
    $resultadoCurso = $curso->find($id);
    $curso->setNomeCurso($resultadoCurso['nomecurso']);
    $curso->setDescricao($resultadoCurso['descricao']);
    $curso->setInstrutor($resultadoCurso['instrutor']);
    $curso->setPrevisao($resultadoCurso['previsao']);
    $curso->setCarga($resultadoCurso['carga']);
    $curso->setTotaula($resultadoCurso['totaulas']);
    $curso->setValor($resultadoCurso['valor']);
    $curso->setVagas($resultadoCurso['vagas']);
    }
    //incio do banco de dados
    $idcurso = 4;
    
    if (isset($_SESSION['ids'])){$idaluno = trim(strip_tags($_SESSION['ids'])); 
    //incio do banco de dados
    require_once './_model/classinscricao.php';
    try {
        $conexaoInscricao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $inscricao = new Inscricao($conexaoInscricao);
    //$resultado = $aluno->find($_REQUEST['id']);
    $inscricao->setIdcurso($idcurso);
    $inscricao->setIdaluno($idaluno);
    $resultado = $inscricao->find($idaluno,$idcurso);
    $consultaid = $resultado['idaluno'];
    $inscricao->find($consultaid,$idcurso);
    $numinscricao = $resultado['idinscricao'];
    $statuspgto = $resultado['statuspgto'];
    $inscricao->setStatuspgto($statuspgto);
    $chave = $resultado['chave'];
    $inscricao->setChave($chave);
    }
    if(isset($_SESSION['curso'])){
    $vagas = $resultadoCurso['vagas'];
    
    //header("Location: consulta.php");exit;   
    // fim de bando de dados*/
    if (isset($_SESSION['ids'])){}else{$numinscricao=0;}
    if($numinscricao<1&&$vagas>0){
        echo "<span id='inscricao'><a href='excelbasico.php?curso=" . $idcurso ."'>"
        . "Faça sua Inscrição aqui!!!</a></span>";
    }else {
        echo "<span id='inscricao'><a href='consulta.php?curso=" . $idcurso ."'>"
        . "Consulte sua Inscrição aqui!!!</a></span>";
    }} 
	else { //se não tiver logado
    
	require_once './_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $id = 4;
    $resultadoCurso = $curso->find($id);
    $curso->setNomeCurso($resultadoCurso['nomecurso']);
    $curso->setDescricao($resultadoCurso['descricao']);
    $curso->setInstrutor($resultadoCurso['instrutor']);
    $curso->setPrevisao($resultadoCurso['previsao']);
    $curso->setCarga($resultadoCurso['carga']);
    $curso->setTotaula($resultadoCurso['totaulas']);
    $curso->setValor($resultadoCurso['valor']);
    $curso->setVagas($resultadoCurso['vagas']);
    $vagas = $curso->getVagas();
    if($vagas>0){
        echo '<span id="inscricao">'
        . '<a href="excelbasico.php?curso='. $idcurso .'">Faça sua Inscrição!!!</a></span>';
    }//fim de serro 
    }
?>
<p><b><i>Enterprise&copy;</i></b> o melhor para você, sua equipe e sua empresa.</p>
</div>
<?php require_once "./footer.php"; ?>