<?php $currentpage = basename($_SERVER['PHP_SELF']); 
    include('header.php');
?>

<div class="sidebar-container bg-dark min-vh-100 p-4 border-end border-secondary d-flex flex-column" style="box-shadow: 0 0 12px rgba(0,0,0,0.15);">

<div class="mb-4 pb-3 border-bottom border-secondary">
        <h5 class="fw-bold text-white mb-1">
            <span style="font-size: 1.5rem;">📚</span> Menu Principal
        </h5>
    </div>

    <nav class="nav flex-column gap-2">

        <?php if (isAgent()) : ?>
        <a class="nav-link px-3 py-2 rounded-3 text-white transition <?php if ($currentpage === 'dashboard.php') { echo 'active'; } else { echo 'notactive'; } ?>" href="<?php echo isset($path) ? $path : ''; ?>dashboard.php">
            <span style="font-size: 1.2rem; margin-right: 8px;">📊</span>
            <span class="fw-500">Dashboard</span>
        </a>
        <a class="nav-link px-3 py-2 rounded-3 text-white transition <?php if(isset($page_active) && $page_active === 'users') { echo 'active'; } else { echo 'notactive'; } ?>" href="<?php echo isset($path) ? $path : ''; ?>users/index.php">
            <span style="font-size: 1.2rem; margin-right: 8px;">👥</span>
            <span class="fw-500">Utilisateurs</span>
        </a>
        <a class="nav-link px-3 py-2 rounded-3 text-white transition <?php if(isset($page_active) && $page_active === 'students') { echo 'active'; } else { echo 'notactive'; } ?>" href="<?php echo isset($path) ? $path : ''; ?>students/index.php">
            <span style="font-size: 1.2rem; margin-right: 8px;">🎓</span>
            <span class="fw-500">Étudiants</span>
        </a>
        <a class="nav-link px-3 py-2 rounded-3 text-white transition <?php if(isset($page_active) && $page_active === 'attestations') { echo 'active'; } else { echo 'notactive'; } ?>" href="<?php echo isset($path) ? $path : ''; ?>attestations/index.php">
            <span style="font-size: 1.2rem; margin-right: 8px;">📜</span>
            <span class="fw-500">Attestations</span>
        </a>
        <?php endif; ?>
        
        <?php if (isEtudiant()) : ?>
            <a class="nav-link px-3 py-2 rounded-3 text-white transition <?php if ($currentpage === 'profile.php') { echo 'active'; } else { echo 'notactive'; } ?>" href="<?php echo isset($path) ? $path : ''; ?>profile.php">
                <span style="font-size: 1.2rem; margin-right: 8px;">👤</span>
                <span class="fw-500">Profil</span>
            </a>
            <?php endif; ?>
        </nav>

    <div class="mt-auto">
        <a href="<?php echo isset($path) ? $path : ''; ?>logout.php" class="btn btn-outline-light btn-sm w-100">
            <span>🚪 Déconnexion </span> 
        </a>
    </div>
</div>

