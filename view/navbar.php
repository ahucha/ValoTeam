<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="view/images/logo_valoteam.png" width="auto" height="60px" alt="Logo ValoTeam">
      ValoTeam
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Rechercher une partie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Partie en cours</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Gérer ma partie</a>
        </li>
      </ul>
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <?=$_SESSION['username'];?> <i class="bi bi-chevron-down"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item" href="index.php?ctl=user&action=profilUser">Mon profil</a></li>
    <li><a class="dropdown-item" href="index.php?ctl=user&action=deconnect">Déconnexion</a></li>
  </ul>
</li>
      </ul>
    </div>
  </div>
</nav>


