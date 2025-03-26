<?php
// Vérifier et créer le dossier images s'il n'existe pas
$uploadDir = 'images/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    $filePath = null;
    
    // Gestion de l'upload du fichier
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($_FILES['file']['name']);
        $filePath = $uploadDir . uniqid() . '_' . $fileName;
        
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $error = "Erreur lors de l'upload du fichier";
        }
    }

    if (!isset($error)) {
        $sql = "INSERT INTO users (nom, prenom, specialite, id_r, login, password, file) 
                VALUES ('$nom', '$prenom', '$specialite', 4, '$login', '$password', " . ($filePath ? "'$filePath'" : "NULL") . ")";
        if (mysqli_query($connexion, $sql)) {
            header("location: index.php");
            exit();
        } else {
            $error = "Erreur lors de l'ajout de l'utilisateur: " . mysqli_error($connexion);
            // Supprimer le fichier uploadé si l'insertion a échoué
            if ($filePath && file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Créer un Compte Utilisateur</h2>
    
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Champ Spécialité caché -->
        <input type="hidden" name="specialite" value="Pas de specialite">
        
        <!-- Champ Rôle caché avec valeur 4 -->
        <input type="hidden" name="id_r" value="4">

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Login</label>
                    <input type="text" name="login" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Photo de profil</label>
            <input type="file" name="file" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Créer le compte
        </button>
    </form>
</div>