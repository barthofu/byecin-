<form method="post" action="#">

    <label for="prenom">
        <div class="labelName">Prénom</div>
        <input type="text" name="prenom" id="prenom" placeholder="" required>
    </label>

    <label for="nom">
        <div class="labelName">Nom</div>
        <input type="text" name="nom" id="nom" placeholder="" required>
    </label>


    <label for="films">
        <div class="labelName">Films</div>
        <select id="films" class="multipleSelect" name="films[]" multiple="multiple">
            <?php foreach ($data['allFilms'] as $key => $film) { ?>
                <option value="<?= $film->getId() ?>"><?= $film->getNom() ?></option>
            <?php } ?>
        </select>
    </label>
    
    <button class="submitButton" type="submit">Envoyer</button>

    <?php if ($data['success']) { ?>
        <span class="successMessage">Ajouté avec succès !</span>
    <?php } else if ($data['error'] === 'insertFailed') { ?>
        <span class="invalidFeedback">Erreur lors de l'ajout</span>
    <?php } ?>

</form>

<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../public/scripts/select2.js"></script>