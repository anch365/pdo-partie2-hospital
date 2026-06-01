<?php
require_once '../utils/db_connect.php';
$id = $_GET['id'];

$request = $db->prepare("SELECT * FROM patients WHERE id = ?");

$request->execute([$id]);
$patient = $request->fetch();
?>

<?php require_once "../_partials/_header.php" ?>

<div class="flex flex-col gap-8 items-center">
    <?php   ?>
    <h1>Le profil du patient</h1>
    <p><strong>Nom :</strong><?= $patient['lastname'] ?></p>
    <p><strong>Prénom :</strong><?= $patient['firstname'] ?></p>
    <p><strong>Date de naissance :</strong><?= $patient['birthdate'] ?></p>
    <p><strong>N° Téléphone :</strong><?= $patient['phone'] ?></p>
    <p><strong>Email :</strong><?= $patient['mail'] ?></p>
</div>

<?php require_once "../_partials/_footer.php" ?>