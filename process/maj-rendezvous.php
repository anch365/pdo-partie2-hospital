<?php
// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/profil-rendezvous.php?error=bad-method");
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["id"]) || !isset($_POST["patient_id"]) || !isset($_POST["appointment_datetime"])) {
    header("Location: ../public/profil-rendezvous.php?error=missing-value");
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty($_POST["id"]) || empty($_POST["patient_id"]) || empty($_POST["appointment_datetime"])) {
    header("Location: ../public/profil-rendezvous.php?error=value-empty");
    exit();
}

// POUR LA SECURITE DES DATES
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
    exit('IMPOSSIBLE DE PRENDRE UN RENDEZ-VOUS DANS LE PASSE');
}

require_once "../utils/db_connect.php";

$request = $db->prepare("SELECT id
FROM appointments
WHERE appointment_datetime = :appointment_datetime
");

$request->execute([
    ':appointment_datetime' => $appointmentDateTime
]);

if ($request->fetch()) {
    exit('CRENEAU DEJA RESERVE');
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
// $appointmentId = trim($_POST["appointment_id"]);
$id = htmlspecialchars(strip_tags(trim($_POST["id"])));
$patientId = (int) $_POST["patient_id"];

// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD (PDO traduit php pour pouvoir communiquer avec la BDD)
require_once "../utils/db_connect.php";

// La requête entière est du PDO :
// prepare() sert à préparer une requête SQL
// execute() sert à exécuter la requête préparée
// Entre parenthèse c'est du SQL

$request = $db->prepare("UPDATE appointments SET appointment_datetime = :appointment_datetime, patient_id = :patient_id WHERE id = :id");

$request->execute([
    ':id' => $id,
    ':appointment_datetime' => $appointmentDateTime,
    ':patient_id' => $patientId
]);

// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ../public/profil-rendezvous.php?id=$id&success=true");
exit();
