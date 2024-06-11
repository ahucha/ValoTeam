<div class="container mt-5">
    <h1 class="text-center">Ajouter une annonce</h1>
    <div class="custom-form-annonce">
        <form method="POST" action="index.php?ctl=annonce&action=addAnnonce">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="titre" placeholder="Entrez le titre" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Entrez la description" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="time" class="form-label">Heure</label>
                        <input type="time" class="form-control" id="time" name="heure" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie</label>
                        <select class="form-select" id="category" name="id_categorie" required>
                            <?php
                            foreach($listeCategories as $categorie)
                            {
                                echo "<option value=\"" . htmlspecialchars($categorie['id_categorie'], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($categorie['libelle_categorie'], ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="places" class="form-label">Nombre de places</label>
                        <select class="form-select" id="places" name="nb_place" required>
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value=\"" . htmlspecialchars($i, ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($i, ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Soumettre</button>
        </form>
        <?php
            if(isset($_GET['msg_erreur']))
            {
              echo "<hr>";
              echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($_GET['msg_erreur'], ENT_QUOTES, 'UTF-8') . "</p>";
            }
        ?>
    </div>
</div>
