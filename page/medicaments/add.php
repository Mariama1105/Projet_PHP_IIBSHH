<div class="container mt-4">
    <h2 class="mb-4">Ajouter un Médicament</h2>
    
    <form method="POST" action="index.php?action=saveMedicament">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du Médicament</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listeMedicaments" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>