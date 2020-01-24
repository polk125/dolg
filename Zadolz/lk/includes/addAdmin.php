<?php
                if (!isset($_COOKIE['user'])) {
                    header('Location: ../../auth.php');
                } 
            
                
            

            print_r($_POST);
            $conn = new PDO(
                "mysql:host=localhost;dbname=zadolz;charset=utf8",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
                $login = $_POST['login'];
                $password = md5($_POST['password']);
                $role=$_POST['role'];
                $name=$_POST['name'];
                $surname=$_POST['surname'];
                $patronomic=$_POST['patronomic']; 
                $result = $conn->prepare("INSERT INTO users( login, password, role, name, surname, patronymic) VALUES (?, ?, ?, ?, ?, ?)");
                $result->execute([$login, $password, $role, $name, $surname, $patronomic]); 
                
                header('Location: ../index.php');
?>