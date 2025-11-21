<?php
session_start();

if (!isset($_SESSION['iduser'])) {
    echo "Erreur : utilisateur non connecté";
    exit;
}

?>

<head>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        #user-section {
            margin-top: 45px;
        }

        .title-section{
            font-size: 25px;
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            text-decoration: underline;
            margin-bottom: 15px;
        }

        #user-content{
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }



        .user-link{
            display: flex;
            justify-content: space-between;
            padding: 8px 23px;
            border-radius: 25px;
        }
        .yellow{
            background-color: rgba(255, 219, 103, 0.2);
        }
        .pink{
            background-color: rgba(249, 101, 101, 0.2);
        }
        .green{
            background-color: rgba(103, 255, 194, 0.2);
        }
        .purple{
            background-color: rgba(101, 114, 249, 0.2);
        }
        .grey{
            background-color: rgba(1, 1, 1, 0.2);
        }



        .title-div{
            font-size: 17px;
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            text-decoration: underline;
            color: var(--ink);
        }

        #userName{
            font-size: 20px;
            font-weight: 500;
            color: #333;
        }
    </style>
</head>



<section id="user-section">
    <div id="user-title">
        <p class="title-section">Mon profil</p>
        <p>Connecté en tant que : <span id="userName"><?= $_SESSION["userName"] ?></span></p>
    </div>

    <section id="user-content">
        <a href="">
            <div class="user-link yellow">
                <p class="title-div">Modifier mon profil</p>
                <div class="user-arrow">
                    <img src="./assets/images/user-arrow.png" alt="arrow">
                </div>
            </div>
        </a>
        <a href="">
            <div class="user-link pink">
                <p class="title-div">Garanties expirées</p>
                <div class="user-arrow">
                    <img src="./assets/images/user-arrow.png" alt="arrow">
                </div>
            </div>
        </a>
        <a href="">
            <div class="user-link green">
                <p class="title-div">Paramètres</p>
                <div class="user-arrow">
                    <img src="./assets/images/user-arrow.png" alt="arrow">
                </div>
            </div>
        </a>
        <a href="">
            <div class="user-link purple">
                <p class="title-div">Alertes</p>
                <div class="user-arrow">
                    <img src="./assets/images/user-arrow.png" alt="arrow">
                </div>            </div>
        </a>
        <a href="/Users/jeffbenard/Desktop/garantia/public/components/user/login_logout/logout.php">
            <div class="user-link grey">
                <p class="title-div">Se déconnecter</p>
                <div class="user-arrow">
                    <img src="./assets/images/user-arrow.png" alt="arrow">
                </div>
            </div>
        </a>
    </section>
</section>