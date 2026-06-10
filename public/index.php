<?php require_once "../_partials/_header.php" ?>

<h1 class="text1-ysabeau text-4xl/relaxed text-center font-bold">Bienvenue sur l'application Hospital</h1>

<p class="flex flex-col lg:items-center">
    Toutes vos coordonnées sont <strong>sécurisées.<br></strong>
    N'ayez aucune crainte pour vous faire consulter, on propose les meilleures consultations de la ville
</p>

<div class="flex flex-col gap-8 lg:flex-row lg:justify-center">
    <button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
        <a href="./ajout-patient.php">Créer un client</a>
    </button>

    <button class="rounded-full bg-bleue-bouton px-16 text-2xl" type="submit">
        <a href="./ajout-rendezvous.php">Prendre rendez-vous</a>
    </button>
</div>
<div class="flex flex-col gap-16 text1-ysabeau justify-center lg:flex-row lg:flex-wrap">
    <article class="w-96">
        <h2>Un accueil de qualité</h2>
        <img src="../assets/imgs/accueil.jpg" alt="L'accueil de l'hôpital">
    </article>

    <article class="w-96">
        <h2>Nos consultations
        </h2>
        <img src="../assets/imgs/infirmier.jpg" alt="Conusltation par les infirmiers">
    </article>

    <article class="w-96">
        <h2>Les analyses</h2>
        <img src="../assets/imgs/analyse.jpg" alt="Faire des analyses">
    </article>
</div>

<?php require_once "../_partials/_footer.php" ?>