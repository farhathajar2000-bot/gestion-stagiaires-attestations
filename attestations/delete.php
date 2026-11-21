<?php
include ('../helpers.php');

requireLogin();
requireAgent();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    try {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM attestations WHERE id = ?");
        $stmt->execute([$_GET['id']]);

        header("Location: index.php");
        exit();

    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }

} else {
    header("Location: index.php");
    exit();
}
?>