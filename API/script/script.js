//repliques
repliqueAppelPublic = ["Votre salle de classe a fini de voter", "vous avez choisi le vote de la salle de classe, n'oubliez pas que, le dernier mot vous revient", "voici le resultat du vote de la salle de classe"]
repliqueDuCinquante = ["vous utiliser votre cinquante cinquante, pas de probleme", "l'ordinateur s'est charger d'éliminer deux mauvaise réponses", "vous avez activer votre cinquante cinquante"]
repliqueoutils = ["vous ne pouvez pas utiliser cet avantage plus d'une fois","cet outils a deja été utiliser","cet option n'est plus disponible pour vous", "vous ne pouvez plus utiliser cet outils"]
RbonneReponse = ["excellente reponse", "bonne reponse", "bravo!", "parfait!"]
dialogue1 = ["bonjour Monsieur Kamwa", "allo, Monsieur Djona?", "bonjour Monsieur Tejiogni"]
dialogue2 = ["bonjour a vous", "merci bonjour", "oui bonjour", "bonjour,"]
dialogue3 = ["pouriez vous aider votre jeune élève sur cette question,", "pour obtenir la reponse a cette question, votre jeune élève a fait appel a vous", "votre jeune élève souhaite votre avis sur cette question", "votre jeune élève a besoin de vous sur cette question"]
dialogue4A = ["je suis sur que c'est ", "je sais, il faut choisir ", "je connais bien la réponse, c'est ", "je crois que la reponse c'est "]
ruetaerc = "noshtidEsuaGofaoMouohnoF"
dialogue4B = ["c'est difficile, mais je crois que c'est entre ", "j'hesite un peut entre ", "je sais pas trop, entre ", "je suis dans le doute entre "]
dialogue5 = ["votre professeur a deja fait son choix", "le chois de votre professeur a été fais"]
dialogue6 = ["il n'a pas l'ère très sur de lui", "quoi que votre ami ait pu dire, le dernier mot vous revient"]
repliquePresentation1 = ["bienvenue dans, EduQuiz"]
repliquePresentation2 = ["sans plus tarder, commençon le jeux"]
rempliqueFinale = ["vous avez a tout moment la possibilité de rejouer"]
intro = ["Bienvenue dans, Edu Quiz, qui est une plateforme sur laquelle vous pouvez vous évaluer vous-même afin de connaitre votre niveau.", "Les règles du jeu sont simples, plus vous donnez de bonne réponse, plus votre score évolue", "Au cours du jeux, vous aurez une fois la possibilité de faire appel à un de vos professeur, de demander le vote de votre salle de classe et de demander l’aide de l’ordinateur.", "Sans plus tarder, commençons le jeu. Bonne chance à vous."]
//createur: FONHOUO MOAFO Gaus Edithson

outils = [0, 0, 0]

vie = 3
min = 0
data = [];

function getIdMatFromUrl(url) {
    const urlObj = new URL(url); // Crée un objet URL
    const idMat = urlObj.searchParams.get('id_mat'); // Récupère la valeur du paramètre 'id_mat'
    
    if (idMat !== null) {
        return idMat; // Retourne la valeur si elle existe
    }
    
    return null; // Retourne null si le paramètre n'existe pas
}

var questions

