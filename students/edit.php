<?php
    include ('../helpers.php');
    
    requireLogin();
    requireAgent();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: index.php");
        exit();
    }

    $pdo = Database::getConnection();
    $stmt = $pdo->prepare(" SELECT s.*, u.email FROM students s JOIN users u ON s.user_id = u.id WHERE s.id = ?");
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch();
    //dd($student);

    if (!$student) {
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
                <h1 class="h3 mb-0 text-gray-800">✏️ Modifier le dossier étudiant</h1>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

                            <div class="mb-4 p-3 bg-light rounded border">
                                <label class="form-label fw-bold text-primary">🔗 Compte utilisateur lié</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($student['email']); ?>" disabled>
                                <input type="hidden" name="user_id" value="<?php echo $student['user_id']; ?>">
                            </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Prénom</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($student['firstname']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nom</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($student['lastname']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">CIN</label>
                                <input type="text" name="cin" class="form-control" value="<?php echo htmlspecialchars($student['cin']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Code Étudiant</label>
                                <input type="text" name="code_student" class="form-control" value="<?php echo htmlspecialchars($student['code_student']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Date de naissance</label>
                                <input type="date" name="dob" class="form-control" value="<?php echo htmlspecialchars($student['date_of_birth']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Filière</label>
                                <select name="filiere" class="form-select" required>
                                    <option value="Développement Digital" <?php if($student['filiere'] == 'Développement Digital') echo 'selected'; ?>>Développement Digital (DD)</option>
                                    <option value="Infrastructure Digitale" <?php if($student['filiere'] == 'Infrastructure Digitale') echo 'selected'; ?>>Infrastructure Digitale (ID)</option>
                                    <option value="Gestion des Entreprises" <?php if($student['filiere'] == 'Gestion des Entreprises') echo 'selected'; ?>>Gestion des Entreprises (GE)</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Mettre à jour le dossier</button>
                            <a href="index.php" class="btn btn-light">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>

        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>