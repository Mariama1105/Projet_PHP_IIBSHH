<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-hospital me-2"></i>IIBS Health Hub
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <!-- Admin/All roles -->
                <?php if ($_SESSION['user_role'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=listeUser">
                            <i class="fas fa-users me-1"></i> Utilisateurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=listeRoles">
                            <i class="fas fa-user-tag me-1"></i> Rôles
                        </a>
                    </li>
                <?php endif; ?>
                
                <!-- Doctor and Admin -->
                <?php if (in_array($_SESSION['user_role'], [1, 2])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=listeConsultation">
                            <i class="fas fa-notes-medical me-1"></i> Consultations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=listeRDV">
                            <i class="fas fa-calendar-check me-1"></i> Rendez-vous
                        </a>
                    </li>
                <?php endif; ?>
                
                <!-- Service Manager and Admin -->
                <?php if (in_array($_SESSION['user_role'], [1, 3])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=listePrestation">
                            <i class="fas fa-procedures me-1"></i> Prestations
                        </a>
                    </li>
                <?php endif; ?>
                
                <!-- Pharmacist and Admin -->
                <?php if (in_array($_SESSION['user_role'], [1, 4])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=listeMedicaments">
                            <i class="fas fa-pills me-1"></i> Médicaments
                        </a>
                    </li>
                <?php endif; ?>
                
                <!-- Patient -->
                <?php if ($_SESSION['user_role'] == 5): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=mesConsultations">
                            <i class="fas fa-notes-medical me-1"></i> Mes Consultations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=mesRendezVous">
                            <i class="fas fa-calendar-check me-1"></i> Mes Rendez-vous
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=mesPrestations">
                            <i class="fas fa-procedures me-1"></i> Mes Prestations
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> <?= $_SESSION['user_name'] ?? 'Compte' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-danger" href="index.php?action=deconnexion"><i class="fas fa-sign-out-alt me-1"></i> Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>