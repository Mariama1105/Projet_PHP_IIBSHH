<?php
$sql = "SELECT c.*, u.nom AS med_nom, u.prenom AS med_prenom, 
               p.nom AS nom_pat, p.prenom AS prenom_pat
        FROM consultation c, users u, users p
        WHERE c.id_med = u.id_user 
        AND c.id_pat = p.id_user";
$result = mysqli_query($connexion, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connexion));
}
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Consultations</h2>
        <a href="index.php?action=addConsultation" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle Consultation
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Patient</th>
                    <th>Constituant</th>
                    <th>Ordonnance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['date'])) ?></td>
                        <td><?= $row['med_prenom'] . ' ' . $row['med_nom'] ?></td>
                        <td><?= $row['prenom_pat'] . ' ' . $row['nom_pat'] ?></td>
                        <td><?= $row['constituant_pris'] ?></td>
                        <td><?= $row['ordonnance'] == "" ? "Aucune Ordonnane": $row['ordonnance'] ?></td>
                        <td>
                            <a href="index.php?action=editConsultation&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?action=deleteConsultation&id=<?= $row['id'] ?>" 
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Supprimer cette consultation?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucune consultation trouvée</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">