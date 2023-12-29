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

    <form action="EditEducateurController.php" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]?>" />
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($educateur->getEmail()); ?>"><br>

        <label for="est_administrateur">Administrateur</label>
        <select name="est_administrateur" id="est_administrateur">
            <option value="non" <?php if($educateur->getEstAdministrateur() == 0) echo 'selected'; ?>>Non</option>
            <option value="oui" <?php if($educateur->getEstAdministrateur() == 1) echo 'selected'; ?>>Oui</option>
        </select>
        <br><br>
        <label for="numero_licence">Licencié :</label>
        <select name="numero_licence" id="numero_licence">
            <?php
            // A ameliorer; la selecct doit etre de base sur le numero de licence venant de la base;
            foreach ($licence as $number) {
                echo "<option value='{$number->getNumeroLicence()}'>{$number->getNom()}</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="action" value="Ajouter">
    </form>
</body>
</html>