<?php
if(isset($infoUser)) {
    foreach($infoUser as $user)
    {
        $username = htmlspecialchars($user['username'] ?? '');
        $email = htmlspecialchars($user['email'] ?? '');
        $name_valo = htmlspecialchars($user['name_valo'] ?? '');
        $rank_valo = htmlspecialchars($user['rank_valo'] ?? '');
    }
}
?>
<?php
if(isset($_GET['msg_erreur']))
{
    ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($_GET['msg_erreur']); ?>
    </div>
    <?php
} 
elseif(isset($_GET['msg_valid']))
{
    ?>
    <div class="alert alert-success" role="alert">
        <?= htmlspecialchars($_GET['msg_valid']); ?>
    </div>
    <?php
} 
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="mb-4" style="text-align:center; color:white;"> Mon profil </h2>
                    <form method="POST" style="color:white;" action="index.php?ctl=user&action=updateUser">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-3 text-danger">Informations de mon compte ValoTeam</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Username">Nom d'utilisateur</label>
                                    <input type="text" class="form-control" id="Username" name="username" required pattern="^[a-zA-Z0-9_]{5,20}$" title="Le nom d'utilisateur doit contenir entre 5 et 20 caractères alphanumériques (lettres, chiffres, tirets bas)." value="<?= $username ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required title="Veuillez entrer une adresse e-mail valide." value="<?= $email ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-3 text-danger">Informations de mon compte Valorant</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name_valo">Pseudo Valorant</label>
                                    <input type="text" class="form-control" id="name_valo" pattern="[\p{L}\s\-]+#\w{3,4}" title="Le pseudo valorant doit être sous cette forme : exemple#test" placeholder="exemple#test" name="name_valo" value="<?= $name_valo ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="rank_valo">Rang Valorant</label>
                                    <select class="form-control" id="rank_valo" name="rank_valo">
                                        <option></option>
                                        <option value="<?= htmlspecialchars($rank_valo) ?>" disabled selected hidden><?= htmlspecialchars($rank_valo) ?></option>
                                        <option value="Fer">Fer</option>
                                        <option value="Bronze">Bronze</option>
                                        <option value="Or">Or</option>
                                        <option value="Platine">Platine</option>
                                        <option value="Diamant">Diamant</option>
                                        <option value="Ascendant">Ascendant</option>
                                        <option value="Immortel">Immortel</option>
                                        <option value="Radiant">Radiant</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters mt-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align:center;">
                                <button type="submit" id="submit" name="submit" class="btn btn-danger" style="width:60%;">Modifier les données</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
