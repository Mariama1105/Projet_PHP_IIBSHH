<?php
$id = $_GET['id'];
$medicament = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM medicament WHERE id = $id"));
?>

<div class="container mt-4">
    <h2 class="mb-4">Modifier Médicament</h2>
    
    <form method="POST" action="index.php?action=updateMedicament&id=<?= $medicament['id'] ?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du Médicament</label>
            <input type="text" class="form-control" id="nom" name="nom" 
                   value="<?= $medicament['nom'] ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listeMedicaments" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>