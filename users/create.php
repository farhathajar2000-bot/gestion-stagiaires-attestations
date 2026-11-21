<?php
    include ('../helpers.php');

    requireLogin();
    requireAgent(); 

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
                <h1 class="h3 mb-0 text-gray-800">✨ Ajouter un utilisateur</h1>
            </div>

            <div class="d-flex justify-content-center">
                <div class="card shadow-sm border-0 bg-surface w-100" style="max-width: 600px;">
                    <div class="card-body p-4">
                        <form action="store.php" method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Adresse Email</label>
                            <input type="email" name="email" class="form-control" placeholder="test@example.com" required>
                            <?php if (isset($_GET['error']) && $_GET['error'] == '2 ') : ?>
                                <div class="text-danger mt-1" style="font-size: 0.85rem; font-weight: 500;">
                                    Email déjà utilisée.
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Rôle de l'utilisateur</label>
                            <select name="role" class="form-select" required>
                                <option value="" selected disabled>Choisir un rôle...</option>
                                <option value="etudiant">🎓 Étudiant</option>
                                <option value="agent">💼 Agent Administratif</option>
                            </select>
                        </div>

                        <hr>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Enregistrer l'utilisateur</button>
                        </div>

                    </form>
                </div>
            </div>

        </div> 
    </div>
</div>

<?php include('../partials/footer.php'); ?>