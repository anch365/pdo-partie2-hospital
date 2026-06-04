<?php
// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/ajout-rendezvous.php?error=bad-method");
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["patient_id"]) || !isset($_POST["appointment_datetime"])) {
    header("Location: ../public/ajout-rendezvous.php?error=missing-value");
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if ((empty($_POST["patient_id"]) || empty($_POST["appointment_datetime"]))) {
    header("Location: ../public/ajout-rendezvous.php?error=value-empty");
    exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
// $appointmentId = trim($_POST["appointment_id"]);
$patientId = trim($_POST["patient_id"]);

// LA SECURITE POUR LES DATES
$appointmentDateTime = trim($_POST["appointment_datetime"]);

$dateTime = DateTime::createFromFormat(
    'Y-m-d\TH:i',
    $appointmentDateTime
);

if (
    !$dateTime ||
    $dateTime->format('Y-m-d\TH:i') !== $appointmentDateTime
) {
    exit('Date invalide');
}

$now = new DateTime();

if ($dateTime < $now) {
    exit('Impossible de prendre un rendez-vous dans le passé');
}

require_once "../utils/db_connect.php";

$request = $db->prepare("SELECT id
FROM appointments
WHERE appointment_datetime = :appointment_datetime
");

$request->execute([
    'appointment_datetime' => $appointmentDateTime
]);

if ($request->fetch()) {
    exit('Créneau déjà réservé');
}

// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD (PDO traduit php pour pouvoir communiquer avec la BDD)
require_once "../utils/db_connect.php";

// Vérifier que le patient existe
// $request = $db->prepare("SELECT id FROM patients WHERE id = :id");

// $request->execute([
//     'id' => $patientId
// ]);

// $patient = $request->fetch();

// if (!$patient) {
//     header('Location: ../process/ajout-rendezvous.php?error=bad-method');
// }

// La requête entière est du PDO :
// prepare() sert à préparer une requête SQL
// execute() sert à exécuter la requête préparée
// Entre parenthèse c'est du SQL
// INSERTION PDO

$request = $db->prepare("INSERT INTO appointments
(patient_id, appointment_datetime)
VALUES(:patient_id, :appointment_datetime)");

// var_dump($request);
// die();

$request->execute([
    'patient_id' => $patientId,
    'appointment_datetime' => $appointmentDateTime
]);

// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ../public/liste-rendezvous.php");
exit();

?>
