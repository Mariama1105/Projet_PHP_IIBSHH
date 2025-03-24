<?php
$sql = "SELECT * FROM medicament";
$medicaments = mysqli_query($connexion, $sql);

if (!$medicaments) {
    die("Erreur de requête: " . mysqli_error($connexion));
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Médicaments</h2>
        <a href="index.php?action=addMedicament" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouveau Médicament
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($medicament = mysqli_fetch_assoc($medicaments)): ?>
                <tr>
                    <td><?= $medicament['id'] ?></td>
                    <td><?= $medicament['nom'] ?></td>
                    <td>
                        <a href="index.php?action=editMedicament&id=<?= $medicament['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?action=deleteMedicament&id=<?= $medicament['id'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer ce médicament?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>