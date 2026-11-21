<?php

include ('../helpers.php');

requireLogin();
requireAgent();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $student_id = $_POST['student_id'] ?? '';

    $activeUser = currentUser();
    $agent_id = $activeUser['id'];

    if (empty($student_id)) {
        header("Location: create.php?error=missing_data");
        exit();
    } 

    $validated_at = isset($_POST['check']) ? date('Y-m-d H:i:s') : null;

    try {   
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO attestations (student_id, agent_id, validated_at) VALUES (?, ?, ?)");
        $stmt->execute([$student_id, $agent_id, $validated_at]);

        header("Location: index.php");
        exit();

    } catch(PDOException $e) {
        die("Erreur lors de l'enregistrement de l'attestation : " . $e->getMessage());
    }

} else {
    header("Location: index.php");
    exit();
}
?>