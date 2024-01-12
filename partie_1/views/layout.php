<?php const BASE_URL = "http://localhost:8888/club-sportif/partie_1"?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Contacts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/controllers/licencie/ListLicencieController.php">Licencié</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/controllers/categorie/ListCategorieController.php">Categorie</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/controllers/educateur/ListEducateurController.php">Educateur</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/controllers/contact/ListContactController.php">Contact</a></li>
        </ul>
        <div class="navbar-brand"><a class="nav-link" href="<?= BASE_URL ?>/controllers/auth/logout.php">Se déconnecter</a></div>
    </div>
</div>

<?= $content ?>

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Your own JavaScript goes here -->
</body>
</html>
