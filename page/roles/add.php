<?php
    $libelle = $_POST['libelle_role'];
    $sql = "INSERT INTO role (libelle_role) VALUES ('$libelle')";
    mysqli_query($connexion, $sql);
    header("location: index.php?action=listeRoles");
?>
<div class="container mt-4">
    <h2 class="mb-4">Ajouter un Rôle</h2>
    
    <form method="POST" action="index.php?action=saveRole">
        <div class="mb-3">
            <label for="libelle_role" class="form-label">Libellé du Rôle</label>
            <input type="text" class="form-control" id="libelle_role" name="libelle_role" required>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listeRoles" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>