<?php
    include ('helpers.php');
    
        if($_SERVER['REQUEST_METHOD']=='POST'){

            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }
            if(isset($_POST['password'])){
                $pass = $_POST['password'];
            }
            try{
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare ("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();
                 
                if($user && password_verify($pass, $user['password'])) {
                    
                        $_SESSION['user'] = $user;  
                        
                            if($user['role'] == 'agent'){
                                header("Location:dashboard.php");
                                exit();
                            }elseif ($user['role'] == 'etudiant'){
                                header("Location:profile.php");
                                exit();
                            }
                    
                }else{
                    header("Location: index.php?error=1");
                    exit();
                }
            }catch(PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
                }
        }
        else{
            header("Location: index.php");
            exit();
            }

?>