export class User {

    idUser;
    login;
    lastName;
    firstName;
    picture;
    typePwd;
    role;
    idTraining;
    

    constructor(obj) {
        this.idUser = obj.idUser;
        this.login = obj.login;
        this.lastName = obj.lastName;
        this.firstName= obj.firstName;
        this.picture = obj.picture;
        this.typePwd= obj.typePwd;
        this.role = obj.role;
        this.idTraining = obj.idTraining;
    }

    updateConnexionModal() {
        const modal = document.querySelector(this.typePwd === 1 ? '#modalConnexionTexte' : '#modalConnexionCode');
        modal.querySelector('.modal-title').textContent = this.lastName + ' ' + this.firstName;
        modal.querySelector('.input-group input').value = "";
        modal.querySelector('.input-group input').type = "password";
        modal.querySelector('.input-group button').innerHTML = "<i class='bi bi-eye'></i>";
        modal.querySelector('img').src = this.picture;
        modal.querySelector(".loginStudent").value = this.login;
    }
}