
        
    // Récupérer le select des filières
    let filiere_game = document.getElementById('filiere_game')

    // Récupérer le select des classes
    const classeSelect = document.getElementById('classe_game');
    classeSelect.disabled = true;

    // Récupérer le select des matières
    const matiereSelect = document.getElementById('matiere_game');
    matiereSelect.disabled = true;

    filiere_game.addEventListener('change', function(){
        //alert(filiere_game.value)
        show_classe(filiere_game.value)
        matiereSelect.disabled = true;
    })

    classeSelect.addEventListener('change', function(){
        show_matiere(classeSelect.value)
    })

    // Fonction pour filtrer les classes selon l'id de la filière
    function show_classe(id) {
        
        
        // Récupérer toutes les options du select
        const options = classeSelect.querySelectorAll('option');
        
        // Récupérer l'option par défaut
        const defaultOption = classeSelect.querySelector('option[value="0"]');
        
        // Réinitialiser la sélection
        classeSelect.value = '0';
        
        // Compteur pour vérifier s'il y a des classes disponibles
        let classesDisponibles = 0;
        
        // Parcourir toutes les options (sauf la première)
        options.forEach(option => {
            if (option.value === '0') {
                return; // Ignorer l'option par défaut
            }
            
            // Récupérer l'attribut data-filiere de l'option
            const dataFiliere = option.getAttribute('data-filiere');
            
            // Afficher ou masquer l'option selon la condition
            if (dataFiliere === id.toString()) {
                option.style.display = 'block';
                classesDisponibles++;
            } else {
                option.style.display = 'none';
            }
        });
        
        // Gestion de l'état du select et du message dans l'option par défaut
        if (id === '0' || id === 0) {
            // Aucune filière sélectionnée
            classeSelect.disabled = true;
            defaultOption.textContent = 'Choisissez votre classe';
            defaultOption.style.color = '#666';
        } else if (classesDisponibles === 0) {
            // Filière sélectionnée mais aucune classe disponible
            classeSelect.disabled = true;
            defaultOption.textContent = 'Aucune classe disponible pour cette spécialité';
            defaultOption.style.color = '#dc3545'; // Rouge pour indiquer un problème
        } else {
            // Filière sélectionnée avec des classes disponibles
            classeSelect.disabled = false;
            defaultOption.textContent = 'Choisissez votre classe';
            defaultOption.style.color = '#666';
        }
    }

    // Fonction pour filtrer les matières selon l'id de la classe
    function show_matiere(id) {
        
        
        // Récupérer toutes les options du select
        const options = matiereSelect.querySelectorAll('option');
        
        // Récupérer l'option par défaut
        const defaultOption = matiereSelect.querySelector('option[value="0"]');
        
        // Réinitialiser la sélection
        matiereSelect.value = '0';
        
        // Compteur pour vérifier s'il y a des matières disponibles
        let matieresDisponibles = 0;
        
        // Parcourir toutes les options (sauf la première)
        options.forEach(option => {
            if (option.value === '0') {
                return; // Ignorer l'option par défaut
            }
            
            // Récupérer l'attribut data-classe de l'option
            const dataClasse = option.getAttribute('data-classe');
            
            // Afficher ou masquer l'option selon la condition
            if (dataClasse === id.toString()) {
                option.style.display = 'block';
                matieresDisponibles++;
            } else {
                option.style.display = 'none';
            }
        });
        
        // Gestion de l'état du select et du message dans l'option par défaut
        if (id === '0' || id === 0) {
            // Aucune classe sélectionnée
            matiereSelect.disabled = true;
            defaultOption.textContent = 'Choisissez votre matière';
            defaultOption.style.color = '#666';
        } else if (matieresDisponibles === 0) {
            // Classe sélectionnée mais aucune matière disponible
            matiereSelect.disabled = true;
            defaultOption.textContent = 'Aucune matière disponible pour cette classe';
            defaultOption.style.color = '#dc3545'; // Rouge pour indiquer un problème
        } else {
            // Classe sélectionnée avec des matières disponibles
            matiereSelect.disabled = false;
            defaultOption.textContent = 'Choisissez votre matière';
            defaultOption.style.color = '#666';
        }
    }

