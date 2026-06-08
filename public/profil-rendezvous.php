<?php
// Sécuriser l'Id
if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: ./liste-rendezvous.php?error=bad-method");
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_GET["id"])) {
    header("Location: ./liste-rendezvous.php?error=missing-value");
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty($_GET["id"])) {
    header("Location: ./liste-rendezvous.php?error=value-empty");
    exit();
}

$id = htmlspecialchars(strip_tags(trim($_GET["id"])));

if ($id <= 0) {
    header('Location: ./liste-rendezvous.php?');
    exit();
}

// $success = isset($_GET['success']) ? $_GET['success'] : null;

// Requête SQL
require_once '../utils/db_connect.php';

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
    header('Location: ./liste-rendezvous.php');
    exit();
}

?>

<?php require_once "../_partials/_header.php" ?>

<div class="flex flex-col gap-8 items-start">

    <h1 class="text1-ysabeau ">Détails d'un rendez-vous</h1>

    <p><strong>Nom : </strong><?= $appointment['lastname'] ?></p>
    <p><strong>Prenom : </strong><?= $appointment['firstname'] ?></p>
    <p><strong>Date & Heure : </strong><?= $appointment['appointment_datetime'] ?></p>
</div>
<button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
    <a href="./modifier-rendezvous.php?id=<?= $appointment['id'] ?>">Modifier</a>
</button>
<button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
    <a href="./liste-rendezvous.php"><- Liste des rendez-vous</a>
</button>

<?php require_once "../_partials/_footer.php" ?>