<?php 
// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
  header("Location: ../process/ajout-patient.php?error=bad-method");
  exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["nom"]) || !isset($_POST["prenom"]) || !isset($_POST["dateNaissance"]) || !isset($_POST["telephone"]) || !isset($_POST["email"])) {
  header("Location: ../process/ajout-patient.php?error=bad-method");
  exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["dateNaissance"]) || empty($_POST["telephone"]) || empty($_POST["email"])) {
  header("Location: ../process/ajout-patient.php?error=bad-method");
  exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$nom = htmlspecialchars(strip_tags(trim($_POST["nom"])));
$prenom = htmlspecialchars(strip_tags(trim($_POST["prenom"])));
$dateNaissance = (int)$_POST["dateNaissance"];
$telephone = htmlspecialchars(strip_tags(trim($_POST["telephone"])));
$email = htmlspecialchars(strip_tags(trim($_POST["email"])));


// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD
require_once "../utils/db_connect.php";

$request = $db->prepare("INSERT INTO patient
(nom, prenom, dateNaissance, telephone, email)
VALUES(?,?,?,?,?)");

$request->execute([
    $nom,
    $prenom,
    $dateNaissance,
    $telephone,
    $email
]);

// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ../public/liste-patient.php");
exit();

?>

    <form action="../process/ajout-patient.php" method="POST" class="flex flex-col gap-8">
        <div>
            <select name="genre" id="genre" class="border-2 border-solid rounded-4xl">
                <option value="Valeur">Genre</option>
                <option value="Mr">Mr</option>
                <option value="Mme">Mme</option>
            </select><br> <br>
        </div>
        <div>
            <label for="prenom" class="font-bold">Nom :</label>
            <input type="text" placeholder="Ex: Théo" id="nom" name="nom" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="nom" class="font-bold">Prénom :</label>
            <input type="text" placeholder="Ex: Michel" id="prenom" name="prenom" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="prenom" class="font-bold">Âge :</label>
            <input type="number" placeholder="Ex: 40" id="age" name="age" minlength="1" maxlength="3" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="prenom" class="font-bold">Téléphone :</label>
            <input type="tel" placeholder="Ex: 0640132412" id="telephone" name="telephone" minlength="2" maxlength="10" required class="border-solid border-2 rounded-xl">
        </div>

        <button type="submit" class="border-solid border rounded-xl bg-bleue-bouton">Ajouter le client</button>
    </form>
