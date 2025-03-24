<?php
$sql = "SELECT u.*, r.libelle_role 
        FROM users u, role r 
        WHERE u.id_r = r.id_role";
$users = mysqli_query($connexion, $sql);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Utilisateurs</h2>
        <a href="index.php?action=addUser" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouvel Utilisateur
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Spécialité</th>
                    <th>Rôle</th>
                    <th>Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = mysqli_fetch_assoc($users)): ?>
                <tr>
                    <td><?= $user['id_user'] ?></td>
                    <td><?= $user['nom'] ?></td>
                    <td><?= $user['prenom'] ?></td>
                    <td><?= $user['specialite'] ?? '-' ?></td>
                    <td><?= $user['libelle_role'] ?></td>
                    <td><?= $user['login'] ?></td>
                    <td>
                        <a href="index.php?action=editUser&id=<?= $user['id_user'] ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?action=deleteUser&id=<?= $user['id_user'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer cet utilisateur?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>