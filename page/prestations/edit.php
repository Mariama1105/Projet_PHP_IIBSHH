<?php
    $medecins = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')");
?>
<div class="container mt-4">
    <h2 class="mb-4">Modifier Prestation</h2>
    
    <form method="POST" action="index.php?action=updatePrestation&id=<?= $prestation['id_prestation'] ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Patient</label>
                    <select name="id_patient" class="form-select" required>
                        <?php while($patient = mysqli_fetch_assoc($patients)): ?>
                            <option value="<?= $patient['id_pat'] ?>" <?= $patient['id_pat'] == $prestation['id_patient'] ? 'selected' : '' ?>>
                                <?= $patient['prenom_pat'] . ' ' . $patient['nom_pat'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Médecin</label>
                    <select name="id_medecin" class="form-select" required>
                        <?php while($medecin = mysqli_fetch_assoc($medecins)): ?>
                            <option value="<?= $medecin['id_user'] ?>" <?= $medecin['id_user'] == $prestation['id_medecin'] ? 'selected' : '' ?>>
                                <?= $medecin['prenom'] . ' ' . $medecin['nom'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Consultation</label>
                    <select name="id_cons" class="form-select">
                        <option value="">-- Sélectionner --</option>
                        <?php while($consultation = mysqli_fetch_assoc($consultations)): ?>
                            <option value="<?= $consultation['id'] ?>" <?= $consultation['id'] == $prestation['id_cons'] ? 'selected' : '' ?>>
                                <?= date('d/m/Y H:i', strtotime($consultation['date'])) ?> - 
                                <?= $consultation['constituant_pris'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Type de Prestation</label>
                    <input type="text" name="type_pres" class="form-control" value="<?= $prestation['type_pres'] ?>" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="datetime-local" name="date_pres" class="form-control" 
                   value="<?= date('Y-m-d\TH:i', strtotime($prestation['date_pres'])) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listePrestation" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>