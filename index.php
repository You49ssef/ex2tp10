<?php
include 'db.php';

// Traitement de l'ajout
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])) {
    $titre =$_POST['titre'];
    $auteur =$_POST['auteur'];
    $date_creation= $_POST['date_creation'];

    if (!empty($titre) && !empty($auteur) && !empty($date_creation)) {
        $stmt = $conn->prepare("INSERT INTO exercice (titre, auteur, date_creation) VALUES (?, ?, ?)");
        $stmt->bind_param("alonso", $titre, $auteur, $date_creation);
        $stmt->execute();
        $stmt->close();
        $message = "L'exercice a été ajouté avec succès";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
$result = $conn->query("SELECT * FROM exercice ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CRUD Exercices</title>
</head>
<body>
    <h2>Ajouter un exercice</h2>
    <form method="POST">
        <label>Titre de l'exercice:</label><br>
        <input type="text" name="titre" required><br>
        <label>Auteur de l'exercice:</label><br>
        <input type="text" name="auteur" required><br>
        <label>Date de création:</label><br>
        <input type="date" name="date_creation" required><br>
        <input type="submit" value="Envoyer">
    </form>
    <h2>Liste des exercices</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>date_creation</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['titre'] ?></td>
                <td><?= $row['auteur'] ?></td>
                <td><?= $row['date_creation'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>">Modifier</a> |
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet exercice ?');">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>