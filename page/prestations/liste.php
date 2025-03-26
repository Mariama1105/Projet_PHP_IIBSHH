<?php
$sql = "SELECT p.*, 
               patient.prenom AS patient_prenom, patient.nom AS patient_nom,
               medecin.prenom AS medecin_prenom, medecin.nom AS medecin_nom,
               c.date AS consultation_date
        FROM prestations p
        LEFT JOIN users patient ON p.id_patient = patient.id_user
        LEFT JOIN users medecin ON p.id_medecin = medecin.id_user
        LEFT JOIN consultation c ON p.id_cons = c.id";

$prestations = mysqli_query($connexion, $sql);

if (!$prestations) {
    die("Erreur de requête: " . mysqli_error($connexion));
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Prestations</h2>
        <a href="index.php?action=addPrestation" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouvelle Prestation
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Médecin</th>
                    <th>Consultation</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($prestation = mysqli_fetch_assoc($prestations)): ?>
                <tr>
                    <td><?= $prestation['id_prestation'] ?></td>
                    <td><?= $prestation['patient_prenom'] . ' ' . $prestation['patient_nom'] ?></td>
                    <td><?= $prestation['medecin_prenom'] . ' ' . $prestation['medecin_nom'] ?></td>
                    <td><?= $prestation['consultation_date'] ? date('d/m/Y H:i', strtotime($prestation['consultation_date'])) : '-' ?></td>
                    <td><?= $prestation['type_pres'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($prestation['date_pres'])) ?></td>
                    <td>
                        <a href="index.php?action=editPrestation&id=<?= $prestation['id_prestation'] ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?action=deletePrestation&id=<?= $prestation['id_prestation'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer cette prestation?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>