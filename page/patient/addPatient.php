<?php
//$sql = "SELECT p.* FROM patient p,antecedants a WHERE p.id_antec=a.id_antec";
//$antecedants = mysqli_query($connexion, $sql);

$sql = "SELECT * FROM antecedants ";
$antecedants = mysqli_query($connexion, $sql);



if (!empty($_POST)) {
    extract($_POST);
    
    //if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
      //  
      //  $fileName = $_FILES['file']['name'];
      //  $fileTmpName = $_FILES['file']['tmp_name'];
      //  $fileSize = $_FILES['file']['size'];
      // // $fileType = $_FILES['file']['type'];
      //  
      //  $uploadDirectory = 'uploads/'; 
      //  
      //  if (!is_dir($uploadDirectory)) {
      //      mkdir($uploadDirectory, 0777, true);
      //  }
      //  
      //  $fileDestination = $uploadDirectory . basename($fileName);
      //  
      //  if (move_uploaded_file($fileTmpName, $fileDestination)) {
            $sql = "INSERT INTO Patients (code, nom, prenom ) VALUES ($code, '$nom', '$prenom')";
            
           if (mysqli_query($connexion, $sql)) {
                header('Location: index.php?action=listeUser');
           } else {
                echo "<div class='alert alert-danger'>Erreur lors de l'insertion</div>";
           // }
        //} else {
            //echo "<div class='alert alert-danger'>Erreur lors de la publication de l'image</div>";
       // }
   // } else {
        //echo "<div class='alert alert-danger'>Pas de fichier publié</div>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Ajouter un Patient</h3>
                </div>
                <div class="card-body">
                    <form method="POST" >
                    <div class="mb-3">
                            <label for="nom" class="form-label">Code</label>
                            <input type="Number" name="code" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_antec" class="form-label">Antécédants</label>
                            <select class="form-select" name="id_antec" required>
                                <?php while ($row = mysqli_fetch_assoc($antecedants)) { ?>
                                    <option value="<?= $row['id_antec'] ?>"><?= $row['libelle_antec'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="mt-4 d-grid gap-2">
                            <button type="submit" class="btn btn-success">Valider</button>
                            <a type="button" href="?action=listePatient" class="btn btn-danger">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>