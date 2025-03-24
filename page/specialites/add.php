<div class="container mt-4">
    <h2 class="mb-4">Ajouter une Spécialité</h2>
    
    <form method="POST" action="index.php?action=saveSpecialite">
        <div class="mb-3">
            <label for="libelle_spe" class="form-label">Libellé de la Spécialité</label>
            <input type="text" class="form-control" id="libelle_spe" name="libelle_spe" required>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listeSpecialites" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>