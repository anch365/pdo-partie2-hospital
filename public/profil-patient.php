<?php
require_once '../utils/db_connect.php';

$id = $_GET['id'];

$success = isset($_GET['success']) ? $_GET['success'] : null;

$request = $db->prepare("SELECT * FROM patients WHERE id = ?");

$request->execute([$id]);
$patient = $request->fetch(PDO::FETCH_ASSOC);

$request = $db->prepare("SELECT *
FROM appointments
WHERE patient_id = :patient_id
ORDER BY appointment_datetime
");

$request->execute([
    ':patient_id' => $id
]);

$appointments = $request->fetchAll(PDO::FETCH_ASSOC);
?>


<?php require_once "../_partials/_header.php" ?>
<div class="flex flex-col gap-8 items-start">

    <?php if ($success) { ?>
        <div class="w-full bg-green-400/50 border-green-400">
            <p>Le rendez-vous a bien été modifier</p>
        </div>
    <?php } ?>

    <h1 class="text1-ysabeau">Le profil du patient</h1>
    <p><strong>Nom : </strong><?= $patient['lastname'] ?></p>
    <p><strong>Prénom : </strong><?= $patient['firstname'] ?></p>
    <p><strong>Date de naissance : </strong><?= $patient['birthdate'] ?></p>
    <p><strong>N° Téléphone : </strong><?= $patient['phone'] ?></p>
    <p><strong>Email : </strong><?= $patient['mail'] ?></p>
</div>

<button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
    <a href="./modifier-patient.php?id=<?= $patient['id'] ?>">Modifier</a>
</button>

<h2 class="text1-ysabeau">Les rendez-vous du patient</h2>

<?php if (empty($appointments)) { ?>

    <p>Aucun rendez-vous enregistré.</p>

<?php } else ?>
<ul>
    <?php foreach ($appointments as $appointment) { ?>
        <li>
            <h3 class="text-xl font-bold">Date & Heure :</h3>
            <?= $appointment['appointment_datetime'] ?>
        </li>
    <?php } ?>
</ul>
<button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
    <a href="./liste-patient.php">
        <i class="fa-solid fa-arrow-left"></i>
        Retour
    </a>
</button>

<?php require_once "../_partials/_footer.php" ?>