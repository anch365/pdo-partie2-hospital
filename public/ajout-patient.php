<?php require_once "../_partials/_header.php" ?>

<main class="flex flex-col gap-16 justify-center items-center">
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
            <label for="prenom" class="font-bold">Nom :</label>
            <input type="text" placeholder="Ex: Théo" id="nom" name="nom" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="nom" class="font-bold">Prénom :</label>
            <input type="text" placeholder="Ex: Michel" id="prenom" name="prenom" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="dateNaissance" class="font-bold">Date de naissance :</label>
            <input type="date" placeholder="Ex: 40" id="dateNaissance" name="dateNaissance" minlength="1" maxlength="10" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="telephone" class="font-bold">Téléphone :</label>
            <input type="tel" placeholder="Ex: 0640132412" id="telephone" name="telephone" minlength="2" maxlength="10" required class="border-solid border-2 rounded-xl">
        </div>
        <div>
            <label for="email" class="font-bold">Email :</label>
            <input type="email" placeholder="Ex: test_test@test.test" id="email" name="email" minlength="3" maxlength="50" required class="border-solid border-2 rounded-xl">
        </div>

        <button type="submit" class="border-solid border rounded-xl bg-bleue-bouton">Ajouter le client</button>
    </form>
</main>

<?php require_once "../_partials/_footer.php" ?>