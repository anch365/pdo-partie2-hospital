<?php
// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/ajout-patient-rendezvous.php');
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (  
    !isset($_POST['lastname']) ||
    !isset($_POST['firstname']) ||
    !isset($_POST['birthdate']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['mail']) ||
    !isset($_POST['appointment_datetime'])
) {
    header('Location: ../public/ajout-patient-rendezvous.php?error=missing-value');
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (
    empty($_POST['lastname']) ||
    empty($_POST['firstname']) ||
    empty($_POST['birthdate']) ||
    empty($_POST['phone']) ||
    empty($_POST['mail']) ||
    empty($_POST['appointment_datetime'])
) {
    header('Location: ../public/ajout-patient-rendezvous.php?error=value-empty');
    exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
$firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
$telephone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
$mail = htmlspecialchars(strip_tags(trim($_POST['mail'])));

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

// Pour la date de naissance
$dateNaissance = trim($_POST["birthdate"]);

$date = DateTime::createFromFormat('Y-m-d', $dateNaissance);

if (!$date || $date->format('Y-m-d') !== $dateNaissance) {
    header("Location: ../public/ajout-patient.php?error=invalid-date");
    exit();
}
// Pour empêcher une date de naissance dans le futur
$date = DateTime::createFromFormat('Y-m-d', $dateNaissance);
$today = new DateTime();

if ($date > $today) {
    header("Location: ../public/ajout-patient.php?error=future-date");
    exit();
}

// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD (PDO traduit php pour pouvoir communiquer avec la BDD)
require_once '../utils/db_connect.php';

// INSERTION DU PATIENT
$request = $db->prepare("INSERT INTO patients
    (
        lastname,
        firstname,
        birthdate,
        phone,
        mail
    )
    VALUES
    (
        :lastname,
        :firstname,
        :birthdate,
        :phone,
        :mail
    )
");

$request->execute([
    ':lastname' => $lastname,
    ':firstname' => $firstname,
    ':birthdate' => $dateNaissance,
    ':phone' => $telephone,
    ':mail' => $mail
]);

// RECUPERER L'ID DU PATIENT CREE
$patientId = $db->lastInsertId();

// INSERTION DU RENDEZ-VOUS
$request = $db->prepare("INSERT INTO appointments
    (
        patient_id,
        appointment_datetime
    )
    VALUES
    (
        :patient_id,
        :appointment_datetime
    )
");

$request->execute([
    ':patient_id' => $patientId,
    ':appointment_datetime' => $appointmentDateTime
]);
header('Location: ../public/liste-rendezvous.php');
exit();
?>