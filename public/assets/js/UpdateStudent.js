const divText = document.querySelector("#champText");
const divCode = document.querySelector("#champCode");
const divSchema = document.querySelector("#champSchema");

removeAllDivPwd();

function removeAllDivPwd() {
    divText?.remove();
    divCode?.remove();
    divSchema?.remove();
}

function resetInput(div) {
    div.querySelectorAll("input").forEach(input => input.value = "");
}


// Pour afficher l'élément correspondant à la sélection
document.querySelector('#passwdSelect').addEventListener('change', e => {
    removeAllDivPwd();
    switch(e.currentTarget.value) {
        case "1":
            resetInput(divText);
            e.currentTarget.parentElement.insertAdjacentElement('afterend', divText);
            break;
        case "2":
            resetInput(divCode);
            e.currentTarget.parentElement.insertAdjacentElement('afterend', divCode);
            break;
        case "3":
            resetInput(divSchema);
            e.currentTarget.parentElement.insertAdjacentElement('afterend', divSchema);
            break;
    }
});

// Pour valider le formulaire avant envoi
function validateForm() {
    const pwd = document.querySelectorAll(".champ");
    if(pwd[0] !== pwd[1]) {
        document.querySelector("#errorMessage").innerText = "Les deux mots de passe ne correspondent pas";
        return false;
    }
    return true;
}

// Gestion de la soumission du formulaire
document.querySelector('form').addEventListener('submit', e => !validateForm() ? e.preventDefault() : null);
