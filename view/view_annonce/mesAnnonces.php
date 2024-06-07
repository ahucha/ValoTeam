<div class="container mt-5">
    <h1 class="text-center mb-5">Mes annonces</h1>

    <?php if (empty($annonces)): ?>
        <p class="text-center display-6">Aucune annonce disponible</p>
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
                                    <p class="card-text text-white"><strong>Créé par :</strong> <?= htmlspecialchars($annonce['username']) ?></p>
                                </div>
                            </div>
                            <div class="card-text bg-secondary"><?= htmlspecialchars($annonce['description']) ?></div>
                            <button type="button" class="btn btn-danger w-100 mt-3 float-end" data-bs-toggle="modal" data-bs-target="#editModal<?= htmlspecialchars($annonce['id_annonce']) ?>">
                                Modifier
                            </button>
                        </div>

                        <!-- Demandes de réservation -->
                        <div class="row mt-4">
                            <div class="col">
                                <?php if ($annonce['nb_place'] == 0): ?>
                                    <h5 class="text-danger text-center">Plus de place disponible</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Pseudo Valorant</th>
                                                    <th scope="col">Rang</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $reservations = DbAnnonce::getReservationsByAnnonce($annonce['id_annonce']); ?>
                                                <?php foreach ($reservations as $reservation): ?>
                                                    <?php if ($reservation['statut'] == 'Accepté'): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($reservation['name_valo']) ?></td>
                                                            <td><?= htmlspecialchars($reservation['rank_valo']) ?></td>
                                                            <td>
                                                                <span class="btn btn-success btn-sm">Accepté</span>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <h5 class="text-white text-center">Demandes de réservation pour cette annonce</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-dark table-responsive">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Pseudo Valorant</th>
                                                    <th scope="col">Rang</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $reservations = DbAnnonce::getReservationsByAnnonce($annonce['id_annonce']); ?>
                                                <?php foreach ($reservations as $reservation): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($reservation['name_valo']) ?></td>
                                                        <td><?= htmlspecialchars($reservation['rank_valo']) ?></td>
                                                        <td>
                                                            <?php if ($reservation['statut'] == 'Accepté'): ?>
                                                                <span class="btn btn-success btn-sm">Accepté</span>
                                                            <?php else: ?>
                                                                <form method="POST" action="index.php?ctl=annonce&action=accepterReservation" class="d-inline">
                                                                    <input type="hidden" name="id_reservation" value="<?= htmlspecialchars($reservation['id_reservation']) ?>">
                                                                    <button type="submit" class="btn btn-success btn-sm">Accepter</button>
                                                                </form>
                                                                <form method="POST" action="index.php?ctl=reservation&action=refuserReservation" class="d-inline">
                                                                    <input type="hidden" name="id_reservation" value="<?= htmlspecialchars($reservation['id_reservation']) ?>">
                                                                    <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                                                                </form>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= htmlspecialchars($annonce['id_annonce']) ?>" tabindex="-1" aria-labelledby="editModalLabel<?= htmlspecialchars($annonce['id_annonce']) ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= htmlspecialchars($annonce['id_annonce']) ?>">Modifier l'annonce</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="index.php?ctl=annonce&action=updateAnnonce">
                                            <input type="hidden" name="id_annonce" value="<?= htmlspecialchars($annonce['id_annonce']) ?>">
                                            <div class="mb-3">
                                                <label for="editTitre<?= htmlspecialchars($annonce['id_annonce']) ?>" class="form-label">Titre</label>
                                                <input type="text" class="form-control" id="editTitre<?= htmlspecialchars($annonce['id_annonce']) ?>" name="titre" value="<?= htmlspecialchars($annonce['titre']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editDescription<?= htmlspecialchars($annonce['id_annonce']) ?>" class="form-label">Description</label>
                                                <textarea class="form-control" id="editDescription<?= htmlspecialchars($annonce['id_annonce']) ?>" name="description" required><?= htmlspecialchars($annonce['description']) ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editDate<?= htmlspecialchars($annonce['id_annonce']) ?>" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="editDate<?= htmlspecialchars($annonce['id_annonce']) ?>" name="date" value="<?= htmlspecialchars($annonce['date']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editHeure<?= htmlspecialchars($annonce['id_annonce']) ?>" class="form-label">Heure</label>
                                                <input type="time" class="form-control" id="editHeure<?= htmlspecialchars($annonce['id_annonce']) ?>" name="heure" value="<?= htmlspecialchars($annonce['heure']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editNbPlace<?= htmlspecialchars($annonce['id_annonce']) ?>" class="form-label">Nombre de places</label>
                                                <input type="number" class="form-control" id="editNbPlace<?= htmlspecialchars($annonce['id_annonce']) ?>" name="nb_place" value="<?= htmlspecialchars($annonce['nb_place']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editCategorie<?= htmlspecialchars($annonce['id_annonce']) ?>" class="form-label">Catégorie</label>
                                                <select class="form-select" id="editCategorie<?= htmlspecialchars($annonce['id_annonce']) ?>" name="id_categorie" required>
                                                    <?php foreach ($categories as $categorie): ?>
                                                        <option value="<?= htmlspecialchars($categorie['id_categorie']) ?>" <?= $categorie['id_categorie'] == $annonce['id_categorie'] ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($categorie['libelle_categorie']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                        </form>
                                    </div>
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
                                        <p>Êtes-vous sûr de vouloir supprimer cette annonce ? Cette action est irréversible.</p>
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
