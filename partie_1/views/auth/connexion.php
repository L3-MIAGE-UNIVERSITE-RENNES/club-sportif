<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Se connecter</title>
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
<h1>WELCOME</h1>

<form action="../../controllers/auth/ConnexionController.php" method="post">
    <label for="mot_de_passe">Mot de passe :</label>
    <input type="text" id="mot_de_passe" name="mot_de_passe" required><br>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email"><br>
    <input type="submit" name="action" value="Ajouter">
</form>
</body>
</html>