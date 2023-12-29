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
<a href="HomeController.php">Retour à la liste des contacts</a>

    <form action="AddEducateurController.php" method="post">
        <label for="numero_licence">Nom :</label>
        <input type="text" id="numero_licence" name="numero_licence" required><br>

        <label for="mot_de_passe">Prénom :</label>
        <input type="text" id="mot_de_passe" name="mot_de_passe" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email"><br>

        <label for="est_administrateur">Téléphone :</label>
        <input type="text" id="est_administrateur" name="est_administrateur"><br>

        <input type="submit" name="action" value="Ajouter">
    </form>

<?php
// Inclure ici la logique pour traiter le formulaire d'ajout de contact
?>

</body>
</html>