<nav>
    <div class="left">
        <a href="<?= getURI('/') ?>"><h1>ByeCiné!</h1></a>
    </div>
    <div class="right">
        <a class="moviesTab" href="<?= getURI('/films') ?>">Films</a>
        <a class="actorsTab" href="<?= getURI('/acteurs') ?>">Acteurs</a>
        <?php if (isLoggedIn()) { ?>

            <a class="logout" href="<?= getURI('/auth/logout') ?>">
                <img class="userIcon" src="<?= AVATARS_UPLOAD_DIR . $_SESSION['user']['avatar'] ?>">
            </a>

        <?php } else { ?>

            <a class="login" href="<?= getURI('/auth/login') ?>">Login</a>
        <?php } ?>
    </div>
</nav>