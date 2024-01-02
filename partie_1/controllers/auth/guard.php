<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../views/auth/connexion.php');
        exit;
    }
