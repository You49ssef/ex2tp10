<?php include 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date_creation = $_POST['date_creation'];

    $stmt = $conn->prepare("UPDATE exercice SET titre=?, auteur=?, date_creation=? WHERE id=?");
    $stmt->bind_param("sssi", $titre, $auteur, $date_creation, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

$res = $conn->query("SELECT * FROM exercice WHERE id=$id");
$data = $res->fetch_assoc();
?>

<form method="POST">
    <input type="text" name="titre" value="<?= $data['titre'] ?>" required>
    <input type="text" name="auteur" value="<?= $data['auteur'] ?>" required>
    <input type="date" name="date_creation" value="<?= $data['date_creation'] ?>" required>
    <input type="submit" value="Modifier">
</form>