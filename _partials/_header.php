<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hôpital</title>
    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+SC:wght@1..1000&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <!-- Icône sur Font awesome -->
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="../assets/scripts/main.js" defer></script>

</head>

<body class="flex flex-col gap-8 pt-32 px-8 text-ysabeau">

    <header class="flex flex-row fixed top-0 right-0 left-0 bg-bleue justify-between px-8">

        <img src="../assets/imgs/logo-hôpital.png" alt="Logo hôpital du header" class="flex flex-row h-12 mt-2 rounded-full xl:mt-0 xl:items-center">

        <!-- MENU burger -->
        <img id="menuburger" src="../assets/imgs/menu-burger.svg" alt="Menu burger pour les options" class="h-16 lg:hidden">

        <div
            id="fond-sombre"
            class="fixed top-0 right-0 left-0 bottom-0 bg-black/30 hidden lg:hidden">
        </div>
        <!-- Fenêtre du menu mobile -->
        <div
            id="fenetre"
            class="hidden fixed top-16 right-5 bottom-1/2 w-2/3 bg-bleue text-white text-2xl flex-col justify-center px-8 items-start gap-4 rounded-xl">

            <a href="./index.php">Accueil</a>
            <a href="./ajout-patient.php">Ajouter un patient</a>
            <a href="./liste-patient.php">Liste des patients</a>
            <a href="./ajout-rendezvous.php">Prendre rendez-vous</a>
            <a href="./liste-rendezvous.php">Liste des rendez-vous</a>

        </div>

        <!-- MENU Desktop -->
        <nav class="hidden lg:flex lg:flex-row gap-8 items-center">
            <a href="./index.php">Accueil</a>
            <a href="./ajout-patient.php">Ajouter un patient</a>
            <a href="./liste-patient.php">Liste des patients</a>
            <a href="./ajout-rendezvous.php">Prendre rendez-vous</a>
            <a href="./liste-rendezvous.php">Liste des rendez-vous</a>
        </nav>
    </header>