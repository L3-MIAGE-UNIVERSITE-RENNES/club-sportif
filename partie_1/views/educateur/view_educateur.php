<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails educateur</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<h1>Détails educateur</h1>
<a href="HomeController.php">Retour à la liste des educateurs</a>

<?php if ($educateur): ?>
    <p><strong>Numero de licence :</strong> <?php echo $licencie->getNom(); ?></p>
    <p><strong>Email :</strong> <?php echo $educateur->getEmail(); ?></p>
    <p><strong>Administrateur :</strong> <?php echo $educateur->getEstAdministrateur() == 1 ? "oui" : "non"; ?></p>
<?php else: ?>
    <p>L'educateur n'a pas été trouvé.</p>
<?php endif; ?>
</body>
</html>
