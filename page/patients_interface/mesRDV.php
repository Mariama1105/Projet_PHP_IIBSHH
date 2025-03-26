<?php
// Get appointments for the current patient
$patient_id = $_SESSION['user_id'];
$sql = "SELECT r.*, u.nom, u.prenom 
        FROM rendez_vous r 
        JOIN users u ON r.id_med = u.id_user 
        WHERE r.id_pat = '$patient_id'
        ORDER BY r.date DESC";
$result = mysqli_query($connexion, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connexion));
}
?>

<div class="container mt-4">
    <h2><i class="fas fa-calendar-check me-2"></i> Mes Rendez-vous</h2>
    
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Sujet</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)): 
                ?>                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($row['date'])) ?></td>
                    <td>Dr. <?= $row['prenom'] ?> <?= $row['nom'] ?></td>
                    <td><?= $row['sujet_rdv'] ?></td>
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