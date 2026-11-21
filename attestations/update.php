<?php
include ('../helpers.php');

requireLogin();
requireAgent();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'] ?? '';
    $statut = $_POST['statut'] ?? '';

    if (empty($id) || empty($statut)) {
        header("Location: index.php");
        exit(); 
    }

    $activeUser = currentUser();
    $agent_id = $activeUser['id'];

    $validated_at = ($statut === 'validee') ? date('Y-m-d H:i:s') : null;

    try {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE attestations SET agent_id = ?, validated_at = ? WHERE id = ?");
        $stmt->execute([$agent_id, $validated_at, $id]);

        header("Location: index.php?");
        exit();

    } catch(PDOException $e) {
        die("Erreur de modification : " . $e->getMessage());
    }

} else {
    header("Location: index.php");
    exit();
}
?>