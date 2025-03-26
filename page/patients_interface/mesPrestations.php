<?php
// Get prestations for the current patient
$patient_id = $_SESSION['user_id'];
$sql = "SELECT p.*, u.nom, u.prenom
        FROM prestations p 
        JOIN users u ON p.id_medecin = u.id_user 
        WHERE p.id_patient = '$patient_id'
        ORDER BY p.date_pres DESC";
$result = mysqli_query($connexion, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connexion));
}
?>

<div class="container mt-4">
    <h2><i class="fas fa-procedures me-2"></i> Mes Prestations</h2>
    
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Type</th>
                    <th>Consultation liée</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)): 
                ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($row['date_pres'])) ?></td>
                    <td>Dr. <?= $row['prenom'] ?> <?= $row['nom'] ?></td>
                    <td><?= $row['type_pres'] ?></td>
                    <td><?= $row['id_cons'] ?></td>
                </tr>
                <?php 
                    endwhile;
                } else {
                    echo '<tr><td colspan="4" class="text-center">Aucune consultation trouvée</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>