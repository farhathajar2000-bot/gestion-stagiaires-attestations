<?php
    include ('../helpers.php');
    
    requireLogin();
    requireAgent();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: index.php");
        exit();
    }
    
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare(" SELECT a.*, s.firstname, s.lastname, s.cin, s.code_student FROM attestations a JOIN students s ON a.student_id = s.id WHERE a.id = ?");
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
                <a href="index.php" class="btn btn-link text-decoration-none p-0 mb-2">← Retour à la liste</a>
                <h1 class="h3 mb-0 text-gray-800">✏️ Traiter la demande #<?php echo $attestation['id']; ?></h1>
            </div>

            <div class="d-flex justify-content-center">
                <div class="card shadow-sm border-0 w-100" style="max-width: 600px;">
                    <div class="card-body p-4">
                        
                        <div class="bg-light p-3 rounded mb-4 border">
                            <h6 class="text-muted fw-bold mb-3 text-uppercase" style="font-size: 0.8rem;">Détails de la demande</h6>
                            <div class="mb-2"><strong>Étudiant :</strong> <?php echo htmlspecialchars($attestation['firstname'] . ' ' . $attestation['lastname']); ?></div>
                            <div class="mb-2"><strong>CIN :</strong> <?php echo htmlspecialchars($attestation['cin']); ?></div>
                            <div><strong>Demandé le :</strong> <?php echo htmlspecialchars($attestation['created_at']); ?></div>
                        </div>

                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $attestation['id']; ?>">

                        <div class="mb-4"> 
                            <label class="form-label fw-bold text-primary">Statut de l'attestation</label>
                            <select name="statut" class="form-select border-primary form-select-lg">
                                <option value="attente" <?php if(is_null($attestation['validated_at'])) echo 'selected'; ?>>En attente</option>     
                                <option value="validee" <?php if(!is_null($attestation['validated_at'])) echo 'selected'; ?>>Validée</option>         
                            </select>
                        </div>

                        <hr>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Mettre à jour la demande</button>
                        </div>
                    </form>
                </div>
            </div>

        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>