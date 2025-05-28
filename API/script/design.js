

// Création des étoiles scintillantes
        
function createStars() {
    const starsContainer = document.getElementById('stars');
    const numberOfStars = 50;

    for (let i = 0; i < numberOfStars; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        star.style.width = Math.random() * 3 + 1 + 'px';
        star.style.height = star.style.width;
        star.style.animationDelay = Math.random() * 2 + 's';
        starsContainer.appendChild(star);
    }
}


function showFeature(feature) {
    const messages = {
        vote: '🗳️ Le vote de classe vous permet de voir ce que pensent vos camarades virtuels. Une aide précieuse quand vous hésitez !',
        help: '📞 Besoin d\'un coup de main ? Votre professeur virtuel est là pour vous donner un indice bienveillant.',
        fifty: '⚡ Le 50/50 élimine deux mauvaises réponses pour vous faciliter le choix. Utilisez-le judicieusement !'
    };
    
    alert(messages[feature]);
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    createStars();
});


