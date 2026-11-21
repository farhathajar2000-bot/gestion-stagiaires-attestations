<?php
    include('../partials/header.php');
    include('../helpers.php');
    requireLogin();
    requireAgent();
    $pdo = Database::getConnection();
    $query = $pdo->prepare("SELECT id, firstname, lastname FROM students");
    $query->execute();
    $students = $query->fetchAll();
    $path = '../'; 
    $page_active = 'students';
    include('../partials/activeOrNot.php');
    // dd($_SERVER['PHP_SELF']);
    // dd($students);
?>
 
<div class="container-fluid">
    <div class="row min-vh-100">

        <div class="col-md-3 col-xl-2 px-0 bg-white border-end">
            <?php include ('../partials/sidebar.php'); ?>
        </div>

        <div class="col-md-9 col-xl-10 p-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">👥 Gestion des Étudiants</h1>
                    <p class="text-muted small">Liste des étudiants</p>
                </div>
                <a href="create.php" class="btn btn-primary shadow-sm">+ Nouvel Étudiant</a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>id étudiant</th>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $s) : ?>
                                <tr>
                                    <td><span class="badge bg-secondary">#<?php echo htmlspecialchars($s['id']); ?></span></td>
                                    <td class="fw-bold"><?php echo htmlspecialchars($s['firstname']); ?></td>
                                    <td><?php echo htmlspecialchars($s['lastname']); ?></td>
                                    <td class="text-end">
                                        <a href="show.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-info">👁️ Afficher</a>
                                        <a href="edit.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-primary">✏️ Modifier</a>
                                        <a href="delete.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">🗑️ Supprimer</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>  
