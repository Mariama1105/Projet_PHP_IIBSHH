<?php
$sql = "SELECT * FROM role";
$roles = mysqli_query($connexion, $sql);

if (!$roles) {
    die("Erreur de requête: " . mysqli_error($connexion));
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Rôles</h2>
        <a href="index.php?action=addRole" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouveau Rôle
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($role = mysqli_fetch_assoc($roles)): ?>
                <tr>
                    <td><?= $role['id_role'] ?></td>
                    <td><?= $role['libelle_role'] ?></td>
                    <td>
                        <a href="index.php?action=editRole&id=<?= $role['id_role'] ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?action=deleteRole&id=<?= $role['id_role'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer ce rôle?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>