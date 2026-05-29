<?php 
// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
  header("Location: ../process/ajout-patient.php?error=bad-method");
  exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["prenom"]) || !isset($_POST["nom"])) {
  header("Location: ../process/ajout-patient.php?error=bad-method");
  exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty($_POST["nom"]) || empty($_POST["prenom"])) {
  header("Location: ../process/ajout-patient.php?error=bad-method");
  exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$prenom = htmlspecialchars(strip_tags(trim($_POST["prenom"])));
$nom = htmlspecialchars(strip_tags(trim($_POST["nom"])));












// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD













// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ../public/liste-patient.php");
exit();

?>