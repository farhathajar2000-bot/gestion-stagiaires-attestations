<?php

    include ('../helpers.php');
    
    requireLogin();
    requireAgent();

    $pdo = Database::getConnection();
    $stmtStudents = $pdo->query("SELECT id, firstname, lastname, cin FROM students");
    $etudiants = $stmtStudents->fetchAll();

    $page_active = 'attestations'; 
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
                <h1 class="h3 mb-0 text-gray-800">➕ Créer une attestation</h1>
            </div>

            <div class="d-flex justify-content-center">
                <div class="card shadow-sm border-0 w-100" style="max-width: 600px;">
                    <div class="card-body p-4">
                        <form action="store.php" method="POST">
                            
                            <div class="mb-4 p-3 bg-light rounded border">
                                <label class="form-label fw-bold text-primary">🎓 Étudiant demandeur</label>
                                <select name="student_id" class="form-select border-primary" >
                                    <option value="" selected disabled>Rechercher l'étudiant...</option>
                                    <?php foreach ($etudiants as $etu) : ?>
                                        <option value="<?php echo $etu['id']; ?>">
                                            <?php echo htmlspecialchars($etu['firstname'] . ' ' . $etu['lastname']) . ' (CIN: ' . htmlspecialchars($etu['cin']) . ')'; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($_GET['error']) && $_GET['error'] == 'missing_data') : ?>
                                    <div class="text-danger mt-1" style="font-size: 0.85rem; font-weight: 500;">
                                        Veuillez sélectionner un étudiant.
                                    </div>
                                <?php endif; ?>
                            </div>

                        <div class="mb-4 form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="check" id="now">
                            <label class="form-check-label fw-bold" for="now"> Valider </label>        
                        </div>

                        <hr>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Enregistrer l'attestation</button>
                        </div>
                    </form>
                </div>
            </div>

        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>