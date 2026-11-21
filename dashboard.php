<?php
    include ('helpers.php');
    include ('partials/header.php');
    requireLogin();
    requireAgent();
    $pdo = Database::getConnection();
    $query = $pdo->prepare("SELECT count(*) AS total FROM users");
    $query->execute();
    $users = $query->fetch();
    //dd(session_id());   

    $query = $pdo->prepare("SELECT count(*) AS total FROM students");
    $query->execute();
    $students = $query->fetch();

    $query = $pdo->prepare("SELECT * FROM attestations");
    $query->execute();
    $attestations = $query->fetchAll();
    include ('partials/activeOrNot.php');
    
?>


<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-3 col-xl-2 px-0 bg-surface border-end">
            <?php include ('partials/sidebar.php'); ?>
        </div>
        <div class="col-md-9 col-xl-10 p-4">
            <div class="mb-4">
                <div>
                    <h1 class="h3 mb-1">Dashboard</h1>
                    <p class="text-muted mb-0">Vue d'ensemble des utilisateurs, étudiants et attestations.</p>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 bg-primary text-white mb-3">
                        <div class="card-body text-center">
                            <p class="text-uppercase text-white mb-2">Users</p>
                            <h2 class="display-6 mb-0"><?= $users['total']; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 bg-info text-white mb-3">
                        <div class="card-body text-center">
                            <p class="text-uppercase text-white mb-2">Students</p>
                            <h2 class="display-6 mb-0"><?= $students['total']; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 bg-warning text-white mb-3">
                        <div class="card-body text-center">
                            <p class="text-uppercase text-white mb-2">Attestations</p>
                            <h2 class="display-6 mb-0"><?= count($attestations); ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>N°</th>
                            <th>Date de création</th>
                            <th>État</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($attestations as $item) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $item['created_at']; ?></td>
                                <td><?php if(!empty($item['validated_at'])) { ?>
                                        <span class="badge bg-success">Validée</span>
                                    <?php } else { ?>
                                        <span class="badge bg-warning">En attente</span>
                                    <?php } ?> 
                                </td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include ('partials/footer.php'); ?>

