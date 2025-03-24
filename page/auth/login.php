<?php

if(isset($_SESSION['user_id'])) {
    header("Location: index.php?action=listeConsultation");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = mysqli_real_escape_string($connexion, $_POST['login']);
    $password = mysqli_real_escape_string($connexion, $_POST['password']);

    $sql = "SELECT id_user, nom, prenom, id_r FROM users WHERE login = '$login' AND password = '$password'";
    $result = mysqli_query($connexion, $sql);

    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];
        $_SESSION['user_role'] = $user['id_r'];
        
        header("Location: index.php?action=listeConsultation");
        exit();
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card col-md-6 col-lg-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0 text-center">Connexion</h4>
        </div>
        <div class="card-body">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <small class="text-muted">IIBS HEALTH HUB <?= date('Y') ?></small>
        </div>
    </div>
</div>