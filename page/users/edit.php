<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    extract($_POST);
    $sql = "UPDATE users SET 
            nom = '$nom',
            prenom = '$prenom',
            specialite = '$specialite',
            id_r = '$id_r',
            login = '$login'
            WHERE id_user = $id";
    if (mysqli_query($connexion, $sql)) {
        header("location: index.php?action=listeUser");
        exit();
    } else {
        $error = "Erreur lors de la modification";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4">Modifier l'Utilisateur</h2>
    
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?= $user['nom'] ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?= $user['prenom'] ?>" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Spécialité</label>
                    <input type="text" name="specialite" class="form-control" value="<?= $user['specialite'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Rôle</label>
                    <select name="id_r" class="form-select" required>
                        <?php while($role = mysqli_fetch_assoc($roles)): ?>
                            <option value="<?= $role['id_role'] ?>" <?= $role['id_role'] == $user['id_r'] ? 'selected' : '' ?>>
                                <?= $role['libelle_role'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Login</label>
                    <input type="text" name="login" class="form-control" value="<?= $user['login'] ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe (laisser vide si inchangé)</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Photo de profil</label>
            <input type="file" name="file" class="form-control">
            <?php if($user['file']): ?>
                <small class="text-muted">Fichier actuel: <?= $user['file'] ?></small>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listeUser" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>