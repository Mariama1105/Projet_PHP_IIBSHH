<?php
// Envoi de l'email de confirmation
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Traitement du formulaire
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nouveauMotDePasse = $_POST['nouveau_mot_de_passe'];
    $confirmationMotDePasse = $_POST['confirmation_mot_de_passe'];
    
    // Traitement de l'upload de fichier
    $uploadSuccess = false;
    $fileName = '';
    
    if(isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/';
        
        // Vérification et création du dossier avec is_dir()
        if(!is_dir($uploadDir)) {
            if(!mkdir($uploadDir, 0755, true)) {
                $error = "Impossible de créer le dossier d'upload";
            }
        }
        
        if(!isset($error)) {
            $fileName = uniqid() . '_' . basename($_FILES['fichier']['name']); // Ajout d'un ID unique
            $uploadPath = $uploadDir . $fileName;
            $fileType = strtolower(pathinfo($uploadPath, PATHINFO_EXTENSION));
            
            // Vérifications de sécurité
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
            if(in_array($fileType, $allowedTypes)) {
                if(move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadPath)) {
                    $uploadSuccess = true;
                } else {
                    $error = "Erreur lors de l'enregistrement du fichier";
                }
            } else {
                $error = "Type de fichier non autorisé. Formats acceptés: JPG, PNG, GIF, PDF";
            }
        }
    }
    
    if(!isset($error) && $nouveauMotDePasse !== $confirmationMotDePasse) {
        $error = "Les mots de passe ne correspondent pas";
    }
    
    if(!isset($error)) {
        // Mettre à jour le mot de passe et l'état
        $userId = $_SESSION['user_id'];
        $sql = "UPDATE users SET password = '$nouveauMotDePasse', etat = 1";
        
        // Ajouter le nom du fichier si upload réussi
        if($uploadSuccess) {
            $sql .= ", fichier = '$fileName'";
        }
        
        $sql .= " WHERE id_user = $userId";
        
        if(mysqli_query($connexion, $sql)) {
            // Récupérer les infos de l'utilisateur pour l'email
            $sqlUser = "SELECT nom, prenom, login FROM users WHERE id_user = $userId";
            $resultUser = mysqli_query($connexion, $sqlUser);
            $user = mysqli_fetch_assoc($resultUser);
            
            $mail = new PHPMailer(true);
            
            try {
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io'; 
                $mail->SMTPAuth = true; 
                $mail->Username = '6a18f5db4a7113'; 
                $mail->Password = '1ec7b831a4daf6'; 
                $mail->Port = 2525; 

                $mail->setFrom('no-reply@example.com', 'IIBS Health Hub'); 
                $mail->addAddress($user['login'], $user['nom'] . ' ' . $user['prenom']); 

                $mail->isHTML(true); 
                $mail->Subject = 'Votre mot de passe a ete change'; 
                $mail->Body = "
                    <h3>Bonjour {$user['nom']} {$user['prenom']},</h3>
                    <p>Votre mot de passe a ete change avec succes.</p>
                    " . ($uploadSuccess ? "<p>Votre fichier a bien été enregistré.</p>" : "") . "
                    <p>Si vous n'avez pas effectue cette action, veuillez contacter l'administrateur immediatement.</p>
                    <p>Cordialement,<br>L'équipe IIBS Health Hub</p>
                "; 

                $mail->send();
            } catch (Exception $e) {
                $_SESSION['mail_error'] = "Le mot de passe a été changé, mais l'email de confirmation n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
            }
            
            $_SESSION['success'] = "Votre mot de passe a été changé avec succès" . ($uploadSuccess ? " et votre fichier a été enregistré" : "");
            header("Location: index.php?action=listeConsultation");
            exit();
        } else {
            $error = "Une erreur s'est produite lors de la mise à jour du mot de passe";
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card col-md-6 col-lg-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0 text-center">Changement de mot de passe</h4>
        </div>
        <div class="card-body">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['mail_error'])): ?>
                <div class="alert alert-warning alert-dismissible fade show">
                    <?= $_SESSION['mail_error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['mail_error']); ?>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nouveau_mot_de_passe" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required>
                </div>
                
                <div class="mb-3">
                    <label for="confirmation_mot_de_passe" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" required>
                </div>
                
                <div class="mb-3">
                    <label for="fichier" class="form-label">Fichier (optionnel)</label>
                    <input type="file" class="form-control" id="fichier" name="fichier" accept=".jpg,.jpeg,.png,.gif,.pdf">
                    <small class="text-muted">Formats acceptés: JPG, PNG, GIF, PDF (max 2MB)</small>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Changer le mot de passe</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <small class="text-muted">IIBS HEALTH HUB <?= date('Y') ?></small>
        </div>
    </div>
</div>