async function loadQuestions() {
    const url = window.location.href;
    const idMatValue = getIdMatFromUrl(url);
    let id_matiere;

    if (idMatValue !== null) {
        id_matiere = idMatValue;
    } else {
        alert("Aucune question trouvée; retour a la page d'accueil");
        window.location.href = '../index.php';
        return;
    }

    try {
        const response = await fetch(`http://localhost/quiz5/index.php?path=getquestion&id_mat=${id_matiere}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        const rep = await response.json();
        
        if (rep.success) {
            const questions = rep.question; // Pas besoin de JSON.stringify
            
            // Ici vous pouvez utiliser vos questions
            return questions;
        } else {
            alert('Erreur lors de la récupération des questions');
            console.log(rep.message);
        }
    } catch (error) {
        alert("Une erreur est survenue lors de la récupération des questions...");
        console.log(error);
    }
}

// Appel de la fonction
loadQuestions().then(questions => {
    if (questions) {
        data = questions;
        console.log('data = ', data);
        // Continuez votre logique ici
    }


console.log('nombre de question : '+data.length)
if (data == null || data == undefined || data == [] || data == NaN) {
    alert("Aucunes questions trouvées")
    window.location.href = '../index.php';
}
if (data.length == 0) {
    alert("Aucunes questions trouvées")
    window.location.href = '../index.php';
}
max = data.length-1
taille = 215
voix4 = 1
voix5 = 2
syntheseVocale = true
questionsDejaPoser = []
nbr = aleaUnique(min, max, questionsDejaPoser)
score = 0
utiliserOrdinateur = false
let reponseUtilisateur

function getCookie(name)
{
    const cookies = document.cookie.split('; ');
    const value = cookies
        .find(c => c.startsWith(name))
        ?.split('=')[1]
    if (value === undefined) {
        return null
    }else{
        return value
    }
}
function getCookie2(cookieName)
{
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(';');
    for (let i = 0; i < cookieArray.length; i++) {
        var c = cookieArray[i];
        while (c.charAt(0) == '') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}

    document.getElementById("commercer").addEventListener("click", function(){
        document.getElementById("accueil").style.display = "none"
        parler(intro[0], voix5)
        parler(intro[1], voix5)
        parler(intro[2], voix5)
        parler(intro[3], voix5)
        lireQuestion(data, nbr)
        setTimeout(() => {
            document.getElementById("drap").style.display = "none",
            afficherQuestions(data, nbr)
        }, 20000);
    })
    
    var x
    document.getElementById("libelle").addEventListener("click", function(){
        lireQuestion(data, nbr)
    })

        document.getElementById("Q1").addEventListener("click", function(){
            let vie_interne = vie
            reponseUtilisateur = 1
            document.getElementById("drap").style.display = "inline-block"
            speechSynthesis.cancel()
            x = continuer(data, nbr)
            if (vie_interne > vie) {
                temps = 5000
            }else{
                temps = 2000
            }
            if (x && questionsDejaPoser.length < data.length && score < 30) {
                nbr = aleaUnique(min, max, questionsDejaPoser)
                    console.log ("choix interne2 = "+nbr)
                    setTimeout(() => {
                        setTimeout(afficherQuestions(data, nbr),
                        initialisationReponses(),
                        lireQuestion(data, nbr), 2000)
                    }, temps);
            }else{
                vousAvezPerdu(score)
            }
        })
        document.getElementById("Q2").addEventListener("click", function(){
            let vie_interne = vie
            reponseUtilisateur = 2
            document.getElementById("drap").style.display = "inline-block"
            speechSynthesis.cancel()
            x = continuer(data, nbr)
            if (vie_interne > vie) {
                temps = 5000
            }else{
                temps = 2000
            }
            if (x && questionsDejaPoser.length < data.length && score < 30) {
                nbr = aleaUnique(min, max, questionsDejaPoser)
                console.log ("choix interne2 = "+nbr)
                setTimeout(() => {
                    setTimeout(afficherQuestions(data, nbr),
                    initialisationReponses(),
                    lireQuestion(data, nbr), 2000)
                }, temps);
            }else{
                vousAvezPerdu(score)
            }
        })
        document.getElementById("Q3").addEventListener("click", function(){
            let vie_interne = vie
            reponseUtilisateur = 3
            document.getElementById("drap").style.display = "inline-block"
            speechSynthesis.cancel()
            x = continuer(data, nbr)
            if (vie_interne > vie) {
                temps = 5000
            }else{
                temps = 2000
            }
            if (x && questionsDejaPoser.length < data.length && score < 30) {
                nbr = aleaUnique(min, max, questionsDejaPoser)
                console.log ("choix interne2 = "+nbr)
                setTimeout(() => {
                    setTimeout(afficherQuestions(data, nbr),
                    initialisationReponses(),
                    lireQuestion(data, nbr), 2000)
                }, temps);
            }else{
                vousAvezPerdu(score)
            }
        })
        document.getElementById("Q4").addEventListener("click", function(){
            let vie_interne = vie
            reponseUtilisateur = 4
            document.getElementById("drap").style.display = "inline-block"
            speechSynthesis.cancel()
            x = continuer(data, nbr)
            if (vie_interne > vie) {
                temps = 5000
            }else{
                temps = 2000
            }
            if (x && questionsDejaPoser.length < data.length && score < 30) {
                nbr = aleaUnique(min, max, questionsDejaPoser)
                console.log ("choix interne2 = "+nbr)
                setTimeout(() => {
                    setTimeout(afficherQuestions(data, nbr),
                    initialisationReponses(),
                    lireQuestion(data, nbr), 2000)
                }, temps);
            }else{
                vousAvezPerdu(score)
            }
        })


document.getElementById("outilSon").addEventListener("click", function(){ 
        syntheseVocale = !syntheseVocale
        if (syntheseVocale) {
            document.getElementById("outilSon").style.backgroundColor = "green"
        }else{
            document.getElementById("outilSon").style.backgroundColor = "red"
            speechSynthesis.cancel()
        }
    })
    document.getElementById("parametre").addEventListener("click", function(){
        document.getElementById("credit").style.display = "inline-block"
    })
    document.getElementById("parametreOk").addEventListener("click", function(){
        document.getElementById("credit").style.display = "none"
    })

document.getElementById("outil1").addEventListener("click", function(){
    speechSynthesis.cancel()
    if (outils[0]>=1) {
        parler(repliqueoutils[(Math.floor(Math.random()*(4-1+1))+1)], voix5)
    }else{
        coupDeFille(data, nbr, outils) 
    }
})
document.getElementById("outil2").addEventListener("click", function(){ 
    speechSynthesis.cancel()
    if (outils[1]>=1) {
        parler(repliqueoutils[(Math.floor(Math.random()*(4-1+1))+1)], voix5)
    }else{
        ordinateur(data, nbr, outils) 
    }
})
document.getElementById("outil3").addEventListener("click", function(){ 
    speechSynthesis.cancel()
    if (outils[2]>=1) {
        parler(repliqueoutils[(Math.floor(Math.random()*(4-1+1))+1)], voix5)
    }else{
        public(data, nbr, outils) 
    }
})
document.getElementById("publicOk").addEventListener("click", function(){
    document.getElementById("public").style.display = "none"
})

function afficherQuestions(params, nbr) {
    document.getElementById("libelle").innerHTML = params[nbr].intitule
    document.getElementById("Q1").innerHTML = "A- "+params[nbr].proposition_1
    document.getElementById("Q2").innerHTML = "B- "+params[nbr].proposition_2
    document.getElementById("Q3").innerHTML = "C- "+params[nbr].proposition_3
    document.getElementById("Q4").innerHTML = "D- "+params[nbr].proposition_4
    console.log(params[nbr].reponse)
    document.getElementById("drap").style.display = "none"
}

function comparaison(userAnswer, correctAnswer) {
    if (userAnswer == correctAnswer) {
        return true
    }else{
        return false
    }
}


function userAnswer() {
    return (reponseUtilisateur)
}

function continuer(data, nbr) {
    console.log ("choix interne = "+nbr)
    x = (comparaison(userAnswer(), data[nbr].reponse)) 
    bonneReponse = "Q"+(data[nbr].reponse)
    if (x==true) {
        indiceBonneReponse(userAnswer())
        taille-= 7
        console.log(taille)
        document.getElementById("barre").style.height = taille+"px"
        parler(RbonneReponse[(Math.floor(Math.random()*((RbonneReponse.length-1)-0+1))+0)], voix5)
        if (syntheseVocale) {
            const music1=new Audio('medias/son/applaudissement.mp3');
            music1.play();
        }
        score += 1
        document.getElementById("montantActuel").innerHTML = score
        return true
    }else{
        parler("c'est une mauvaise réponse", voix5)
        vie--
        document.getElementById("vie").innerHTML=vie
            if(data[nbr].reponse == 1) {
                showSpeak("vous auriez due choisir"+data[nbr].proposition_1)
                indiceBonneReponse(1)
            }if(data[nbr].reponse == 2) {
                showSpeak("vous auriez due choisir"+data[nbr].proposition_2)
                indiceBonneReponse(2)
            }if(data[nbr].reponse == 3) {
                showSpeak("vous auriez due choisir"+data[nbr].proposition_3)
                indiceBonneReponse(3)
            }if(data[nbr].reponse == 4) {
                showSpeak("vous auriez due choisir"+data[nbr].proposition_4)
                indiceBonneReponse(4)
            }
            indicationMauvaiseReponse(userAnswer())
            

        if (vie == 0) {
            return false
        }else{
            return true
        }
    }
}

function lireQuestion(data, nbr) {
    showSpeak("question")
    showSpeak(data[nbr].intitule)
    showSpeak("A!" + data[nbr].proposition_1)
    showSpeak("B!" + data[nbr].proposition_2)
    showSpeak("C!" + data[nbr].proposition_3)
    showSpeak("D!" + data[nbr].proposition_4)
}

function aleaQuestions (min, max){
    return Math.floor(Math.random()*(max-min+1))+min;
}

speechSynthesis.onvoiceschanged=function(){
	voice= window.speechSynthesis.getVoices();
}
    function showSpeak(texte) {
        if (syntheseVocale) {
            voice
            speechSynthesis.onvoiceschanged=function(){
                voice= window.speechSynthesis.getVoices();
            }
            let parle= new SpeechSynthesisUtterance(texte);
            let indexvoie=voix5;
            parle.voice=voice[indexvoie];
            speechSynthesis.speak(parle);  
        }

    }

function parler(texte, voix) {
    if (syntheseVocale) {
        voice
        speechSynthesis.onvoiceschanged=function(){
            voice= window.speechSynthesis.getVoices();
        }
        let parle= new SpeechSynthesisUtterance(texte);
        let indexvoie=voix;
        parle.voice=voice[indexvoie];
        speechSynthesis.speak(parle); 
        noshtidEsuaGofaoMouohnoF = "ruetaerc"
    }
}

function indiceBonneReponse(params) {
    document.getElementById("Q"+params).style.background = "linear-gradient(45deg,rgb(189, 252, 155),rgb(98, 243, 100))"
}

function indicationMauvaiseReponse(params) {
    document.getElementById("Q"+params).style.background = "linear-gradient(45deg,rgb(252, 155, 155),rgb(243, 98, 98))"
}

function initialisationReponses() {
    document.getElementById("Q1").style.background = "linear-gradient(135deg, #ad5bff 0%, #c3cbf4 100%"
    document.getElementById("Q2").style.background = "linear-gradient(135deg, #c3cbf4 0%, #ad5bff 100%)"
    document.getElementById("Q3").style.background = "linear-gradient(135deg, #ad5bff 0%, #c3cbf4 100%"
    document.getElementById("Q4").style.background = "linear-gradient(135deg, #c3cbf4 0%, #ad5bff 100%)"
}

function vousAvezPerdu(params) {
    setTimeout(() => {
        document.getElementById("perdu").style.display = "inline-block"
        document.getElementById("perdu").style.transition = "2s"
        parler(rempliqueFinale[(Math.floor(Math.random()*((rempliqueFinale.length-1)-0+1))+0)], voix5)
        document.getElementById("score").textContent = ("vous avez gagner un total de "+params+" pts")
        document.getElementById("score").style.color = "black"
    }, 5000);

    // document.getElementById("questions").style.display = "none"
}

function coupDeFille(data, nbr, outils) {
    parler("nous allons passé ce coup de fill à un de vos professeurs", voix5)
    setTimeout(() => {
        if (syntheseVocale) {
            const music1=new Audio('medias/son/tel.mp3');
            music1.play();
        }
    }, 2500);

    setTimeout(() => {
        parler(dialogue1[(Math.floor(Math.random()*((dialogue1.length-1)-0+1))+0)], voix5)
        parler(dialogue2[(Math.floor(Math.random()*((dialogue2.length-1)-0+1))+0)], voix4)
        parler(dialogue3[(Math.floor(Math.random()*((dialogue3.length-1)-0+1))+0)], voix5)
        parler("selon vous, quelle est la bonne reponse", voix5)
        tab2 = [data[nbr].reponse]
        do {
            var present = false
            alea = (Math.floor(Math.random()*(4-1+1))+1)
            for (let index = 0; index < tab2.length; index++) {
                if (alea == tab2[index]) {
                    present = true
                }
            }
            if (present == false) {
                tab2[tab2.length] = alea
            }
        } while (tab2.length < 2);
        choix = (Math.floor(Math.random()*(10-1+1))+1)
        let tabx = []
        for (let index = 0; index < tab2.length; index++) {
            if(tab2[index] == 1){tabx[index]="A"}
            if(tab2[index] == 2){tabx[index]="B"}
            if(tab2[index] == 3){tabx[index]="C"}
            if(tab2[index] == 4){tabx[index]="D"}
        }

        setTimeout(() => {
            parler(dialogue4A[(Math.floor(Math.random()*((dialogue4A.length-1)-0+1))+0)]+tabx[0], voix4)
            document.getElementById("Q"+tab2[0]).style.background = "linear-gradient(45deg,rgb(155, 252, 163),rgb(103, 243, 98))"
            parler(dialogue5[(Math.floor(Math.random()*((dialogue5.length-1)-1+0))+0)], voix5)
        }, 13000);
    }, 9000);

        document.getElementById("bordure1").style.backgroundColor = "red"
        outils[0] += 1
}

function ordinateur(data, nombre) {
    parler(repliqueDuCinquante[(Math.floor(Math.random()*((repliqueDuCinquante.length-1)-0+1))+0)],voix5)
    tab2 = [data[nombre].reponse]
    do {
        var present = false
        alea = (Math.floor(Math.random()*(4-1+1))+1)
        for (let index = 0; index < tab2.length; index++) {
            if (alea == tab2[index]) {
                present = true
            }
        }
        if (present == false) {
            tab2[tab2.length] = alea
        }
    } while (tab2.length < 3);
    setTimeout(() => {
        for (let index = 1; index < 3; index++) {
            document.getElementById("Q"+tab2[index]).style.background = "linear-gradient(45deg,rgb(252, 155, 155),rgb(243, 98, 98))"
        }
        document.getElementById("bordure2").style.backgroundColor = "red"
    }, 3000);
    outils[1] += 1
}

function public(data, nbr, utiliserOrdinateur){
    parler(repliqueAppelPublic[(Math.floor(Math.random()*((repliqueAppelPublic.length-1)-0+1))+0)],voix5)
    tab2 = []
    tab2[tab2.length] = [data[nbr].reponse]
    tab = []
    for (let index = 20; index <= 40; index+=10) {
        tab[tab.length] = (Math.floor(Math.random()*(index-0+1))+0)
    }
    tab[tab.length] = 100 - (tab[0]+tab[1]+tab[2])
    console.log(tab)
        
    do {
        var present = false
        alea = (Math.floor(Math.random()*(4-1+1))+1)
        for (let index = 0; index < tab2.length; index++) {
            if (alea == tab2[index]) {
                present = true
            }
        }
        if (present == false) {
            tab2[tab2.length] = alea
        }
    } while (tab2.length <= 3);
    for (let index = 0; index <= 2; index++) {
        document.getElementById("R"+tab2[index+1]).style.width = tab[index]*3+"px"
        document.getElementById("t"+tab2[index+1]).innerHTML = tab[index]+" %"
    }
    document.getElementById("R"+tab2[0]).style.width = tab[tab.length-1]*3+"px"
    document.getElementById("t"+tab2[0]).innerHTML = tab[tab.length-1]+" %"
    document.getElementById("bordure3").style.backgroundColor = "red"
    document.getElementById("public").style.display = "inline-block"
    outils[2] +=1
}


});

function aleaUnique(min, max, tab) {
    if (min <= max) {
        
        // gestionnaire d'erreur
        tableau = tab
        present = false
        function Erreur(min, max, tab) {
            v = []
            x = 0
            for (let index = min; index <= max; index++) {
                v[v.length] = index
            }
            for (let index = 0; index < v.length; index++) {
                for (let compteur = 0; compteur < tab.length; compteur++) {
                    if (v[index] == tab[compteur]) {
                        x++
                    }
                }
            }
            if (x == v.length) {
                return "positif"
            }else{
                return "negatif"
            }
        }
        var juillet22_2003
        // generateur de nombre aleatoire unique
        nbr = Math.floor(Math.random()*(max-min+1))+min;
        do {
            present = false
            for (let index = 0; index < tableau.length; index++) {
                if (nbr == tableau[index]) {
                    present = true
                }
            }
            if (present) {
                nbr = Math.floor(Math.random()*(max-min+1))+min;
            }else{
                tableau[tableau.length] = nbr
            }
        } while (present == true && Erreur(min, max, tableau) == "negatif");
        if (Erreur(min, max, tableau) == "positif" && present == true) {
            return "erreur! plus aucune valeur de disponible"
        }else{
            return nbr
        }
    }else{
        return "erreur, max < min"
    }
}