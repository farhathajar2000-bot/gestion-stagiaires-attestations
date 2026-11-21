<?php
    include ('../helpers.php');
    
    requireLogin();
    requireAgent(); 
    
    $pdo = Database::getConnection();
    $stmt = $pdo->query(" SELECT a.*, s.firstname, s.lastname FROM attestations a JOIN students s ON a.student_id = s.id");
    $attestations_list = $stmt->fetchAll();

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
            
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h1 class="h3 mb-0 text-gray-800">📋 Gestion des Attestations</h1>
                    <p class="text-muted small">Traitez les demandes de documents des étudiants de l'ISTA</p>
                </div>
                
                <a href="create.php" class="btn btn-primary shadow-sm">➕ Nouvelle demande</a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Document demandé</th>
                                    <th>Date de demande</th>
                                    <th>Statut</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attestations_list as $att) : ?>
                                <tr>
                                    <td class="fw-bold text-dark">
                                        <?php echo htmlspecialchars($att['firstname'] . ' ' . $att['lastname']); ?>
                                    </td>
                                    
                                    <td><?php echo "Attestation de scolarité"; ?></td>
                                    
                                    <td><?php echo htmlspecialchars($att['created_at']); ?></td>
                                    
                                    <td><?php if(!empty($att['validated_at'])) { ?>
                                        <span class="badge bg-success">Validée</span>
                                    <?php } else { ?>
                                        <span class="badge bg-warning">En attente</span>
                                    <?php } ?></td>
                                    
                                    <td class="text-end">
                                        <a href="show.php?id=<?php echo $att['id']; ?>" class="btn btn-sm btn-outline-info">👁️ Afficher</a>
                                        <a href="edit.php?id=<?php echo $att['id']; ?>" class="btn btn-sm btn-outline-primary">✏️ Modifier</a>
                                        <a href="delete.php?id=<?php echo $att['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">🗑️ Supprimer</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                <?php if (empty($attestations_list)) : ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Aucune demande d'attestation pour le moment.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>