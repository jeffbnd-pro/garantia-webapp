<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garant'IA</title>

    <!-- Google Font : Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        .logo {
            width: 280px;
            margin-bottom: 50px;
            margin-right: 20px;
        }

        /* Container des boutons */
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
            max-width: 300px;
        }

        /* Style général des boutons */
        .btn {
            width: 100%;
            padding: 14px 0;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        /* Bouton Primary (#333) */
        .btn-primary {
            background: #333;
            color: white;
            box-shadow: 0 4px 12px rgba(51, 51, 51, 0.2);
        }
        .btn-primary:hover {
            opacity: 0.9;
        }

        /* Bouton Secondary (#333 outline) */
        .btn-secondary {
            background: white;
            color: #333;
            border: 2px solid #333;
        }
        .btn-secondary:hover {
            background: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="logo">
        <img src="/assets/images/Logo.png" alt="logo de la web app 'Garant'IA'">
    </div>

    <div class="btn-container">
        <a href='http://localhost:8000/?page=login'>
            <button class="btn btn-primary">Se connecter</button>
        </a>

        <a href='http://localhost:8000/?page=register'>
            <button class="btn btn-secondary">S'inscrire</button>
        </a>
    </div>

</body>
</html>