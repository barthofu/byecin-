<form enctype="multipart/form-data" method="post" action="#">

    <label for="nom">
        <div class="labelName">Nom du film</div>
        <input type="text" name="nom" id="nom" placeholder="" required>
    </label>

    <label for="annee">
        <div class="labelName">Année de sortie</div>
        <input type="number" name="annee" id="annee" placeholder="" required>
    </label>
    <span class="invalidFeedback">
        <?= $data['anneeError'] ?>
    </span>

    <label for="score">
        <div class="labelName">Score</div>
        <input type="number" step="0.1" name="score" id="score" placeholder="" required>
    </label>
    <span class="invalidFeedback">
        <?= $data['scoreError'] ?>
    </span>

    <label for="nbVotants">
        <div class="labelName">Nombre de votants</div>
        <input type="number" name="nbVotants" id="nbVotants" placeholder="" required>
    </label>

    <label for="image">
        <div class="labelName">Affiche</div>
        <input type="file" name="image" id="image" accept="image/png, image/jpeg" required>
    </label>

    <label for="acteurs">
        <div class="labelName">Acteurs</div>
        <select id="acteurs" class="multipleSelect" name="acteurs[]" multiple="multiple">
            <?php foreach ($data['allActeurs'] as $key => $acteur) { ?>
                <option value="<?= $acteur->getId() ?>"><?= $acteur->getPrenom() . ' ' . $acteur->getNom() ?></option>
            <?php } ?>
        </select>
    </label>


    <br>
    <button type="submit">Envoyer</button>

    <br>
    <div class="successMessage">
        <?= $data['successMessage'] ?>
    </div>

</form>

<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../public/scripts/select2.js"></script>