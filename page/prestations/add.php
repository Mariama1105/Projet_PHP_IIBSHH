<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_patient = $_POST['id_patient'];
    $id_medecin = $_POST['id_medecin'];
    $id_cons = $_POST['id_cons'];
    $type_pres = $_POST['type_pres'];
    $date_pres = $_POST['date_pres'];

    // Insert into database
    $sql = "INSERT INTO prestations (id_patient, id_medecin, id_cons, type_pres, date_pres) 
            VALUES ('$id_patient', '$id_medecin', " . ($id_cons ? "'$id_cons'" : "NULL") . ", '$type_pres', '$date_pres')";
    
    if (mysqli_query($connexion, $sql)) {
        header("Location: index.php?action=listePrestation");
        exit();
    } else {
        $error = "Erreur: " . mysqli_error($connexion);
    }
}

// Fetch data for form
$patients = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = 4");
$medecins = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')");
$consultations = mysqli_query($connexion, "SELECT * FROM consultation");
?>

<div class="container mt-4">
    <h2 class="mb-4">Ajouter une Prestation</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST" action="index.php?action=addPrestation">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Patient</label>
                    <select name="id_patient" class="form-select" required>
                        <?php while($patient = mysqli_fetch_assoc($patients)): ?>
                            <option value="<?= $patient['id_user'] ?>"><?= $patient['prenom'] . ' ' . $patient['nom'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Médecin</label>
                    <select name="id_medecin" class="form-select" required>
                        <?php while($medecin = mysqli_fetch_assoc($medecins)): ?>
                            <option value="<?= $medecin['id_user'] ?>"><?= $medecin['prenom'] . ' ' . $medecin['nom'] ?></option>
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
                            <option value="<?= $consultation['id'] ?>">
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
                    <input type="text" name="type_pres" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="datetime-local" name="date_pres" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Enregistrer
        </button>
        <a href="index.php?action=listePrestation" class="btn btn-secondary">
            <i class="fas fa-times"></i> Annuler
        </a>
    </form>
</div>