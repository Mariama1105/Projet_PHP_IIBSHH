<?php

$sql = "SELECT * FROM Patient";
$specialite = mysqli_query($connexion,$sql);


?>

<div class="container mt-5">
    <h2 class="mb-4">Liste des patients</h2>
    <a class="btn btn-success mb-4" href="?action=addPatient">Nouveau</a>
    <a class="btn btn-success mb-4" href="?action=addRendez-Vous">Rendez-vous</a>
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Antécédants</th> 
                <th scope="col">Login</th> 
                <th scope="col">Téléphone</th> 
                <th scope="col">Actions</th>               
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($specialite)) { ?>
                <tr>
                    <td><?= $row['id_pat'] ?></td>
                    <td><?= $row['nom_pat'] ?></td>
                    <td><?= $row['prenom_pat'] ?></td>
                    <td><?= $row['id_antec'] ?></td>
                    <td><?= $row['login'] ?></td>
                    <td><?= $row['telephone'] ?></td>     
                    <td>
                        <a class="btn btn-primary btn-sm" href="?action=editPatient&id=<?= $row['id_pat'] ?>">Modifier</a>
                        <a class="btn btn-danger btn-sm" href="?action=deletePatient&id=<?= $row['id_pat'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>