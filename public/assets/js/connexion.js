import { SelectedStudent } from "./class/SelectedStudent.js";


const cards = document.querySelectorAll('.card');
let selectedStudent = {};
cards.forEach(card => {
    card.addEventListener('click', function() {
        let student = new SelectedStudent(
            card.getAttribute('data-login-etu'),
            card.querySelector('.card-title').textContent,
            card.querySelector('.card-text').textContent,
            card.querySelector('img').src,
            card.getAttribute('data-typemdp'))
        if (student.typeMDP === 'texte') {
            const modalTexte = document.getElementById('modalConnexionTexte');
            modalTexte.querySelector('.modal-title').textContent =student.lastName+' '+student.name;
            modalTexte.querySelector('#mdpTexte').value="";
            const studentPicture = modalTexte.querySelector('#etudiantPhoto');
            studentPicture.setAttribute('src', student.picture);
        }else if (student.typeMDP === 'code') {
            const modalCode = document.getElementById('modalConnexionCode');
            clearCode();
            modalCode.querySelector('.modal-title').textContent =student.lastName+' '+student.name;
            const studentPictureCode = modalCode.querySelector('#etudiantPhotoCode');
            studentPictureCode.setAttribute('src', student.picture);
        }
    });
});

//Vider les champs de la connexion admin
const btn_admin = document.querySelector('#btn-admin');
btn_admin.addEventListener('click',function(){
    const modalAdmin = document.querySelector('#modalConnexionAdmin');
    modalAdmin.querySelector("#loginAdmin").value="";
    modalAdmin.querySelector("#mdpAdmin").value="";
});

// Fonction pour ajouter un digit au mdp
function appendDigit(digit) {
    const codeNumerique = document.getElementById('codeNumerique');
    if (codeNumerique.value.length + digit.length <= 6) {
        // Ajouter le chiffre à la fin de la valeur actuelle
        codeNumerique.value += digit;
    }
}
// Ajoutez un gestionnaire de clic à chaque bouton chiffre
const buttons = document.querySelectorAll('.btn-chiffre');
buttons.forEach(button => {
    button.addEventListener('click', function() {
        const digit = button.textContent;
        appendDigit(digit);
    });
});


// Regarder le mot de passe
function lookPassword(buttonId, passwordType) {
    let eye = document.getElementById(buttonId);
    let password = document.getElementById(passwordType);

    eye.onclick = function () {
        if (password.type == "password") {
            password.type = "text";
            eye.innerHTML = '<i class="bi bi-eye-slash"></i>';
        } else {
            password.type = "password";
            eye.innerHTML = '<i class="bi bi-eye"></i>';
        }
    };
}

// Appliquer la fonction à chaque modal
lookPassword("btn-show-text", "mdpTexte");
lookPassword("btn-show-code", "codeNumerique");
lookPassword("btn-show-admin", "mdpAdmin");


// Supprimer le mdp saisi pour le moment
function clearCode(){
    const codeNumerique = document.querySelector('#codeNumerique');
    codeNumerique.value ="";
}
const buttonsClear = document.querySelectorAll('.btn-clear');
buttonsClear.forEach(button => {
    button.addEventListener('click', function() {
        clearCode();
    });
});
