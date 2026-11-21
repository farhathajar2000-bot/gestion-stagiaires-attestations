<?php 
    include ('helpers.php');
    include("partials/header.php");

    if (isLoggedIn()) {

        if (isAgent()) {
            header('Location: dashboard.php');
            exit(); 
        } 

        elseif (isEtudiant()) {
            header('Location: profile.php');
            exit();
        }
    }
    
?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
        <div class="card shadow-sm border-1">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h2 class="h4 mb-1">Connectez-vous</h2>
                    <p class="text-muted mb-0">Accédez à votre espace sécurisé.</p>
                </div>

                <form action="login.php" method="POST" class="needs-validation">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div> 
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <?php if (isset($_GET['error']) && $_GET['error'] == 1) : ?>
                        <div class="text-danger mt-2 mb-3" style="font-size: 0.9rem; font-weight: 500;">
                            <span>email ou mot de passe incorrect</span>
                        </div> 
                    <?php endif; ?>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg text-uppercase fw-bold">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("partials/footer.php")?>