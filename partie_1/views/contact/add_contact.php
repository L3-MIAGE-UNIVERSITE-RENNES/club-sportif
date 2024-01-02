<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Contact</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
<h1>Ajouter un Educateur</h1>
<a href="ListContactController.php">Retour à la liste des educateurs</a>

    <form action="AddContactController.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="nom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" required><br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email"><br>
        <label for="numero_tel">Telephone :</label>
        <input type="numero_tel" id="numero_tel" name="numero_tel"><br>
        <input type="submit" name="action" value="Ajouter">
    </form>
</body>
</html>