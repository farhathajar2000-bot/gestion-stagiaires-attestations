<?php

    include ('../helpers.php');
    
    requireLogin();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("Document introuvable.");
    }

    $id_attestation = $_GET['id'];
    $activeUser = currentUser();
    
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare(" SELECT a.*, s.firstname, s.lastname, s.cin, s.code_student, s.date_of_birth, s.filiere FROM attestations a JOIN students s ON a.student_id = s.id WHERE a.id = ? AND s.user_id = ? AND a.validated_at IS NOT NULL");
    $stmt->execute([$id_attestation, $activeUser['id']]);
    $document = $stmt->fetch();
    // dd($document);

    if (!$document) {
        die("Accès refusé ou document non validé.");
    }
    include('../partials/header.php');
?>
    <div class="container border border-2 border-dark p-3" style="max-width: 800px;">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-0">Office de la Formation Professionnelle <br> et de la promotion du travail</h5>
                <strong>ISTA Lazaret</strong>
            </div>
            <div class="text-end">
                <p class="mb-0">Fait à Oujda, le <?php echo htmlspecialchars($document['validated_at']); ?></p>
            </div>
        </div>

        <h3 class="text-center text-uppercase fw-bold text-decoration-underline mb-3">
            Attestation de Scolarité
        </h3>

        <div class="fs-6 lh-base mb-3" style="text-align: justify;">
            <p>Le Directeur de l'Institut Spécialisé de Technologie Appliquée Lazaret atteste par la présente que :</p>
            
            <p class="ms-4">
                L'étudiant(e) : <strong><?php echo htmlspecialchars(strtoupper($document['lastname']) . ' ' . ucfirst($document['firstname'])); ?></strong><br>
                Né(e) le : <strong><?php echo htmlspecialchars($document['date_of_birth']); ?></strong><br>
                Titulaire de la CIN N° : <strong><?php echo htmlspecialchars($document['cin']); ?></strong><br>
                Inscrit(e) sous le numéro : <strong><?php echo htmlspecialchars($document['code_student']); ?></strong>
            </p>

            <p>Poursuit ses études au sein de notre établissement pour l'année de formation en cours, dans la filière :</p>
            <p class="text-center fw-bold fs-5 mt-2 mb-2"><?php echo htmlspecialchars($document['filiere']); ?></p>
            
            <p>Cette attestation est délivrée à l'intéressé(e) pour servir et valoir ce que de droit.</p>
        </div>

        <div class="row">
            <div class="col-6"></div>
            <div class="col-6 text-center">
                <p><strong>Le Directeur de l'établissement</strong></p>
                <br>
                <br>
                <br>
            </div>
        </div>
        
        <div class="mt-3 pt-2 border-top text-center text-muted small">
            Document généré électroniquement le <?php echo htmlspecialchars(date('d/m/Y à H:i')); ?>
        </div>

    </div>
    <style>
        body { background-color: #fff; color: #000; padding: 40px; font-family: 'Times New Roman', serif; }
        .logo-placeholder { width: 100px; height: 100px; background-color: #eee; text-align: center; line-height: 100px; font-weight: bold; margin-bottom: 20px; }
        @media print {
            body { padding: 0; }
            .container { max-width: none !important; width: 100% !important; }
            .no-print { display: none !important; } 
            @page { size: A4; margin: 1cm; }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>

<?php include('../partials/footer.php'); ?>