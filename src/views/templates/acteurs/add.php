<form method="post" action="#">

    <label for="nom"><input type="text" name="nom" id="nom" placeholder="Nom" required></label>

    <label for="prenom"><input type="text" name="prenom" id="prenom" placeholder="Prénom"></label>

    <br>
    
    <button type="submit">Envoyer</button>

    <span class="sucessMessage">
        <?= $data['successMessage'] ?>
    </span>

</form>