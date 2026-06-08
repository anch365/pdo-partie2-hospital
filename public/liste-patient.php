<?php
// RECUPERER EN BDD LA LISTE DE TOUS LES PATIENTS
require_once '../utils/db_connect.php';

$request = $db->query("SELECT * FROM patients");

$patients = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php"; ?>

<main class="flex flex-col gap-8 justify-center items-center">
    <h1 class="text1-ysabeau">Liste des patients</h1>
    <!-- POURQUOI PAS, DANS LE FUTUR, AJOUTER UN CHAMP DE RECHERCHE POUR TROUVER FACILEMENT UN PATIENT DANS LA LISTE -->

    <!-- AFFICHER LA LISTE DES PATIENTS -->

    <div class="w-full overflow-x-auto">
        <table class="border border-black border-collapse w-full">
            <thead>
                <tr>
                    <th class="border border-black p-2">Nom</th>
                    <th class="border border-black p-2">Prénom</th>
                    <th class="border border-black p-2">Date de naissance</th>
                    <th class="border border-black p-2">N° téléphone</th>
                    <th class="border border-black p-2">Email</th>
                    <th class="border border-black p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) { ?>
                    <tr>
                        <td class="border border-black p-2"><?= $patient['lastname'] ?></td>
                        <td class="border border-black p-2"><?= $patient['firstname'] ?></td>
                        <td class="border border-black p-2"><?= $patient['birthdate'] ?></td>
                        <td class="border border-black p-2"><?= $patient['phone'] ?></td>
                        <td class="border border-black p-2"><?= $patient['mail'] ?></td>

                        <!-- Les icônes d'actions -->

                        <td class="p-2 border border-b-black">
                            <div class="flex flex-row gap-8">

                                <a href="./profil-patient.php?id=<?= $patient['id'] ?>">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="./modifier-patient.php?id=<?= $patient['id'] ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <a href="">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
        <a href="./ajout-patient.php">Créer un client</a>
    </button>
    <button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
        <a href="./ajout-rendezvous.php">Prendre rendez-vous</a>
    </button>

</main>

<?php require_once "../_partials/_footer.php" ?>