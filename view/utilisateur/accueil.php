<?php
require_once('view/layout/nav_bar.php');

?>

<div id="start_game">

    <div id="subjectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">📚 Préparation du jeu</h2>
            </div>
            <section class="conteneur" id="conteneur" style="height: 100%;">
            <?php
            if (isset($msg) && isset($msg_type)) {?>
                <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
                    <strong><?=$msg?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            }
            ?>
                <br>

                <form action="index.php?path=action" method="post">
                    <!-- Choix de la spécialite (filière) -->
                    <select name="filiere_game" id="filiere_game" class="filter-select">
                    <option value='0' selected> Choisissez votre filière </option>;
                        <?php
                        while ($filiere = $filieres->fetch()) {
                            ?>
                            <option value="<?= $filiere['id'] ?>"><?= $filiere['nom'] ?></option>
                            <?php
                        }
                        ?>
                    </select><br><br>
                    
                    <!-- Choix de la classe -->
                    <select name="classe_game" id="classe_game" class="filter-select">
                    <option value='0' selected> Choisissez votre classe </option>;
                        <?php
                        while ($classe = $classes->fetch()) {
                            ?>
                            <option data-filiere="<?= $classe['id_specialite'] ?>" value="<?= $classe['id'] ?>"><?= $classe['intitule'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>

                    <!-- Choix de la matière -->
                    <select name="matiere_game" id="matiere_game" class="filter-select" require>
                    <option value='0' selected> Choisissez votre matière </option>;
                        <?php
                        while ($matiere = $matieres->fetch()) {
                            ?>
                            <option data-classe="<?= $matiere['id_classe'] ?>" value="<?= $matiere['id_matiere'] ?>"><?= $matiere['nom'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <input type='submit' id="commencer" name='valider' value='Commencer ✔'>
                </form><br>
                <button id="hide" onclick="stopQuiz()">Annuler ❌</button>
            </section>
        </div>
    </div>
</div>

<div class="stars" id="stars"></div>
    
    <div class="floating-elements">
        <div class="floating-book">📚</div>
        <div class="floating-pencil">✏️</div>
        <div class="floating-lightbulb">💡</div>
    </div>

    <div class="container">
        <header>
            <h1 class="logo">🎓 EduQuiz</h1>
            <p class="tagline">Transformez votre apprentissage en aventure ludique</p>
        </header>

        <div class="main-content">
            <div class="welcome-section">
                <h2 class="welcome-title">Bienvenue dans votre espace d'apprentissage ! 🌟</h2>
                <p class="welcome-text">
                    Découvrez une nouvelle façon d'apprendre qui combine le plaisir du jeu avec la rigueur académique. 
                    Testez vos connaissances, défiez vos limites et progressez à votre rythme dans un environnement 
                    bienveillant et motivant.
                </p>
                <button class="cta-button" onclick="startQuiz()">Commencer mon parcours 🚀</button>
            </div>

            <div class="features-preview">
                <div class="feature-card" onclick="showFeature('vote')">
                    <span class="feature-icon">🗳️</span>
                    <h3 class="feature-title">Vote de classe</h3>
                    <p class="feature-desc">Demandez l'aide de vos camarades virtuels</p>
                </div>
                
                <div class="feature-card" onclick="showFeature('help')">
                    <span class="feature-icon">📞</span>
                    <h3 class="feature-title">Coup de fil prof</h3>
                    <p class="feature-desc">Un petit conseil de votre enseignant</p>
                </div>
                
                <div class="feature-card" onclick="showFeature('fifty')">
                    <span class="feature-icon">⚡</span>
                    <h3 class="feature-title">50/50</h3>
                    <p class="feature-desc">Éliminez deux mauvaises réponses</p>
                </div>
            </div>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <span class="stat-number" id="questions-count">1,247</span>
                <div class="stat-label">Questions disponibles</div>
            </div>
            
            <div class="stat-card">
                <span class="stat-number" id="students-count">523</span>
                <div class="stat-label">Étudiants actifs</div>
            </div>
            
            <div class="stat-card">
                <span class="stat-number" id="subjects-count">15</span>
                <div class="stat-label">Matières couvertes</div>
            </div>
            
            <div class="stat-card">
                <span class="stat-number" id="success-rate">87%</span>
                <div class="stat-label">Taux de réussite</div>
            </div>
        </div>
    </div>

<script src="js/filtre.js"></script>
<script>
    document.getElementById('commencer').addEventListener('click', function(e){
        let id_matiere = document.getElementById("matiere_game").value
        if (id_matiere == 0) {
            e.preventDefault()
            alert("Veuillez d'abord sélectionner une filière, une classe et une matière valide!")
        }
    })
</script>