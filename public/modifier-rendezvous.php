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

$success = isset($_GET['success']) ? $_GET['success'] : null;

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

<form action="../process/maj-rendezvous.php" method="POST" class="flex flex-col gap-8">
        <input type="hidden" name="id" value="<?= $appointment['id'] ?>">

    <div>

        <label for="patient_id" class="font-bold">Patient :</label>
        <input type="text" id="patient_id" name="patient_id" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl" value="<?= $appointment['lastname']. ' ' . $appointment['firstname']?>">
    </div>


    <div class="flex flex-col gap-4">

        <label for="appointment_datetime" class="font-bold">Date & Heure :</label>

        <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" class="border-solid border rounded" value="<?= $appointment['appointment_datetime'] ?>" required>
    </div>

    <button type="submit" class="rounded-xl bg-bleue-bouton px-16 text-2xl">Enregistrer</button>
</form>

<?php require_once "../_partials/_footer.php" ?>