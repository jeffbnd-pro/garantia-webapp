<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantIA</title>
    <link rel="stylesheet" href="/assets/styles/styles.css">

    <style>
        body { margin: 0; font-family: Arial; display: flex; flex-direction: column; height: 100vh; }
        #main-content { flex: 1; overflow-y: auto; padding: 20px; }

        #bottom-nav {
            display: flex;
            justify-content: space-around;
            background: #2c3e50;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        #bottom-nav button {
            border: none;
            background: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
        #bottom-nav button:hover { color: #f39c12; }

        #fixed-add-btn {
            position: fixed;
            bottom: 60px; /* juste au-dessus de la nav */
            width: 100%;
            display: flex;
            justify-content: center;
            z-index: 100;
        }

        #fixed-add-btn button {
            background-color: #f39c12;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        #fixed-add-btn button:hover {
            background-color: #e67e22;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

<div id="main-content"></div>

<div id="fixed-add-btn">
    <button id="add-warranty-btn">➕ Ajouter une garantie</button>
</div>

<div id="bottom-nav">
    <button class="nav-btn" data-page="dashboard">🏠</button>
    <button class="nav-btn" data-page="alert">🔔</button>
    <button class="nav-btn" data-page="comming">🚧</button>
    <button class="nav-btn" data-page="user">👤</button>
</div>

<script>
$(document).ready(function(){

    function loadPage(page){
        $("#main-content").html("<p>Chargement...</p>");

        $.ajax({
            url: "public/pages/index" + page.charAt(0).toUpperCase() + page.slice(1) + ".php",
            success: function(data){
                $("#main-content").html(data);
                window.history.pushState({}, "", "?page=" + page); // change URL sans recharger
            },
            error: function(){
                $("#main-content").html("<p>Erreur de chargement.</p>");
            }
        });
    }

    // Charge la page demandée dans l’URL au chargement
    const current = new URLSearchParams(window.location.search).get('page') || 'dashboard';
    loadPage(current);

    // Navigation
    $(".nav-btn").click(function(){
        loadPage($(this).data("page"));
    });

    // Bouton Ajouter une garantie
    $("#add-warranty-btn").click(function(){
        loadPage("addWarranty");
    });

});
</script>

</body>
</html>