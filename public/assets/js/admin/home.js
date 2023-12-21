import * as helpers from '/assets/js/functions.js';
import {User} from "../class/User.js";


const students = new Map();
studentsTab.forEach( student => {
    students.set(student.idUser , new User(student));
});

document.querySelectorAll(".button-update").forEach(btn => {
    btn.addEventListener("click", e => {
        e.stopPropagation();
        students.get(parseInt(e.currentTarget.dataset.id)).updateModifModal('#ModalModifie');
    });
});

helpers.eventChangePicture("#inputImgUser", "#imgUser");
helpers.removeDivFeedback(".alert");
helpers.changeModalPwd("#ModalModifie");
helpers.initModalPwd("#ModalModifie", 0, true);
document.querySelector('#ModalModifie form').addEventListener('submit', e => helpers.verifPwdModal(e, ".input-pwd", "#ModalModifie"));

