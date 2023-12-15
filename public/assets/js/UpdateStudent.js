// Pour cacher tous les éléments .champ au début
const divText
const divCode
const divSchema


function resetInput(div) {
    div.querySelectorAll("input").foreach(input => {
        input.value = "";
    });
}

(function removeAllDivPwd() {
    divText.remove();
    divCode.remove();
    divSchema.remove();
})();

/*
let champs = document.querySelectorAll('#champTexte,#champSchéma,#champCode');
champs.forEach(function(champ) {
    champ.classList.add("d-none");
});
*/

var selectedValue = document.querySelector('#passwdSelect').value;

var champToShow = document.querySelector('#champ' + selectedValue);
if (champToShow) {
    champToShow.style.display = 'block'; 
    var passwordField = document.querySelector("#FormPasswd");
    var codeField = document.querySelector("#codeField");

    if (selectedValue === 'Texte') { // Si le type texte est sélectionné initialement
        passwordField.name = 'pwd';
        codeField.name = '';
    } else if (selectedValue === 'Code') { // Si le type code est sélectionné initialement
        passwordField.name = '';
        codeField.name = 'pwd';
    } 
}


// Pour afficher l'élément correspondant à la sélection
document.querySelector('#passwdSelect').addEventListener('change', function() {
    removeAllDivPwd();
    switch(e.currentTarget.value) {
        case 1:
            resetInput(divText);
            e.currentTarget.insertAdjacentElement('afterend', divText);
            break;
        case 2:
        case 3:

    }

    var selectedValue = this.value;

    champs.forEach(function(champ) {
        champ.classList.add("d-none");
    });

    var champToShow = document.querySelector('#champ' + selectedValue);
    if (champToShow) {
        champToShow.style.display = 'block'; 
    }
    // Pour réinitialiser les champs et le message d'erreur
    document.querySelectorAll("#FormPasswd, #FormPasswdConfirm, #codeField, #codeFieldConfirm, #errorMessage").forEach(function(field) {
        field.value = '';
        if (field.id === 'errorMessage') {
            field.innerText = '';
        }
        field.name='';
    });
    var passwordField = document.querySelector("#FormPasswd");
    var codeField = document.querySelector("#codeField");

    if (selectedValue === 'Texte') { // Si le type texte est sélectionné
        passwordField.name = 'pwd';
        codeField.name = '';
    } else if (selectedValue === 'Code') { // Si le type code est sélectionné
        passwordField.name = '';
        codeField.name = 'pwd';
    } 
});
// Pour contrôler la longueur et le type de caractères du champ de code
var codeFields = document.querySelectorAll('#codeField, #codeFieldConfirm');
codeFields.forEach(function(codeField) {
    codeField.addEventListener('input', function() {
        var codeValue = this.value;

        if (codeValue.length > 6) {
            this.value = codeValue.slice(0, 6);
        }

        if (!/^\d*$/.test(codeValue)) {
            this.value = codeValue.replace(/\D/g, '');
        }
    });
});

// Pour valider le formulaire avant envoi
function validateForm() {
    var password = document.querySelector("#FormPasswd").value;
    var confirmPassword = document.querySelector("#FormPasswdConfirm").value;
    var code = document.querySelector("#codeField").value;
    var confirmCode = document.querySelector("#codeFieldConfirm").value;
    var errorMessage = document.querySelector("#errorMessage");

    if (password !== confirmPassword) {
        errorMessage.innerText = "Les mots de passe ne correspondent pas.";
        return false;
    }

    if (code !== confirmCode) {
        errorMessage.innerText = "Les codes ne correspondent pas.";
        return false;
    }

    return true;
}
// Gestion de la soumission du formulaire
document.querySelector('form').addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});
