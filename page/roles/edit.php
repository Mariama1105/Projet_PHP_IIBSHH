<?php
$role = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM role WHERE id_role = {$_GET['id']}"));
?>

<div class="container mt-4">
    <h2 class="mb-4">Modifier Rôle</h2>
    
    <form method="POST" action="index.php?action=updateRole&id=<?= $role['id_role'] ?>">
        <div class="mb-3">
            <label for="libelle_role" class="form-label">Libellé du Rôle</label>
            <input type="text" class="form-control" id="libelle_role" name="libelle_role" 
                   value="<?= $role['libelle_role'] ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listeRoles" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>