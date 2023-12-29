<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Educateurs</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<h1>Liste des Educateurs</h1>
<a href="AddEducateurController.php">Ajouter un educateur</a>

<?php if (count($educateurs) > 0): ?>
    <table>
        <thead>
        <tr>
            <th>Numero de licence</th>
            <th>Email</th>
            <th>Administrateur</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($educateurs as $educateur): ?>
            <tr>
                <td><?php echo $educateur->getNumeroLicence(); ?></td>
                <td><?php echo $educateur->getEmail(); ?></td>
                <td><?php echo $educateur->getEstAdministrateur(); ?></td>
                <td>
                    <a href="ViewContactController.php?id=<?php echo $educateur->getIdEducateur(); ?>">Voir</a>
                    <a href="EditContactController.php?id=<?php echo $educateur->getIdEducateur(); ?>">Modifier</a>
                    <a href="DeleteContactController.php?id=<?php echo $educateur->getIdEducateur(); ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun educateurs trouvé.</p>
<?php endif; ?>
</body>
</html>
