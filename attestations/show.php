<?php
    include ('../helpers.php');
    
    requireLogin();
    requireAgent();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: index.php");
        exit();
    }

    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT a.*, s.firstname, s.lastname, s.cin, s.code_student, s.filiere FROM attestations a JOIN students s ON a.student_id = s.id WHERE a.id = ? ");
    $stmt->execute([$_GET['id']]);
    $attestation = $stmt->fetch();

    if (!$attestation) {
        header("Location: index.php");
        exit();
    }

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
                <a href="index.php" class="btn btn-link text-decoration-none p-0 mb-2">← Retour à la liste des demandes</a>
                <h1 class="h3 mb-0 text-gray-800">🔍 Détail de la demande #<?php echo $attestation['id']; ?></h1>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-bottom pt-3 pb-2">
                            <h5 class="text-primary mb-0">📄 Document demandé</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-muted d-block small fw-bold">Type de document</span>
                                <span class="fs-5"><?php echo "Attestation de scolarité"; ?></span>
                            </div>
                            
                            <div class="mb-3">
                                <span class="text-muted d-block small fw-bold">Date de la demande</span>
                                <span><?php echo htmlspecialchars($attestation['created_at']); ?></span>
                            </div>

                            <div class="mb-3">
                                <span class="text-muted d-block small fw-bold mb-1">Statut actuel</span>
                                    <td><?php if(!empty($item['validated_at'])) { ?>
                                        <span class="badge bg-success">Validée</span>
                                    <?php } else { ?>
                                        <span class="badge bg-warning">En attente</span>
                                    <?php } ?></td>
                            </div>
                        </div>
                        <div class="card-footer bg-light border-0 p-3 text-center">
                            <a href="edit.php?id=<?php echo $attestation['id']; ?>" class="btn btn-primary">✏️ Modifier </a>
                            <a href="delete.php?id=<?php echo $attestation['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">🗑️ Supprimer</a>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-bottom pt-3 pb-2">
                            <h5 class="text-secondary mb-0">🎓 Identité du demandeur</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-5 text-muted fw-bold">Nom complet</div>
                                <div class="col-sm-7 fw-bold text-dark">
                                    <?php echo htmlspecialchars($attestation['firstname'] . ' ' . $attestation['lastname']); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-5 text-muted fw-bold">Code Étudiant</div>
                                <div class="col-sm-7">
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($attestation['code_student']); ?></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-5 text-muted fw-bold">CIN</div>
                                <div class="col-sm-7"><?php echo htmlspecialchars($attestation['cin']); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-5 text-muted fw-bold">Filière</div>
                                <div class="col-sm-7"><?php echo htmlspecialchars($attestation['filiere']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>