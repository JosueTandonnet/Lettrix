import { dictionary_list } from '../JS/words.js'

let nbTentatives = 0;  
let randomW = "";
let wordLength = 0;
let motEntre = "";

function creerNouvelleLigne() {
    const grille = document.getElementById("grille");
    const ligne = document.createElement("div");
    ligne.className = "ligne";

    for (let i = 0; i < wordLength; i++) {
        const input = document.createElement("input");
        input.type = "text";
        input.maxLength = 1;
        input.className = "case-input";

        // Auto-focus sur la prochaine case
        input.addEventListener("input", function () {
            if (input.value.length === 1) {
                const next = input.nextElementSibling;
                if (next && next.tagName.toLowerCase() === "input") {
                    next.focus();
                }
            }
        });

        // Gestion du déplacement avec flèches et backspace
        input.addEventListener("keydown", function (e) {
            const inputs = ligne.querySelectorAll("input");
            const index = Array.from(inputs).indexOf(input);

            if (e.key === "ArrowLeft" && index > 0) {
                inputs[index - 1].focus();
            } else if (e.key === "ArrowRight" && index < wordLength - 1) {
                inputs[index + 1].focus();
            } else if (e.key === "Backspace" && input.value === "" && index > 0) {
                inputs[index - 1].focus();
            }
        });

        ligne.appendChild(input);
    }

    const bouton = document.createElement("button");
    bouton.textContent = "Valider";
    bouton.className = "btn-valider";

    bouton.addEventListener("click", validerMot);

    ligne.appendChild(bouton);
    grille.appendChild(ligne);
}

function startGame(modeJeu) {
    const liste = dictionary_list[modeJeu];
    console.log(modeJeu);

    const indW = Math.floor(Math.random() * liste.length);
    randomW = liste[indW];

    wordLength = randomW.length;

    creerNouvelleLigne();
}

function verifierMot(motE, motA) {
    const lignes = document.querySelectorAll(".ligne");
    const derniereLigne = lignes[lignes.length - 1];
    const inputs = derniereLigne.querySelectorAll("input");

    const lettresTrouveesMotA = Array(motA.length).fill(false);
    const lettresTrouveesMotE = Array(motE.length).fill(false);

    // Désactiver les inputs (dernière ligne bloquée)
    inputs.forEach(input => input.disabled = true);
    
    // Désactiver le bouton Valider (dernière ligne bloquée)
    const bouton = derniereLigne.querySelector('button');
    if (bouton) {
        bouton.disabled = true;
    }


    // Étape 1 : lettres bien placées
    for (let i = 0; i < motA.length; i++) {
        if (motE[i] === motA[i]) {
            inputs[i].classList.add("green");
            lettresTrouveesMotA[i] = true;
            lettresTrouveesMotE[i] = true;
        }
    }

    // Étape 2 : lettres mal placées
    for (let i = 0; i < motA.length; i++) {
        if (!lettresTrouveesMotE[i]) {
            for (let j = 0; j < motA.length; j++) {
                if (!lettresTrouveesMotA[j] && motE[i] === motA[j]) {
                    inputs[i].classList.add("yellow");
                    lettresTrouveesMotA[j] = true;
                    lettresTrouveesMotE[i] = true;
                    break;
                }
            }
        }
    }

    // Étape 3 : lettres absentes
    for (let i = 0; i < motA.length; i++) {
        if (!inputs[i].classList.contains("green") && !inputs[i].classList.contains("yellow")) {
            inputs[i].classList.add("red");
        }
    }

    // Vérification victoire
    const motTrouve = [...inputs].every(input => input.classList.contains("green"));
    if (motTrouve) {
        alert("Bravo ! Tu as trouvé le mot !");
        location.reload();
    }
}

function validerMot() {
    motEntre = "";
    const lignes = document.querySelectorAll(".ligne");
    const derniereLigne = lignes[lignes.length - 1];
    const inputs = derniereLigne.querySelectorAll("input");

    inputs.forEach(input => motEntre += input.value.toUpperCase());

    if(motEntre.length != randomW.length) { 
        alert("Tu dois remplir toutes les cases !");
        return;
    }
    
    if(/^[a-zA-ZàâäéèêëïîôöùûüçÿœæÀÂÄÉÈÊËÏÎÔÖÙÛÜÇŸŒÆ]+$/.test(motEntre)) {
        nbTentatives++;
        if (nbTentatives >= 6) {
            alert("Perdu ! Le mot était : " + randomW);
            location.reload();
        } else {
            verifierMot(motEntre, randomW);
            creerNouvelleLigne();
        }
    } 
    else {
        alert("Les cases requièrent uniquement des lettres !");
    }
}

const btn = document.getElementById("validerBtn");
if (btn) {
    btn.addEventListener("click", function () {
        const modeJeu = document.getElementById("niveau").value;
        window.location.href = "lancerJeu.php?mode=" + modeJeu;
    });
}

document.addEventListener("DOMContentLoaded", () => {
    startGame(modeJeu);
});