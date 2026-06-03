<?php
require_once "../utils/db_connect.php";

// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../process/ajout-rendezvous.php?error=bad-method");
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["patient_id"]) || !isset($_POST["appointment_date"]) || !isset($_POST["appointment_time"]) || !isset($_POST["reason"])) {
    header("Location: ../process/ajout-rendezvous.php?error=missing-value");
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty(empty($_POST["appointment_id"]) || $_POST["appointment_date"]) || empty($_POST["appointment_time"]) || empty($_POST["reason"])) {
    header("Location: ../process/ajout-rendezvous.php?error=value-empty");
    exit();
}

// POUR LA SECURITE DES DATES
$date = trim($_POST["appointment_date"]);

$appointment_date = DateTime::createFromFormat('Y-m-d', $date);

if (!$appointment_date || $appointment_date->format('Y-m-d') !== $date) {
    header("Location: ../process/ajout-rendez-vous.php?error=invalid-date");
    exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$patient_id = htmlspecialchars(strip_tags(trim($_POST["patient_id"])));
$appointment_id = htmlspecialchars(strip_tags(trim($_POST["appointment_id"])));
$appointment_time = htmlspecialchars(strip_tags(trim($_POST["appointment_time"])));

// Pour la date, c'est en haut de la sécurité

$reason = htmlspecialchars(strip_tags(trim($_POST["reason"])));


// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD (PDO traduit php pour pouvoir communiquer avec la BDD)
require_once "../utils/db_connect.php";


// La requête entière est du PDO :
// prepare() sert à préparer une requête SQL
// execute() sert à exécuter la requête préparée
// Entre parenthèse c'est du SQL

// Vérifier que le patient existe
$request = $db->prepare("SELECT id FROM patients WHERE id = :id");

$request->execute([
    'id' => $appointment_id
]);

$patient = $request->fetch();

if (!$patient) {
    header('Location: ../process/ajout-rendezvous.php?error=bad-method');
}

// INSERTION PDO
$request = $db->query("
INSERT INTO appointments
(
    patient_id = :patient_id,
    appointment_date = :appointment_date,
    appointment_time = :appointment_time
)
");

$request = $db->prepare($request);

$request->execute([
    ':patient_id' => $patient_id,
    ':appointment_date' => $appointment_date,
    ':appointment_time' => $appointment_time
]);

// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ../public/liste-rendezvous.php");
exit();

?>