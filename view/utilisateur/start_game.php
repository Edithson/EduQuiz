<?php
require_once('view/layout/nav_bar.php');

?>



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
                            <select name="matiere_game" id="matiere_game" class="filter-select">
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
                            <input type='submit' name='valider' value='Valider ✔'>
                        </form><br>
                        <a href="index.php?path=accueil"><button>Annuler ❌</button></a>
                    </section>
                </div>
            </div>
        </div>
            
        
    </div>

<script src="js/filtre.js"></script>
