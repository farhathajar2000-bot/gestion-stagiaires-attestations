<?php
    include('config.php');
    $users = [
        ["username"=> "agent", "email" => "agent@ofppt.ma", "password" => password_hash("123456", PASSWORD_DEFAULT), "role"=>"agent"],
        ["username"=> "etudiant1", "email" => "etudiant1@ofppt.ma", "password" => password_hash("123456", PASSWORD_DEFAULT), "role"=>"etudiant"],
        ["username"=> "etudiant2", "email" => "etudiant2@ofppt.ma", "password" => password_hash("123456", PASSWORD_DEFAULT), "role"=>"etudiant"],
    ];
    foreach($users as $user){
        $stmt = $pdo -> prepare("INSERT INTO users(username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt -> execute($user);
    }
?>