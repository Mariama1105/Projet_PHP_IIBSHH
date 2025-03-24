<?php
$id = $_GET['id'];
$specialite = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM specialite WHERE id_spe = $id"));
?>

<div class="container mt-4">
    <h2 class="mb-4">Modifier Spécialité</h2>
    
    <form method="POST" action="index.php?action=updateSpecialite&id=<?= $specialite['id_spe'] ?>">
        <div class="mb-3">
            <label for="libelle_spe" class="form-label">Libellé de la Spécialité</label>
            <input type="text" class="form-control" id="libelle_spe" name="libelle_spe" 
                   value="<?= $specialite['libelle_spe'] ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listeSpecialites" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>