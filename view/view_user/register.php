<div class="container">
  <div class="text-center mb-4">
    <img src="view/images/logo_valoteam.png" alt="Logo_ValoTeam" width="100">
  </div>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="custom-form">
        <h2 class="text-center mb-4">Inscription</h2>
        <form id="registerForm" action="index.php?ctl=user&action=validRegister" method="POST">
          <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="username" id="username" required pattern="^[a-zA-Z0-9_]{5,20}$" title="Le nom d'utilisateur doit contenir entre 5 et 20 caractères alphanumériques (lettres, chiffres, tirets bas)." placeholder="Entrez votre nom d'utilisateur">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$" title="Veuillez entrer une adresse e-mail valide (ex : nom@example.com)." placeholder="Entrez votre email">
          </div>
          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$" title="Le mot de passe doit contenir au moins 12 caractères, incluant des majuscules, des minuscules, des chiffres et des caractères spéciaux.">
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirmer le mot de passe</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmez votre mot de passe" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-danger" style="width:100%;">S'inscrire</button>
          </div>
          <p class="text-center mt-3">Déjà membre ? <a href="index.php?ctl=user&action=login">Se connecter</a></p>
        </form>
        <?php
            if (isset($_GET['msg_erreur'])) {
              echo "<hr>";
              echo "<p style='color: red; text-align: center;'>".htmlspecialchars($_GET['msg_erreur'])."</p>";
            }
        ?>
      </div>
    </div>
  </div>
</div>
