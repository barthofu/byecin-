<form method="post" action="#">

    <label for="nom"><input type="text" name="nom" id="nom" placeholder="Nom du film" required></label>

    <label for="annee"><input type="number" name="annee" id="annee" placeholder="Année de sortie"></label>
    <span class="invalidFeedback">
        <?= $data['anneeError'] ?>
    </span>

    <label for="score"><input type="number" step="0.1" name="score" id="score" placeholder="Score du film"></label>
    <span class="invalidFeedback">
        <?= $data['scoreError'] ?>
    </span>

    <label for="nbVotants"><input type="number" name="nbVotants" id="nbVotants" placeholder="Nombre de votants"></label>

    <label for="image"><input type="text" name="image" id="image" placeholder="Lien image du film"></label>

    <br>
    <button type="submit">Envoyer</button>

    <span class="sucessMessage">
        <?= $data['successMessage'] ?>
    </span>

</form>