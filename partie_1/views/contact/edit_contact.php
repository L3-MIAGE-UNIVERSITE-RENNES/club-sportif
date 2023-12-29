<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un educateur</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
<h1>Modifier un Educateur</h1>
<a href="ListEducateurController.php">Retour à la liste des educateurs</a>
    <form action="EditContactController.php" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]?>" />
        <label for="nom">Email :</label>
        <input type="nom" id="nom" name="nom" value="<?php echo htmlspecialchars($contact->getNom()); ?>"><br>

        <label for="prenom">Email :</label>
        <input type="prenom" id="prenom" name="prenom" value="<?php echo htmlspecialchars($contact->getPrenom()); ?>"><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contact->getEmail()); ?>"><br>

        <label for="numero_tel">Email :</label>
        <input type="numero_tel" id="numero_tel" name="numero_tel" value="<?php echo htmlspecialchars($contact->getNumeroTel()); ?>"><br>

        <input type="submit" name="action" value="Modifier">
    </form>
</body>
</html>