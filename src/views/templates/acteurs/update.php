<?php 
    $acteur = $data['acteur'];
?>

    <div class="container">

        <form enctype="multipart/form-data" method="post" class="acteurContainer">       

            <div class="group">
                <label for="prenom">
                    <input type="text" id="prenom" name="prenom" class="acteurNom empty" placeholder="Prénom" value="<?= $acteur->getPrenom() ?>" required>
                </label>

                <label for="nom">
                    <input type="text" id="nom" name="nom" class="acteurNom empty" placeholder="Nom" value="<?= $acteur->getNom() ?>" required>
                </label>
            </div>

            <label for="films">Films
                <select id="films" class="multipleSelect" name="films[]" multiple="multiple">
                    <?php foreach ($data['allFilms'] as $key => $film) { ?>
                        <option value="<?= $film->getId() ?>" <?= $acteur->hasFilm($film->getId()) ? 'selected' : '' ?> ><?= $film->getNom() ?></option>
                    <?php } ?>
                </select>   
            </label>

            <div class="buttons">
                <a class="submitButton cancelButton" href="<?= getURI('/acteurs/get?id='.$acteur->getId()) ?>">Annuler</a>
                <button class="submitButton" type=submit action="<?= getURI('/acteurs/update?id='.$acteur->getId()) ?>">Valider</button>
            </div>
        </form>

    </div>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../public/scripts/select2.js"></script>



