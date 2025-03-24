<?php
// Fetch doctors and patients
$sql = "SELECT u.id_user, u.nom, u.prenom 
        FROM users u, role r 
        WHERE u.id_r = r.id_role 
        AND r.libelle_role = 'medecin'";
$medecins = mysqli_query($connexion, $sql);

$sql = "SELECT p.id_pat, p.nom_pat, p.prenom_pat 
        FROM patient p";
$patients = mysqli_query($connexion, $sql);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_med = $_POST['id_med'];
    $id_pat = $_POST['id_pat'];
    $date = $_POST['date'];

    $sql = "INSERT INTO rendez_vous (id_med, id_pat, date) 
            VALUES ('$id_med', '$id_pat', '$date')";
    if (mysqli_query($connexion, $sql)) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Rendez-vous ajouté avec succès!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erreur lors de l'ajout du rendez-vous: " . mysqli_error($connexion) . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Ajouter un rendez-vous</h2>
    <form method="POST">
        <!-- Doctor Selection -->
        <div class="mb-4">
            <label for="id_med" class="form-label">Médecin</label>
            <select class="form-control" id="id_med" name="id_med" required>
                <?php
                while ($medecin = mysqli_fetch_assoc($medecins)) {
                    echo "<option value='{$medecin['id_user']}'>{$medecin['nom']} {$medecin['prenom']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Patient Selection -->
        <div class="mb-4">
            <label for="id_pat" class="form-label">Patient</label>
            <select class="form-control" id="id_pat" name="id_pat" required>
                <?php
                while ($patient = mysqli_fetch_assoc($patients)) {
                    echo "<option value='{$patient['id_pat']}'>{$patient['nom_pat']} {$patient['prenom_pat']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Date Input -->
        <div class="mb-4">
            <label for="date" class="form-label">Date</label>
            <input type="datetime-local" class="form-control" id="date" name="date" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
    </form>
</div>