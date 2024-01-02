<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails contact</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<h1>Détails contact</h1>
<a href="ListContactController.php">Retour à la liste des contacts</a>

<?php if ($contact): ?>
    <p><strong>Nom :</strong> <?php echo $contact->getNom(); ?></p>
    <p><strong>Prenom :</strong> <?php echo $contact->getPrenom(); ?></p>
    <p><strong>Email :</strong> <?php echo $contact->getEmail(); ?></p>
    <p><strong>Numero telephone :</strong> <?php echo $contact->getNumeroTel() ?></p>
<?php else: ?>
    <p>Le contact n'a pas été trouvé.</p>
<?php endif; ?>
</body>
</html>
