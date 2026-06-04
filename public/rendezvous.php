<?php
require_once '../utils/db_connect.php';
// Récup l'id du rendez-vous
$id = $_GET['id'];

// Sécuriser l'Id
if (!isset($_GET['id'])) {
    header('Location: ./liste-rendezvous.php');
    exit();
}

$id = (int) $_GET['id'];

if ($id <= 0) {
    header('Location: ./liste-rendezvous.php');
    exit();
}

$success = isset($_GET['success']) ? $_GET['success'] : null;

// Requête SQL
$request = $db->prepare("SELECT
    appointments.id,
    appointments.appointment_datetime,
    patients.lastname,
    patients.firstname
   
FROM appointments

INNER JOIN patients
    ON appointments.patient_id = patients.id

WHERE appointments.id = :id");

$request->execute([
    'id' => $id
    ]);
$appointment = $request->fetch(PDO::FETCH_ASSOC);

// Vérifier que le rdv existe
if (!$appointment) {
    header('Location: ./rendezvous.php');
    exit();
}

?>

<?php require_once "../_partials/_header.php" ?>

<div class="flex flex-col gap-8 items-start">

    <?php if ($success) { ?>
        <div class="w-full bg-green-400/50 border-green-400">
            <p>Le rendez-vous est bien pris</p>
        </div>
    <?php } ?>

    <h1 class="text1-ysabeau ">Détails d'un rendez-vous</h1>

    <p><strong>Nom : </strong><?= $appointment['lastname'] ?></p>
    <p><strong>Prenom : </strong><?= $appointment['firstname'] ?></p>
    <p><strong>Date & Heure : </strong><?= $appointment['appointment_datetime'] ?></p>
</div>
<button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
    <a href="./modifier-rendezvous.php?id=<?= $appointment['id'] ?>">Modifier</a>
</button>



<?php require_once "../_partials/_footer.php" ?>