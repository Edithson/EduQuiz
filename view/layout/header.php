<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduQuiz - Votre compagnon d'apprentissage</title>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script2.js"></script>
    <link rel="stylesheet" href="css/style1.css">

    <script src="templete/script.js"></script>
    
    <link rel="stylesheet" href="templete/style.css">
    <link rel="stylesheet" href="templete/style2.css">
    <!-- <link rel="stylesheet" href="templete/style3.css"> -->

    <script>
        function stopMe() {/*
            document.getElementById('drap').style.display='none';
            document.getElementById('user_form').addEventListener('click', function(event) {
                event.stopPropagation(); // Empêche la propagation de l'événement vers le conteneur
                // Optionnel : ajouter une action ici si nécessaire
            });*/

        }
    </script>
    
    <style>
        #arriere_plan{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            text-align: center;
            padding: 20px;
            background-color: rgba(16, 79, 119, 0.5);
            z-index: 5;
            display: none;
        }
    </style>
</head>
<body>
    
    <div id="arriere_plan" onclick="stopQuiz()">

    </div>