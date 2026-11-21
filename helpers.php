<?php
    include('config.php');
    function isLoggedIn() {return isset($_SESSION['user']); } //connecter ou non 

    function currentUser() { return $_SESSION['user'] ?? null; } //user actuelle si non null

    function isAgent() { return isLoggedIn() && currentUser()['role'] ==='agent'; } // connecte et agent 

    function isEtudiant() { return isLoggedIn() && currentUser()['role'] ==='etudiant'; } //connecte et etudiant

    function requireLogin() {
        if (!isLoggedIn()) { header('Location: index.php'); exit; }
    }

    function requireAgent() {
        if (!isAgent()) { header('Location: acces_denied.php');exit; }
    }

    function requireEtudiant() {
        if (!isEtudiant()) { header('Location: acces_denied.php');exit; }
    }

    function dd($value){
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
            die();
        }