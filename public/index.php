<?php require_once "../_partials/_header.php" ?>

<h1 class="text1-ysabeau text-4xl/relaxed text-center font-bold">Bienvenue sur l'application Hospital</h1>
<p>Toutes vos coordonnées sont <strong>sécurisées</strong>. <br>N'ayez aucune crainte pour vous faire consulter, on propose les meilleures consultations de la ville</p>
<button class="border-2 rounded-full bg-bleue-bouton"><a href="./ajout-patient.php">Créer un client</a></button>

<button class="border-2 rounded-full bg-bleue-bouton"><a href="./ajout-rendezvous.php"></a></button>

<div class="flex flex-col gap-16 text-5xl">
    <article>
        <h2>Une accueil de qualité</h2>
        <img src="../assets/imgs/accueil.jpg" alt="L'accueil de l'hôpital">
    </article>

    <article>
        <h2>Nos services de consultations
        </h2>
        <img src="../assets/imgs/infirmier.jpg" alt="Conusltation par les infirmiers">
    </article>

    <article>
        <h2>Les analyses</h2>
        <img src="../assets/imgs/analyse.jpg" alt="Faire des analyses">
    </article>
</div>
<?php require_once "../_partials/_footer.php" ?>