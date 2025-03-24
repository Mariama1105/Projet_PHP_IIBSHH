<?php
$sql = "SELECT * FROM specialite";
$specialites = mysqli_query($connexion, $sql);

if (!$specialites) {
    die("Erreur de requête: " . mysqli_error($connexion));
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Spécialités</h2>
        <a href="index.php?action=addSpecialite" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouvelle Spécialité
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
                <?php while($specialite = mysqli_fetch_assoc($specialites)): ?>
                <tr>
                    <td><?= $specialite['id_spe'] ?></td>
                    <td><?= $specialite['libelle_spe'] ?></td>
                    <td>
                        <a href="index.php?action=editSpecialite&id=<?= $specialite['id_spe'] ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?action=deleteSpecialite&id=<?= $specialite['id_spe'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer cette spécialité?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>