<div class="container mt-5">
    <h1 class="text-center mb-5">Mes Réservations</h1>

    <?php if (empty($reservations)): ?>
        <p class="text-center display-6">Aucune réservation disponible</p>
    <?php else: ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Titre de l'annonce</th>
                    <th scope="col">Créateur de l'annonce</th>
                    <th scope="col">Pseudo Valorant</th>
                    <th scope="col">Statut de la réservation</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['titre']) ?></td>
                        <td><?= htmlspecialchars($reservation['username']) ?></td>
                        <td><?= htmlspecialchars($reservation['name_valo']) ?></td>
                        <td>
                            <?php if ($reservation['statut'] == 'Accepté'): ?>
                                <span class="text-success">Accepté</span>
                            <?php elseif ($reservation['statut'] == 'Refusé'): ?>
                                <span class="text-danger">Refusé</span>
                            <?php else: ?>
                                <span>En attente</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($reservation['statut'] == 'Refusé'): ?>
                                <form method="POST" action="index.php?ctl=reservation&action=supprimerReservation" class="d-inline">
                                    <input type="hidden" name="id_reservation" value="<?= htmlspecialchars($reservation['id_reservation']) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            <?php else: ?>
                                <?php if ($reservation['statut'] == 'Accepté'): ?>
                                    <form method="POST" action="index.php?ctl=reservation&action=desinscrireReservation" class="d-inline">
                                        <input type="hidden" name="id_reservation" value="<?= htmlspecialchars($reservation['id_reservation']) ?>">
                                        <input type="hidden" name="id_annonce" value="<?= htmlspecialchars($reservation['id_annonce']) ?>">
                                        <button type="submit" class="btn btn-warning btn-sm">Désinscrire</button>
                                    </form>
                                <?php else: ?>
                                    <form method="POST" action="index.php?ctl=reservation&action=supprimerReservation" class="d-inline">
                                        <input type="hidden" name="id_reservation" value="<?= htmlspecialchars($reservation['id_reservation']) ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
