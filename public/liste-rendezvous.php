<?php
// RECUPERER EN BDD LA LISTE DE TOUS LES PATIENTS
require_once '../utils/db_connect.php';

$request = $db->query("SELECT
    appointments.id,
    appointments.appointment_datetime,
    patients.lastname,
    patients.firstname

FROM appointments

INNER JOIN patients
    ON appointments.patient_id = patients.id

ORDER BY appointments.appointment_datetime");

$appointments = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php"; ?>

<main class="flex flex-col gap-8 items-center">
    <h1 class="text-ysabeau font-bold">La liste des rendez-vous</h1>
    <table class="border border-black">
        <thead>
            <tr>
                <th class="border border-black p-2">Nom</th>
                <th class="border border-black p-2">Prenom</th>
                <th class="border border-black p-2">Date & Heure</th>
                <th class="border border-black p-2">Actions</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $appointment) { ?>
                <tr>
                    <td class="border border-black p-2">
                        <?= $appointment['lastname'] ?>
                    </td>

                    <td class="border border-black p-2">
                        <?= $appointment['firstname'] ?>
                    </td>
                    <td class="border border-black p-2">
                        <?= $appointment['appointment_datetime'] ?>
                    </td>
                    <!-- Les icônes d'actions -->
                    <td class="p-2 border border-b-black">
                        <a href="./profil-rendezvous.php?id=<?= $appointment['id'] ?>">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="./modifier-rendezvous.php?id=<?= $appointment['id'] ?>">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <button type="submit" class="rounded-xl bg-bleue-bouton px-16 text-2xl">
        <a href="./ajout-rendezvous.php">Créer un rendez-vous</a>
    </button>


</main>
<?php require_once "../_partials/_footer.php" ?>