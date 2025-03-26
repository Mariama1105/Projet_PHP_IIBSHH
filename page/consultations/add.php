<?php
// Fetch doctors and patients
$sql = "SELECT u.id_user, u.nom, u.prenom 
        FROM users u, role r 
        WHERE u.id_r = r.id_role 
        AND r.libelle_role = 'medecin'";
$medecins = mysqli_query($connexion, $sql);

$sql = "SELECT * FROM users where id_r = 4";
$patients = mysqli_query($connexion, $sql);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_med = $_POST['id_med'];
    $id_pat = $_POST['id_pat'];
    $constituant_pris = $_POST['constituant_pris'];

    $sql = "INSERT INTO consultation (id_med, id_pat, constituant_pris) 
            VALUES ('$id_med', '$id_pat', '$constituant_pris')";
    if (mysqli_query($connexion, $sql)) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Consultation ajoutée avec succès!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erreur lors de l'ajout de la consultation: " . mysqli_error($connexion) . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Ajouter une consultation</h2>
    <form method="POST" class="bg-light p-4 rounded shadow-sm">
        <!-- Doctor Selection -->
        <div class="mb-4">
            <label for="id_med" class="form-label fw-bold">Médecin</label>
            <select class="form-control form-select" id="id_med" name="id_med" required>
                <?php
                while ($medecin = mysqli_fetch_assoc($medecins)) {
                    echo "<option value='{$medecin['id_user']}'>{$medecin['nom']} {$medecin['prenom']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Patient Selection -->
        <div class="mb-4">
            <label for="id_pat" class="form-label fw-bold">Patient</label>
            <select class="form-control form-select" id="id_pat" name="id_pat" required>
                <?php
                while ($patient = mysqli_fetch_assoc($patients)) {
                    echo "<option value='{$patient['id_user']}'>{$patient['nom']} {$patient['prenom']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Constituant Pris Input -->
        <div class="mb-4">
            <label for="constituant_pris" class="form-label fw-bold">Constituant pris</label>
            <input type="text" class="form-control" id="constituant_pris" name="constituant_pris" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Enregistrer</button>
    </form>
</div>