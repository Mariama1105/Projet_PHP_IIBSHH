<?php
session_start();
require_once "shared/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IIBS Health Hub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main>
        <?php 
        if (isset($_GET['action'])) { 
            require_once "shared/navbar.php";

            // Users Actions
            if ($_GET['action'] == 'listeUser') {
                require_once "page/users/liste.php";
            }
            if ($_GET['action'] == 'addUser') {
                $roles = mysqli_query($connexion, "SELECT * FROM role");
                require_once "page/users/add.php";
            }
            if ($_GET['action'] == 'editUser') {
                $id = $_GET['id'];
                $user = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM users WHERE id_user = $id"));
                $roles = mysqli_query($connexion, "SELECT * FROM role");
                require_once "page/users/edit.php";
            }
            if ($_GET['action'] == 'updateUser') {
                $id = $_GET['id'];
                extract($_POST);
                $sql = "UPDATE users SET nom='$nom', prenom='$prenom', specialite='$specialite', id_r='$id_r', login='$login' WHERE id_user = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeUser");
            }
            if ($_GET['action'] == 'deleteUser') {
                $id = $_GET['id'];
                $sql = "DELETE FROM users WHERE id_user = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeUser");
            }

            // Consultations Actions
            if ($_GET['action'] == 'listeConsultation') {
                require_once "page/consultations/liste.php";
            }
            if ($_GET['action'] == 'addConsultation') {
                $medecins = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')");
                $patients = mysqli_query($connexion, "SELECT * FROM patient");
                require_once "page/consultations/add.php";
            }
            if ($_GET['action'] == 'editConsultation') {
                $id = $_GET['id'];
                $consultation = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM consultation WHERE id = $id"));
                $medecins = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')");
                $patients = mysqli_query($connexion, "SELECT * FROM patient");
                require_once "page/consultations/edit.php";
            }
            if ($_GET['action'] == 'updateConsultation') {
                $id = $_GET['id'];
                extract($_POST);
                $sql = "UPDATE consultation SET date='$date', id_med='$id_med', id_pat='$id_pat', constituant_pris='$constituant_pris', ordonnance='$ordonnance' WHERE id = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeConsultation");
            }
            if ($_GET['action'] == 'deleteConsultation') {
                $id = $_GET['id'];
                $sql = "DELETE FROM consultation WHERE id = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeConsultation");
            }

            // RDV Actions
            if ($_GET['action'] == 'listeRDV') {
                require_once "page/rdv/liste.php";
            }
            if ($_GET['action'] == 'addRDV') {
                $medecins = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')");
                $patients = mysqli_query($connexion, "SELECT * FROM patient");
                require_once "page/rdv/add.php";
            }
            if ($_GET['action'] == 'editRDV') {
                $id = $_GET['id'];
                $rdv = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM rendez_vous WHERE id = $id"));
                $medecins = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')");
                $patients = mysqli_query($connexion, "SELECT * FROM patient");
                require_once "page/rdv/edit.php";
            }
            if ($_GET['action'] == 'updateRDV') {
                $id = $_GET['id'];
                extract($_POST);
                $sql = "UPDATE rendez_vous SET date='$date', id_med='$id_med', id_pat='$id_pat', sujet_rdv='$sujet_rdv' WHERE id = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeRDV");
            }
            if ($_GET['action'] == 'deleteRDV') {
                $id = $_GET['id'];
                $sql = "DELETE FROM rendez_vous WHERE id = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeRDV");
            }

            // Prestations Actions
            if ($_GET['action'] == 'listePrestation') {
                require_once "page/prestations/liste.php";
            }
            if ($_GET['action'] == 'addPrestation') {
                require_once "page/prestations/add.php";
            }
            if ($_GET['action'] == 'editPrestation') {
                $id = $_GET['id'];
                $prestation = mysqli_fetch_assoc(mysqli_query($connexion, "SELECT * FROM prestation WHERE id_prestation = $id"));
                $patients = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = 4");
                $medecins = mysqli_query($connexion, "SELECT * FROM users WHERE id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')");
                $consultations = mysqli_query($connexion, "SELECT * FROM consultation");
                require_once "page/prestations/edit.php";
            }
            if ($_GET['action'] == 'updatePrestation') {
                $id = $_GET['id'];
                extract($_POST);
                $sql = "UPDATE prestation SET id_patient='$id_patient', id_medecin='$id_medecin', id_cons='$id_cons', type_pres='$type_pres', date_pres='$date_pres' WHERE id_prestation = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listePrestation"); 
            }
            if ($_GET['action'] == 'deletePrestation') {
                $id = $_GET['id'];
                $sql = "DELETE FROM prestations WHERE id_prestation = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listePrestation");
            }


            // Role Actions
            if ($_GET['action'] == 'listeRoles') {
                require_once "page/roles/liste.php";
            }

            if ($_GET['action'] == 'addRole') {
                require_once "page/roles/add.php";
            }

            if ($_GET['action'] == 'editRole') {
                require_once "page/roles/edit.php";
            }

            if ($_GET['action'] == 'updateRole') {
                $id = $_GET['id'];
                $libelle = $_POST['libelle_role'];
                $sql = "UPDATE role SET libelle_role = '$libelle' WHERE id_role = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeRoles");
            }

            if ($_GET['action'] == 'deleteRole') {
                $id = $_GET['id'];
                $sql = "DELETE FROM role WHERE id_role = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeRoles");
            }

            // médicaments
            if ($_GET['action'] == 'listeMedicaments') {
                require_once "page/medicaments/liste.php";
            }
            
            if ($_GET['action'] == 'addMedicament') {
                require_once "page/medicaments/add.php";
            }
            
            if ($_GET['action'] == 'saveMedicament') {
                $nom = $_POST['nom'];
                $sql = "INSERT INTO medicament (nom) VALUES ('$nom')";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeMedicaments");
            }
            
            if ($_GET['action'] == 'editMedicament') {
                $id = $_GET['id'];
                require_once "page/medicaments/edit.php";
            }
            
            if ($_GET['action'] == 'updateMedicament') {
                $id = $_GET['id'];
                $nom = $_POST['nom'];
                $sql = "UPDATE medicament SET nom = '$nom' WHERE id = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeMedicaments");
            }
            
            if ($_GET['action'] == 'deleteMedicament') {
                $id = $_GET['id'];
                $sql = "DELETE FROM medicament WHERE id = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeMedicaments");
            }
            if ($_GET['action'] == 'listeSpecialites') {
                require_once "page/specialites/liste.php";
            }
            
            if ($_GET['action'] == 'addSpecialite') {
                require_once "page/specialites/add.php";
            }
            
            if ($_GET['action'] == 'editSpecialite') {
                $id = $_GET['id'];
                require_once "page/specialites/edit.php";
            }
            
            if ($_GET['action'] == 'updateSpecialite') {
                $id = $_GET['id'];
                $libelle = $_POST['libelle_spe'];
                $sql = "UPDATE specialite SET libelle_spe = '$libelle' WHERE id_spe = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeSpecialites");
            }
            
            if ($_GET['action'] == 'saveSpecialite') {
                $libelle = $_POST['libelle_spe'];
                $sql = "INSERT INTO specialite (libelle_spe) VALUES ('$libelle')";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeSpecialites");
            }
            
            if ($_GET['action'] == 'deleteSpecialite') {
                $id = $_GET['id'];
                $sql = "DELETE FROM specialite WHERE id_spe = $id";
                mysqli_query($connexion, $sql);
                header("location: index.php?action=listeSpecialites");
            }

            if ($_GET['action'] == 'mesRendezVous'){
                require_once 'page/patients_interface/mesRDV.php';
            }
            if ($_GET['action'] == 'mesConsultations'){
                require_once 'page/patients_interface/mesConsultations.php';
            }

            if ($_GET['action'] == 'mesPrestations'){
                require_once 'page/patients_interface/mesPrestations.php';
            }

            if ($_GET['action'] == 'voirStats'){
                require_once 'chart.php';
            }
            if($_GET["action"] == 'creerCompte'){
                require_once "page/auth/creerCompte.php";
            }
        
            if($_GET["action"] == 'deconnexion'){
                session_destroy();
                header("Location: index.php");
            } 

        } else {


            require_once "page/auth/login.php";

        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>