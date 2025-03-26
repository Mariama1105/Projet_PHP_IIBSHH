<?php
$patient_id = $_SESSION['user_id'];
$sql = "SELECT c.*, u.nom, u.prenom 
        FROM consultation c 
        JOIN users u ON c.id_med = u.id_user 
        WHERE c.id_pat = '$patient_id'
        ORDER BY c.date DESC";
$result = mysqli_query($connexion, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connexion));
}
?>

<div class="container mt-4">
    <h2><i class="fas fa-notes-medical me-2"></i> Mes Consultations</h2>
    
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Constituants Pris</th>
                    <th>Ordonnance</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)): 
                ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($row['date'])) ?></td>
                    <td>Dr. <?= $row['prenom'] ?> <?= $row['nom'] ?></td>
                    <td><?= $row['constituant_pris'] ?></td>
                    <td><?= $row['ordonnance'] ? $row['ordonnance'] : "Auncune Ordonnance Prescrite" ?></td>
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