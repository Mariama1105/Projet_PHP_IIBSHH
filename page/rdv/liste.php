<?php
$sql = "SELECT r.*, u.*, p.*
        FROM rendez_vous r, users u, patient p
        WHERE r.id_med = u.id_user 
          AND r.id_pat = p.id_pat";
$rdvs = mysqli_query($connexion, $sql);

if (!$rdvs) {
    die("SQL query failed: " . mysqli_error($connexion));
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Liste des rendez-vous</h2>
    <a class="btn btn-success mb-4" href="?action=addRDV">Nouveau rendez-vous</a>
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Médecin</th>
                <th scope="col">Patient</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($rdvs)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['nom'] . ' ' . $row['prenom'] ?></td> 
                    <td><?= $row['nom_pat'] . ' ' . $row['prenom_pat'] ?></td>
                    <td>
                        <a href="index.php?action=editRDV&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?action=deleteRDV&id=<?= $row['id'] ?>" 
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Supprimer ce rendez-vous?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>