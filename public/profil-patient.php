<?php
require_once '../utils/db_connect.php';

$id = $_GET['id'];

$success = isset($_GET['success']) ? $_GET['success'] : null;

$request = $db->prepare("SELECT * FROM patients WHERE id = ?");

$request->execute([$id]);
$patient = $request->fetch(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php" ?>

<div class="flex flex-col gap-8 items-start">

<?php if ($success) { ?>
    <div class="w-full bg-green-400/50 border-green-400">
        <p>Le profil a bien été modifié</p>
    </div>
<?php } ?>

    <h1 class="text-ysabeau ">Le profil du patient</h1>

    <p><strong>Nom : </strong><?= $patient['lastname'] ?></p>
    <p><strong>Prénom : </strong><?= $patient['firstname'] ?></p>
    <p><strong>Date de naissance : </strong><?= $patient['birthdate'] ?></p>
    <p><strong>N° Téléphone : </strong><?= $patient['phone'] ?></p>
    <p><strong>Email : </strong><?= $patient['mail'] ?></p>
    <button class="border-2 rounded-full bg-bleue-bouton" type="submit">
        <a href="./modifier-patient.php?id=<?= $patient['id'] ?>">Modifier</a>
    </button>

</div>

<?php require_once "../_partials/_footer.php" ?>