<div class="container mt-4">
    <h2 class="mb-4">Modifier Consultation</h2>
    
    <form method="POST" action="index.php?action=updateConsultation&id=<?= $consultation['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="datetime-local" class="form-control" name="date" value="<?= date('Y-m-d\TH:i', strtotime($consultation['date'])) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Médecin</label>
            <select class="form-select" name="id_med" required>
                <?php while($medecin = mysqli_fetch_assoc($medecins)): ?>
                    <option value="<?= $medecin['id_user'] ?>" <?= $medecin['id_user'] == $consultation['id_med'] ? 'selected' : '' ?>>
                        <?= $medecin['prenom'] . ' ' . $medecin['nom'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Patient</label>
            <select class="form-select" name="id_pat" required>
                <?php while($patient = mysqli_fetch_assoc($patients)): ?>
                    <option value="<?= $patient['id_pat'] ?>" <?= $patient['id_pat'] == $consultation['id_pat'] ? 'selected' : '' ?>>
                        <?= $patient['prenom_pat'] . ' ' . $patient['nom_pat'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Constituant Pris</label>
            <input type="text" class="form-control" name="constituant_pris" value="<?= $consultation['constituant_pris'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Ordonnance</label>
            <textarea class="form-control" name="ordonnance"><?= $consultation['ordonnance'] ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="index.php?action=listeConsultation" class="btn btn-secondary">Annuler</a>
    </form>
</div>