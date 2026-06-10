<?php
require_once '../utils/db_connect.php';

$request = $db->query("SELECT id, lastname, firstname FROM patients ORDER BY lastname");
$patients = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php" ?>

<main class="flex flex-col gap-16 justify-center items-center">
    <h1 class="text1-ysabeau text-4xl text-center">Ajouter un patient et prendre rendez-vous</h1>

    <form action="../process/ajout-patient-rendezvous.php" method="POST" class="flex flex-col gap-8">

        <div>
            <select name="genre" id="genre" class="border-2 border-solid rounded-4xl">
                <option value="Valeur">Genre</option>
                <option value="Mr">Mr</option>
                <option value="Mme">Mme</option>
            </select><br> <br>
        </div>

        <div>
            <label for="lastname" class="font-bold">Nom :</label>

            <input type="text" placeholder=" Ex: Théo" id="lastname" name="lastname" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>

        <div>
            <label for="firstname" class="font-bold">Prénom :</label>

            <input type="text" placeholder=" Ex: Michel" id="firstname" name="firstname" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>

        <div>
            <label for="birthdate" class="font-bold">Date de naissance :</label>

            <input type="date" placeholder=" Ex: 40" id="birthdate" name="birthdate" minlength="1" maxlength="10" required class="border-solid border-2 rounded-xl">
        </div>

        <div>
            <label for="phone" class="font-bold">Téléphone :</label>

            <input type="tel" placeholder=" Ex: 0640132412" id="phone" name="phone" minlength="2" maxlength="10" required class="border-solid border-2 rounded-xl">
        </div>

        <div>
            <label for="mail" class="font-bold">Email :</label>

            <input type="email" placeholder=" Ex: test_test@test.test" id="mail" name="mail" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>

        <label for="patient_id" class="font-bold"></label>
        <div class="flex flex-col gap-4">
            <label for="appointment_datetime" class="font-bold">Date & Heure du rendez-vous :</label>

            <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" class="border-solid border rounded" required>
        </div>

        <button type="submit" class="rounded-xl bg-bleue-bouton px-16 text-2xl">
            Ajouter les informations</button>
    </form>

</main>

<?php require_once "../_partials/_footer.php" ?>