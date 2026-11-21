<?php
    include ('../helpers.php');

    requireLogin();
    requireAgent(); 
    
    $pdo = Database::getConnection();
    $stmt = $pdo->query("SELECT id, username, email FROM users WHERE role = 'etudiant'");
    $rolStu = $stmt->fetchAll();
    // dd($rolStu);
    $page_active = 'students';
    $path = '../';
    include ('../partials/activeOrNot.php');
    include('../partials/header.php');
?>

<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-3 col-xl-2 px-0 bg-white border-end">
            <?php include ('../partials/sidebar.php'); ?>
        </div>

        <div class="col-md-9 col-xl-10 p-4">
            
            <div class="mb-4">
                <a href="index.php" class="btn btn-link text-decoration-none p-0 mb-2">← Retour à la liste</a>
                <h1 class="h3 mb-0 text-gray-800">✨ Ajouter un étudiant</h1>
            </div>

            <div class="d-flex justify-content-center">
                <div class="card shadow-sm border-1 bg-surface w-100">
                    <div class="card-body p-4">
                        <form action="store.php" method="POST">

                        <div class="mb-4 p-3 bg-light rounded border">
                            <label class="form-label fw-bold text-primary"> Compte utilisateur</label>
                            <select name="user_id" class="form-select border-primary" >
                                <option value="" selected disabled> Choisir le compte de connexion...</option>
                                <?php foreach ($rolStu as $compte) : ?>
                                    <option value="<?php echo $compte['id']; ?>">
                                        <?php echo htmlspecialchars($compte['username']) . ' (' . htmlspecialchars($compte['email']) . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($_GET['error']) && $_GET['error'] == 'missing_user') : ?>
                                <div class="text-danger mt-1" style="font-size: 0.85rem; font-weight: 500;">
                                    Veuillez choisir un compte utilisateur.
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Prénom d'étudiant</label>
                                <input type="text" name="firstname" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nom d'étudiant</label>
                                <input type="text" name="lastname" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Date de naissance</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">code d'étudiant</label>
                                <input type="text" name="student_code" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">CIN</label>
                                <input type="text" name="cin" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Filière</label>
                                <select name="field" class="form-select" required>
                                    <option value="" selected disabled>Choisir une filière...</option>
                                    <option value="Développement Digital">Développement Digital (DD)</option>
                                    <option value="Infrastructure Digitale">Infrastructure Digitale (ID)</option>
                                    <option value="Gestion des Entreprises">Gestion des Entreprises (GE)</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Enregistrer l'étudiant</button>
                        </div>

                    </form>
                </div>
            </div>

        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>