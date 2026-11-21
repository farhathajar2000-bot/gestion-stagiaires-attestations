<?php
    include ('../helpers.php');
    
    requireLogin();
    requireAgent();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: index.php");
        exit();
    }

    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch();

    if (!$user) {
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
                <h1 class="h3 mb-0 text-gray-800">✏️ Modifier l'utilisateur</h1>
            </div>
            <div class="d-flex justify-content-center">
                <div class="card shadow-sm border-1 bg-surface w-100" style="max-width: 600px;">
                    <div class="card-body p-4">
                        <form action="update.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nom d'utilisateur</label>
                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Adresse Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nouveau mot de passe</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Rôle</label>
                                <select name="role" class="form-select" required>
                                    <option value="etudiant" <?php if($user['role'] == 'etudiant') echo 'selected'; ?>>🎓 Étudiant</option>
                                    <option value="agent" <?php if($user['role'] == 'agent') echo 'selected'; ?>>💼 Agent Administratif</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                <a href="index.php" class="btn btn-light">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>