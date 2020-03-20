<?php ob_start();//inicio da sessao   ?>
<header class="cabecalho container">
<hgroup>
    <a href="index.php">
        <h1 class="logo">
            Enterprise Consultorias e Treinamentos
        </h1>
    </a>
</hgroup>  <!-- https://www.facebook.com/PortalEnterprise/ -->
<button class="btn-menu bg-gradiente"><i class="fa fa-bars fa-lg"></i></button>
<nav class="menu">
<div id="divphp" >
<a class="btn-close"><i class="fa fa-times"></i></a>
<ul>
<li>
    <a href="cursos.php">Cursos</a>
</li>
<li>
    <a href="institucional.php">Institucional</a>
</li>
<li>
    <a href="blog.php">Blog</a>
</li>
<li >
    <a href="contato.php">Contato</a>
</li>
<li>
    <a href="login.php"> <?php if(isset($_SESSION['nome'])){
        $usuario = $_SESSION['nome'];
        echo "<b><font size='2'>".$usuario."</font></b>";}else { echo "Login";} ?> </a>
    <ul>
        <?php if(isset($_SESSION['nome'])) {
                 echo "<li class='menuPHP'><a href='_controller/logout.php'>Sair</a></li>";} ?>
    </ul>
</li>
</ul>
</div>
</nav>
</header>
<hgroup>
<div class="banner container">
    <div class="title">
        <h2>Enterprise</h2>
        <h3>O melhor para você, sua equipe e sua empresa.</h3>
    </div>
    <div class="buttons">
        <form name="form" 
            <?php if(isset($_SESSION['nome']) && isset($_SESSION['curso'])){
                echo "action='consulta.php'";
            } elseif (isset($_SESSION['nome'])) {
                echo "action='login.php'";
            }else {echo "action='cadastro.php'";} ?> >
            <!-- envio do formulário-->
            <button class="btn btn-cadastrar bg-white radius">
                <?php if(isset($_SESSION['nome'])) {
                     echo "Área do Aluno";
                 }else{
                     echo "Inscreva-se";
                 }  ?>
              <i class="fa fa-arrow-circle-right"></i></button>     
        </form>
        <form name="form" action="cursos.php">
            <button class="btn btn-cursos bg-black radius" >
                Cursos<i class="fas fa-info-circle"></i></button>
        </form>
    </div>
</div>
</hgroup>