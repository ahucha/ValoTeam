<div class="table-responsive">
    <table class="table table-striped table-dark table-responsive">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nom d'utilisateur</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($infoUser as $user) { ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($user['id_user']) ?></th>
                    <td><?php echo htmlspecialchars($user['username']) ?></td>
                    <td><?php echo htmlspecialchars($user['email']) ?></td>
                    <td><?php echo htmlspecialchars($user['libelle_role']) ?></td>
                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo htmlspecialchars($user['id_user']) ?>">
                            Supprimer
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="deleteModal<?php echo htmlspecialchars($user['id_user']) ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" style="color:black;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <a href="index.php?ctl=user&action=deleteUser&id_user=<?php echo htmlspecialchars($user['id_user']) ?>" class="btn btn-danger">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </tbody>
    </table>
</div>
