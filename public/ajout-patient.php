<?php require_once "../_partials/_header.php" ?>

<main class="flex flex-col gap-16">
    <h1 class="text1-ysabeau text-4xl text-center">Formulaire d'ajout de patient</h1>

    <form action="../process/ajout-patient.php" method="POST" class="flex flex-col gap-8">
         <div>
            <select name="genre" id="genre" class="border-2 border-solid rounded-4xl">
                <option value="Valeur">Genre</option>
                <option value="Mr">Mr</option>
                <option value="Mme">Mme</option>
            </select><br> <br>
        </div>
        <div>
            <label for="nom" class="font-bold">Prénom :</label>
            <input type="text" placeholder="Ex: Michel" id="nom" name="nom" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="prenom" class="font-bold">Nom :</label>
            <input type="text" placeholder="Ex: Théo" id="prenom" name="prenom" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="prenom" class="font-bold">Date de naissance :</label>
            <input type="date" placeholder="Ex: Théo" id="prenom" name="prenom" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>

        <button type="submit" class="border-solid border rounded-xl bg-bleue-bouton">Créer le client</button>
    </form>
</main>

<?php require_once "../_partials/_footer.php" ?>