<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    $sql = "INSERT INTO users (nom, prenom, specialite, id_r, login, password, file) 
            VALUES ('$nom', '$prenom', '$specialite', '$id_r', '$login', '$password', '$file')";
    if (mysqli_query($connexion, $sql)) {
        header("location: index.php?action=listeUser");
        exit();
    } else {
        $error = "Erreur lors de l'ajout de l'utilisateur";
    }
}

$sql_specialite = "SELECT * FROM specialite";
$specialites = mysqli_query($connexion, $sql_specialite);
?>

<div class="container mt-4">
    <h2 class="mb-4">Ajouter un Utilisateur</h2>
    
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
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
                    se
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Spécialité</label>
                    <div class="mb-3">
                        <label for="" class="form-label">City</label>
                        <select class="form-select" name="specialite" id="">
                            <option value="Pas de specialite">Pas de Specialite</option>
                            <?php while($specialite = mysqli_fetch_assoc($specialites)):?>
                                <option value="<?= $specialite['id_specialite']?>"><?= $specialite['libelle_spe']?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    

                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Rôle</label>
                    <select name="id_r" class="form-select" required>
                        <?php while($role = mysqli_fetch_assoc($roles)): ?>
                            <option value="<?= $role['id_role'] ?>"><?= $role['libelle_role'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </div>

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
            <input type="file" name="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
    </form>
</div>