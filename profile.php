<?php
    include ('helpers.php');
    requireLogin();
    requireEtudiant();
    include('partials/header.php');

    $pdo = Database::getConnection();
    $connectedUser = currentUser();
    $stmt = $pdo->prepare("SELECT * FROM students WHERE user_id = ?");
    $stmt->execute([$connectedUser['id']]);
    $user = $stmt->fetch();
    //dd($user);

    $atestations = $pdo->prepare("SELECT * FROM attestations WHERE student_id = ?");
    $atestations->execute([$user['id']]);
    $attestations = $atestations->fetchAll();
    
    include ('partials/activeOrNot.php');
?>

    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class=" col-md-3 col-xl-2 px-0"> 
                <?php include ('partials/sidebar.php'); ?>
            </div>
            <div class="col-md-9 col-xl-10 p-4">

                <div class="mb-5">
                    <div>
                        <h1 class="h2 mb-1">Mon Profil</h1>
                        <p class="text-muted">Consultez et gérez vos informations personnelles</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body pb-0">
                                <div class="text-center pb-4 border-bottom">
                                    <div class="mb-3">
                                        <div class="avatar-placeholder bg-primary bg-gradient rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                            <span class="text-white" style="font-size: 40px; font-weight: bold;">
                                                <?php echo strtoupper(substr(htmlspecialchars($user['firstname']), 0, 1)) . strtoupper(substr(htmlspecialchars($user['lastname']), 0, 1)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <h3 class="mb-2"><?php echo htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']); ?></h3>
                                    <p class="text-muted mb-0">Étudiant</p>
                                </div>
                            </div>
                            <!-- Info étudiant -->
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-muted text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Prénom</label>
                                            <p class="h6 mb-0"><?php echo htmlspecialchars($user['firstname']); ?></p>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-muted text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Code Étudiant</label>
                                            <p class="h6 mb-0"><span class="badge bg-info"><?php echo htmlspecialchars($user['code_student']); ?></span></p>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-muted text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">CIN</label>
                                            <p class="h6 mb-0"><?php echo htmlspecialchars($user['cin']); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-muted text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Nom</label>
                                            <p class="h6 mb-0"><?php echo htmlspecialchars($user['lastname']); ?></p>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-muted text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Date de Naissance</label>
                                            <p class="h6 mb-0">
                                                <?php echo htmlspecialchars($user['date_of_birth']); ?>
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-muted text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Filière</label>
                                            <p class="h6 mb-0"><span class="badge bg-success"><?php echo htmlspecialchars($user['filiere']); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- affichage des attestations -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm bg-surface">
                            <div class="card-body">
                                <h6 class="card-title fw-bold mb-3">📜 Mes Attestations</h6>
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Document</th>
                                                <th scope="col">Créé le</th>
                                                <th scope="col">Statut</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($attestations as $item) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo('Attestation de scolarité'); ?></td>
                                                <td><?php echo htmlspecialchars($item['created_at']); ?></td>
                                                <td><?php if(!empty($item['validated_at'])) { ?>
                                                    <span class="badge bg-success">Validée</span>
                                                <?php } else { ?>
                                                    <span class="badge bg-warning">En attente</span>
                                                <?php } ?></td>
                                                <td class="text-end">
                                                    <?php if (!is_null($item['validated_at'])) : ?>
                                                        <a href="attestations/print.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-success shadow-sm" target="_blank">
                                                            🖨️ Imprimer
                                                        </a>
                                                    <?php else : ?>
                                                        <span class="badge bg-warning">En attente</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('partials/footer.php'); ?>
