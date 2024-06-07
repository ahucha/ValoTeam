<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="view/images/logo_valoteam2.png" width="auto" height="60px" alt="Logo ValoTeam">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=annonce&action=vueAnnonces">Voir les annonces</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=annonce&action=formAnnonces">Créer une annonce</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=reservation&action=mesReservations">Mes réservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=annonce&action=mesAnnonces">Mes annonces</a>
        </li>
        <?php
          if($_SESSION['id_role'] == 1)
          {
          ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=user&action=listeUser">Liste des utilisateurs</a>
        </li>
          <?php
          }
        ?>
      </ul>
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= htmlspecialchars($_SESSION['username']); ?> <i class="bi bi-chevron-down"></i>
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
