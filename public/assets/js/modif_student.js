
    var selectedValue = document.getElementById('passwdSelect').value;
    // Masquer tous les champs
    var champs = document.getElementsByClassName('champ');
    for (var i = 0; i < champs.length; i++) {
        champs[i].style.display = 'none';
    }

    // Afficher le champ correspondant au type de mot de passe sélectionné par défaut
    var champToShow = document.getElementById('champ' + selectedValue.charAt(0).toUpperCase() + selectedValue.slice(1));
    if (champToShow) {
        champToShow.style.display = 'inline';
    }


document.getElementById('passwdSelect').addEventListener('change', function() {
    var selectedValue = this.value;

    // Masquer tous les champs
    var champs = document.getElementsByClassName('champ');
    for (var i = 0; i < champs.length; i++) {
        champs[i].style.display = 'none';
    }
    
    // Réinitialiser les champs de mot de passe et de code
    document.getElementById("FormPasswd").value = ""; // Champ mot de passe
    document.getElementById("FormPasswdConfirm").value = ""; // Champ vérification mot de passe
    document.getElementById("codeField").value = ""; // Champ code
    document.getElementById("codeFieldConfirm").value = ""; // Champ vérification code
    document.getElementById("errorMessage").innerText = "";

    // Afficher le champ correspondant au type de mot de passe sélectionné
    var champToShow = document.getElementById('champ' + selectedValue.charAt(0).toUpperCase() + selectedValue.slice(1));
    if (champToShow) {
        champToShow.style.display = 'inline';
    }
});
// Sélection de l'élément du champ de code
var codeField = document.getElementById('codeField');

// Ajout d'un événement de saisie pour contrôler la longueur et le type de caractères
codeField.addEventListener('input', function() {
    var codeValue = this.value;

    // Si la longueur dépasse 6 chiffres, réduire le champ à 6 chiffres
    if (codeValue.length > 6) {
        this.value = codeValue.slice(0, 6);
    }

    // Vérification si la saisie contient des caractères non numériques
    if (!/^\d*$/.test(codeValue)) {
        this.value = codeValue.replace(/\D/g, '');
    }
});
codeFieldConfirm.addEventListener('input', function() {
    var codeValue = this.value;

    // Si la longueur dépasse 6 chiffres, réduire le champ à 6 chiffres
    if (codeValue.length > 6) {
        this.value = codeValue.slice(0, 6);
    }

    // Vérification si la saisie contient des caractères non numériques
    if (!/^\d*$/.test(codeValue)) {
        this.value = codeValue.replace(/\D/g, '');
    }
});

function validateForm() {
    var password = document.getElementById("FormPasswd").value;
    var confirmPassword = document.getElementById("FormPasswdConfirm").value;
    var code = document.getElementById("codeField").value;
    var confirmCode = document.getElementById("codeFieldConfirm").value;

    // Vérification des mots de passe
    if (password !== confirmPassword) {
        document.getElementById("errorMessage").innerText = "Les mots de passe ne correspondent pas.";
        return false;
    }

    // Vérification des codes
    if (code !== confirmCode) {
        document.getElementById("errorMessage").innerText = "Les codes ne correspondent pas.";
        return false;
    }

    // Si tout est correct, le formulaire est envoyé
    return true;
}
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêcher la soumission du formulaire
    // Validation du formulaire
    if (!validateForm()) {
    } else {
        // Validation réussie - soumettre le formulaire
        this.submit();
       
    }
})