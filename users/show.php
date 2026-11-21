<?php
    include('../helpers.php');

    requireLogin();
    requireAgent();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: index.php");
        exit();
    }


    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT id, username, email, role FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $userDetail = $stmt->fetch();

    //empêche l'accès par l'url à un id qui n'existe pas 
    if (!$userDetail) {
        header("Location: index.php");
        exit();
    }

    $page_active = 'users';
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
                <h1 class="h3 mb-0 text-gray-800">👁️ Détails de l'utilisateur</h1>
            </div>
            <div class="d-flex justify-content-center">
                <div class="card shadow-sm border-1 bg-surface w-100" style="max-width: 600px;">
                    <div class="card-header bg-white pt-4 pb-3 text-center">
                        <div class="avatar-placeholder bg-primary bg-gradient rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <span class="text-white fw-bold" style="font-size: 30px;">
                                <?php echo strtoupper(substr($userDetail['username'], 0, 1)); ?>
                            </span>
                        </div>
                        <h4 class="mb-1"><?php echo htmlspecialchars($userDetail['username']); ?></h4>
                        <p class="mb-0">
                            <?php if ($userDetail['role'] === 'agent') : ?>
                                <span class="badge bg-danger">Agent Administratif</span>
                            <?php else : ?>
                                <span class="badge bg-info">Étudiant</span>
                            <?php endif; ?>
                        </p>
                    </div>

                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">ID User</div>
                            <div class="col-sm-8"><span class="badge bg-secondary">#<?php echo htmlspecialchars($userDetail['id']); ?></span></div>
                        </div>
                        <hr class="text-muted opacity-25">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Adresse Email</div>
                            <div class="col-sm-8"><?php echo htmlspecialchars($userDetail['email']); ?></div>
                        </div>

                    </div>

                    <div class="card-footer bg-light border-0 p-3 text-center">
                        <a href="edit.php?id=<?php echo $userDetail['id']; ?>" class="btn btn-primary">✏️ Modifier</a>
                        <a href="delete.php?id=<?php echo $userDetail['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">🗑️ Supprimer</a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>