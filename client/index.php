<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.index.css">
    <script src="script.js" defer></script>
    <title>Home Page</title>
</head>
<body>
    <div class="canvas index">
        <header>
            <h3 class="mn-box left-side">app<span class="Academia">academia</span></h3>
            <div class="mn-box right-side">
                <div class="_username">Admin</div>
                <div class="_userprofil"><img src="_icons/userprofil.svg" alt=""></div>
            </div>
        </header>
        <section>
            <?php include "_admin/home.php";?>
        </section>
        <div class="_user-popup">
            <div class="_icon">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
            </div>
            <span>Deconnexion ?</span>
        </div>
        <div class="_log-out-popup">
            <div class="cancel">Annuler</div>
            <div class="confirme">Confirmer</div>
        </div>
    </div>
</body>
</html>