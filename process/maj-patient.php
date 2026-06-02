<?php

// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../process/maj-patient.php?error=bad-method");
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["lastname"]) || !isset($_POST["firstname"]) || !isset($_POST["birthdate"]) || !isset($_POST["phone"]) || !isset($_POST["mail"]) || !isset($_POST["id"])) {
    header("Location: ../process/maj-patient.php?error=missing-value");
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty($_POST["lastname"]) || empty($_POST["firstname"]) || empty($_POST["birthdate"]) || empty($_POST["phone"]) || empty($_POST["mail"]) || empty($_POST["id"])) {
    header("Location: ../process/maj-patient.php?error=value-empty");
    exit();
}

// POUR LA SECURITE DES DATES
$dateNaissance = trim($_POST["birthdate"]);

$date = DateTime::createFromFormat('Y-m-d', $dateNaissance);

if (!$date || $date->format('Y-m-d') !== $dateNaissance) {
    header("Location: ../process/maj-patient.php?error=invalid-date");
    exit();
}

// Pour empêcher une date de naissance dans le futur
$date = DateTime::createFromFormat('Y-m-d', $dateNaissance);
$today = new DateTime();

if ($date > $today) {
    header("Location: ../process/ajout-patient.php?error=future-date");
    exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$id = trim($_POST["id"]);
$nom = htmlspecialchars(strip_tags(trim($_POST["lastname"])));
$prenom = htmlspecialchars(strip_tags(trim($_POST["firstname"])));

// Pour la date, c'est en haut de la sécurité

$telephone = htmlspecialchars(strip_tags(trim($_POST["phone"])));
$email = htmlspecialchars(strip_tags(trim($_POST["mail"])));


// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD (PDO traduit php pour pouvoir communiquer avec la BDD)
require_once "../utils/db_connect.php";


// La requête entière est du PDO :
// prepare() sert à préparer une requête SQL
// execute() sert à exécuter la requête préparée
// Entre parenthèse c'est du SQL
$request = $db->prepare("UPDATE patients SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, phone = :phone, mail = :mail WHERE id = :id");

$request->execute([
    ":id" => $id,
    ":lastname" => $nom,
    ":firstname" => $prenom,
    ":birthdate" => $dateNaissance,
    ":phone" => $telephone,
    ":mail" => $email
]);


// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ../public/profil-patient.php?id=$id&success=true");
exit();
