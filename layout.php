<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantIA</title>
    <link rel="stylesheet" href="/assets/styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            margin: 0; 
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: normal;
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
        }

        #bottom-nav {
            display: flex;
            justify-content: space-around;
            align-items: end;
            background: rgba(1, 1, 1, 0.2);
            padding: 10px 0;
            position: fixed;
            bottom: 20px;
            left: 15px;
            width: 90%;
            border-radius: 0 0 25px 25px;
        }

        #bottom-nav button {
            border: none;
            background: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #bottom-nav button:hover div {
            background-color: rgba(243, 156, 18, 0.2);
        }

        .nav-btn.active div {
            background-color: rgba(243, 156, 18, 0.3);
            transition: all 0.3s ease;
        }

        #fixed-add-btn {
            position: fixed;
            bottom: 80px;
            width: 100%;
            display: flex;
            justify-content: center;
            right: 5px;
            z-index: 100;
        }

        #fixed-add-btn button {
            background-color: var(--ink);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            width: 90%;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

<div id="main-content"></div>

<div id="fixed-add-btn">
    <button id="add-warranty-btn">J'Ajoute une garantie</button>
</div>

<div id="bottom-nav">
    <button class="nav-btn" data-page="dashboard">
        <div>
            <img src="./assets/images/nav-images/nav-home.png" alt="#">
        </div>
    </button>
    <button class="nav-btn" data-page="alert">
        <div>
            <img src="./assets/images/nav-images/nav-alert.png" alt="#">
        </div>
    </button>
    <button class="nav-btn" data-page="comming">
        <div>
            <img src="./assets/images/nav-images/nav-comming.png" alt="#">
        </div>
    </button>
    <button class="nav-btn" data-page="user">
        <div>
            <img src="./assets/images/nav-images/nav-user.png" alt="#">
        </div>
    </button>
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

    function setActiveNav(page) {
        $(".nav-btn").removeClass("active"); // retire active de tous
        $(".nav-btn[data-page='" + page + "']").addClass("active"); // met active au bon bouton
    }

    // Charge la page demandée dans l’URL au chargement
    const current = new URLSearchParams(window.location.search).get('page') || 'dashboard';
    loadPage(current);
    setActiveNav(current);

    // Navigation
    $(".nav-btn").click(function(){
        const page = $(this).data("page");
        loadPage(page);
        setActiveNav(page);
    });

    // Bouton Ajouter une garantie
    $("#add-warranty-btn").click(function(){
        loadPage("addWarranty");
    });

});
</script>

</body>
</html>