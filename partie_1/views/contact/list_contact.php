<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Contacts</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<h1>Liste des Contacts</h1>
<a href="AddContactController.php">Ajouter un contact</a>

<?php if (count($contacts) > 0): ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Numéro de téléphone</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo $contact->getIdContact(); ?></td>
                <td><?php echo $contact->getNom(); ?></td>
                <td><?php echo $contact->getPrenom(); ?></td>
                <td><?php echo $contact->getEmail(); ?></td>
                <td><?php echo $contact->getNumeroTel(); ?></td>
                <td>
                    <a href="ViewContactController.php?id=<?php echo $contact->getIdContact(); ?>">Voir</a>
                    <a href="EditContactController.php?id=<?php echo $contact->getIdContact(); ?>">Modifier</a>
                    <a href="DeleteContactController.php?id=<?php echo $contact->getIdContact(); ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun contacts trouvé.</p>
<?php endif; ?>
</body>
</html>
