<?php
    include('../helpers.php');

    requireLogin();
    requireAgent();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: index.php");
        exit();
    }

    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT id, firstname, lastname, date_of_birth, code_student, cin, filiere FROM students WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $studentDetails = $stmt->fetch();
    // dd($studentDetails);

    //empêche l'accès par l'url à un id qui n'existe pas 
    if (!$studentDetails) {
        header("Location: index.php");
        exit();
    }

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
                <h1 class="h3 mb-0 text-gray-800">👁️ Détails de l'étudiant</h1>
            </div>
            <div class="d-flex justify-content-center">
                <div class="card shadow-sm border-1 bg-surface w-100" style="max-width: 600px;">
                    <div class="card-header bg-white pt-4 pb-3 text-center">
                        <div class="avatar-placeholder bg-primary bg-gradient rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <span class="text-white fw-bold" style="font-size: 30px;">
                                <?php echo strtoupper(substr($studentDetails['firstname'], 0, 1)) .''. strtoupper(substr($studentDetails['lastname'], 0, 1)) ; ?>
                            </span>
                        </div>
                        <h4 class="mb-1"><?php echo htmlspecialchars($studentDetails['firstname']) . ' ' . htmlspecialchars($studentDetails['lastname']); ?></h4>
                        <p class="mb-0"><span class="badge bg-info">Étudiant</span></p>
                    </div>

                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">ID Étudiant</div>
                            <div class="col-sm-8"><span class="badge bg-secondary">#<?php echo htmlspecialchars($studentDetails['id']); ?></span></div>
                        </div>
                        <hr class="text-muted opacity-25">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Prénom</div>
                            <div class="col-sm-8"><?php echo htmlspecialchars($studentDetails['firstname']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Nom</div>
                            <div class="col-sm-8"><?php echo htmlspecialchars($studentDetails['lastname']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Date de naissance</div>
                            <div class="col-sm-8"><?php echo htmlspecialchars($studentDetails['date_of_birth']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Code d'étudiant</div>
                            <div class="col-sm-8"><?php echo htmlspecialchars($studentDetails['code_student']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">CIN</div>
                            <div class="col-sm-8"><?php echo htmlspecialchars($studentDetails['cin']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Filière</div>
                            <div class="col-sm-8"><?php echo htmlspecialchars($studentDetails['filiere']); ?></div>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-0 p-3 text-center">
                        <a href="edit.php?id=<?php echo $studentDetails['id']; ?>" class="btn btn-primary">✏️ Modifier</a>
                        <a href="delete.php?id=<?php echo $studentDetails['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">🗑️ Supprimer</a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>