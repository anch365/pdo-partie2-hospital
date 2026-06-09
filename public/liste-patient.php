<?php
// RECUPERER EN BDD LA LISTE DE TOUS LES PATIENTS
require_once '../utils/db_connect.php';

// $request = $db->query("SELECT * FROM patients");

// $patients = $request->fetchAll(PDO::FETCH_ASSOC);

/* PAGINATION */

// Nombre de patients par page
$limit = 10;

// Page actuelle
$page = (int) ($_GET['page'] ?? 1);

if ($page < 1) {
    $page = 1;
}

// Position de départ
$offset = ($page - 1) * $limit;

// Compter le nombre total de patients
$request = $db->query("
    SELECT COUNT(*) AS total
    FROM patients
");

$result = $request->fetch(PDO::FETCH_ASSOC);

$totalPatients = $result['total'];

// Nombre total de pages
$totalPages = ceil($totalPatients / $limit);

// Traitement php de la barre de recherche
$search = trim($_GET['search'] ?? '');

if ($search !== '') {

    $request = $db->prepare("SELECT *
        FROM patients
        WHERE lastname LIKE :search
        OR firstname LIKE :search
        OR mail LIKE :search
        OR phone LIKE :search
        ORDER BY lastname ASC
        LIMIT :limit
        OFFSET :offset        
    ");

    $request->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $request->bindValue(':limit', $limit, PDO::PARAM_INT);
    $request->bindValue(':offset', $offset, PDO::PARAM_INT);

    $request->execute();
} else {

    // Récupérer uniquement les patients de la page courante
    $request = $db->prepare("SELECT *
        FROM patients
        ORDER BY lastname ASC
        LIMIT :limit
        OFFSET :offset
    ");

    $request->bindValue(':limit', $limit, PDO::PARAM_INT);
    $request->bindValue(':offset', $offset, PDO::PARAM_INT);
    $request->execute();
}

$patients = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php"; ?>

<main class="flex flex-col gap-8 justify-center items-center">
    <h1 class="text1-ysabeau">Liste des patients</h1>

    <!-- UN CHAMP DE RECHERCHE POUR TROUVER FACILEMENT UN PATIENT DANS LA LISTE -->
    <form method="GET" class="mb-4 flex gap-2">

        <input
            type="text"
            name="search"
            placeholder="Rechercher un patient..."
            class="border p-2 rounded"
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

        <button
            type="submit"
            class="border p-2 rounded-full bg-bleue-bouton">
            <i class="fa-solid fa-search"></i>
        </button>

    </form> <!-- AFFICHER LA LISTE DES PATIENTS -->
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

                                <form action="../process/delete-patient.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $patient['id'] ?>">
                                    <button type="submit" onclick="return confirm('Voulez-vous supprimer ce patient')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>

    <!-- Pagination -->

    <div class="flex gap-2 flex-wrap justify-center">

        <?php if ($page > 1) { ?>

            <a
                href="?page=<?= $page - 1 ?>"
                class="px-4 py-2 border rounded">
                Précédent
            </a>

        <?php } ?>

        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>

            <a
                href="?page=<?= $i ?>"
                class="px-4 py-2 border rounded">
                <?= $i ?>
            </a>

        <?php } ?>

        <?php if ($page < $totalPages) { ?>

            <a
                href="?page=<?= $page + 1 ?>"
                class="px-4 py-2 border rounded">
                Suivant
            </a>

        <?php } ?>

    </div>


    <button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
        <a href="./ajout-patient.php">Créer un client</a>
    </button>
    <button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
        <a href="./ajout-rendezvous.php">Prendre rendez-vous</a>
    </button>

</main>

<?php require_once "../_partials/_footer.php" ?>