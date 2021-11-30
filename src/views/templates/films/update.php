<?php 
    $film = $data['film'];
?>

    <div class="container">

        <form enctype="multipart/form-data" method="post" class="filmContainer">

            <div class="filmImageUpload">
                <label for="image">
                    <img alt="affiche" class="filmImage" src=" <?= '../' . FILMS_UPLOAD_DIR . $film->getImage() ?> ">
                    <span class="uploadText">Uploader une nouvelle image</span>
                    <div class="uploadFileName"></div>
                </label>

                <input 
                    type="file"
                    id="image"
                    name="image"
                    accept="image/png, image/jpeg"
                    onchange="document.getElementsByClassName('uploadFileName')[0].innerHTML = document.getElementById('image').value.split('\\').join('/').split('/').slice(-1);"
                >
                
            </div>
            
            <div class="filmInfos">

                <label for="nom">
                    <input type="text" id="nom" name="nom" class="filmNom empty" value="<?= $film->getNom() ?>" required>
                </label>

                <div class="subInfos">
                    <label for="annee">Année de sortie :
                        <input type="text" id="annee" name="annee" class="anneeDeSortie" value="<?= $film->getAnnee() ?>" required>
                    </label>


                    <label for="score">Score :
                        <input type="number" step="0.1" id="score" name="score" class="score" value="<?= $film->getScore() ?>">
                    </label>

                    <label for="nbVotants">Nombre de votants :
                        <input type="number" id="nbVotants" name="nbVotants" class="nbVotants" value="<?= $film->getNbVotants() ?>">
                    </label>

                    <label for="acteurs">Acteurs :
                        <select id="acteurs" class="multipleSelect" name="acteurs[]" multiple="multiple">
                            <?php foreach ($data['allActeurs'] as $key => $acteur) { ?>
                                <option value="<?= $acteur->getId() ?>" <?= $film->hasActeur($acteur->getId()) ? 'selected' : '' ?> ><?= $acteur->getPrenom() . ' ' . $acteur->getNom() ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </div>
            </div>

            <div class="buttons">
                <a class="submitButton cancelButton" href="<?= getURI('/films/get?id='.$film->getId()) ?>">Annuler</a>
                <button class="submitButton" type=submit action="<?= getURI('/films/update?id='.$film->getId()) ?>">Valider</button>
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



