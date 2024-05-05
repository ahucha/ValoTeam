<div class="container">
  <div class="text-center mb-4">
    <img src="view/images/logo_valoteam.png" alt="Logo_ValoTeam" width="150">
  </div>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="custom-form">
        <h2 class="text-center mb-4">Connexion</h2>
        <form>
          <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" placeholder="Entrez votre nom d'utilisateur" required>
          </div>
          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" required>
          </div>
          <!-- Bouton Se connecter -->
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Se connecter</button>
          </div>
          <!-- Lien vers la page d'inscription -->
          <p class="text-center mt-3">Pas encore inscrit ? <a href="index.php?ctl=user&action=register">S'inscrire</a></p>
        </form>
        <?php
            if(isset($_GET['msg']))
            {
              echo "<hr>";
              echo "<p style='color: red; text-align: center;'>".$_GET['msg']."</p>";
            }
        ?>
      </div>
    </div>
  </div>
</div>