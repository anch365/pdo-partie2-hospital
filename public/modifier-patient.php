<?php
require_once '../utils/db_connect.php';
$id = $_GET['id'];

$request = $db->prepare("SELECT * FROM patients WHERE id = ?");

$request->execute([$id]);
$patient = $request->fetch(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php" ?>

<form action="../process/maj-patient.php" method="POST" class="flex flex-col gap-8">
    <div>
        <label for="lastname" class="font-bold">Nom :</label>
        <input type="text" placeholder=" Ex: Théo" id="lastname" name="lastname" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl" value="<?= $patient['lastname'] ?>">
    </div>
    <div>
        <label for="firstname" class="font-bold">Prénom : </label>
        <input type="text" placeholder=" Ex: Michel" id="firstname" name="firstname" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl" value="<?= $patient['firstname'] ?>">
    </div>
    <div>
        <label for="birthdate" class="font-bold">Date de naissance : </label>
        <input type="date" placeholder=" Ex: 40" id="birthdate" name="birthdate" minlength="1" maxlength="10" required class="border-solid border-2 rounded-xl" value="<?= $patient['birthdate'] ?>">
    </div>
    <div>
        <label for="phone" class="font-bold">Téléphone : </label>
        <input type="tel" placeholder=" Ex: 0640132412" id="phone" name="phone" minlength="2" maxlength="10" required class="border-solid border-2 rounded-xl" value="<?= $patient['phone'] ?>">
    </div>
    <div>
        <label for="mail" class="font-bold">Email : </label>
        <input type="email" placeholder=" Ex: test_test@test.test" id="mail" name="mail" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl" value="<?= $patient['mail'] ?>">
    </div>
    <div>
        <input type="hidden" name="id" value="<?= $patient['id'] ?>">
    </div>

    <button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
        Enregistrer
    </button>
</form>
<?php require_once "../_partials/_footer.php" ?>