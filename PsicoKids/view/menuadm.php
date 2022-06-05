<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Etec News</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo URL.'adm';?>"><i class='fa fa-home'></i> Início <span class="sr-only">(página atual)</span></a>
      </li>
      <?php if($_SESSION["dadosUsuario"]->nivelacesso == 1) { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class='fa fa-user'></i> Usuários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo URL.'novo-usuario';?>">Cadastrar</a>
          <a class="dropdown-item" href="<?php echo URL.'consultar-usuario';?>">Consultar</a>
        </div>
      </li>
      <?php } ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class='fa fa-newspaper'></i> Notícias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo URL.'nova-noticia';?>">Cadastrar</a>
          <a class="dropdown-item" href="<?php echo URL.'consultar-noticia';?>">Consultar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class='fa fa-list'></i> Categorias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo URL.'nova-categoria';?>">Cadastrar</a>
          <a class="dropdown-item" href="<?php echo URL.'consultar-categoria';?>">Consultar</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL.'sair';?>"><i class='fa fa-right-from-bracket'></i> Sair</a>
      </li>
    </ul>
  </div>
</nav>