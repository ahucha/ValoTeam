<div class="container mt-5">
    <h1 class="text-center">Liste des annonces</h1>

    <div class="mb-4">
        <form method="GET" action="index.php">
            <input type="hidden" name="ctl" value="annonce">
            <input type="hidden" name="action" value="vueAnnonces">
            <div class="row">
                <div class="col-md-10">
                    <select name="category" class="form-select">
                        <option value="">Toutes les catégories</option>
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= htmlspecialchars($categorie['id_categorie']) ?>" <?= isset($_GET['category']) && $_GET['category'] == $categorie['id_categorie'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categorie['libelle_categorie']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-danger w-100">Filtrer</button>
                </div>
            </div>
        </form>
    </div>

    <?php if (empty($annonces)): ?>
        <p class="text-center diplay-6">Aucune annonce de disponible</p>
    <?php else: ?>
        <div class="row justify-content-center">
            <?php foreach ($annonces as $annonce): ?>
                <div class="col-md-6 mb-4">
                    <div class="card custom-card-annonce">
                        <div class="card-body">
                            <?php if ($_SESSION['id_role'] == 1): ?>
                                <button type="button" class="btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#deleteModal<?= htmlspecialchars($annonce['id_annonce']) ?>">
                                    ×
                                </button>
                            <?php endif; ?>
                            <h5 class="card-title text-center"><?= htmlspecialchars($annonce['titre']) ?></h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($annonce['date']))) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Heure :</strong> <?= htmlspecialchars(date('H:i', strtotime($annonce['heure']))) ?></p>
                                </div>
                            </div>
                            <p class="card-text">Places restantes : <?= htmlspecialchars($annonce['nb_place']) ?></p>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Catégorie :</strong> <?= htmlspecialchars($annonce['libelle_categorie']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Créé par :</strong> <?= htmlspecialchars($annonce['username']) ?></p>
                                </div>
                            </div>
                            <div class="card-text bg-secondary"><?= htmlspecialchars($annonce['description']) ?></div>
                            <?php if (!$annonce['reserved']): ?>
                                <form method="POST" action="index.php?ctl=reservation&action=addReservation">
                                    <input type="hidden" name="id_annonce" value="<?= htmlspecialchars($annonce['id_annonce']) ?>">
                                    <button type="submit" class="btn btn-primary w-100 mt-3">Réserver</button>
                                </form>
                            <?php else: ?>
                                <button type="button" class="btn btn-secondary w-100 mt-3" disabled>Déjà réservé</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?= htmlspecialchars($annonce['id_annonce']) ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= htmlspecialchars($annonce['id_annonce']) ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel<?= htmlspecialchars($annonce['id_annonce']) ?>">Supprimer l'annonce</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-body-text">Voulez-vous vraiment supprimer cette annonce ? Cette action est irréversible.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form method="POST" action="index.php?ctl=annonce&action=deleteAnnonce">
                                    <input type="hidden" name="id_annonce" value="<?= htmlspecialchars($annonce['id_annonce']) ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
