import * as helpers from "/assets/js/functions.js";
import { User } from "/assets/js/class/User.js";

//helpers.changeModalPwd("#newUser");
//helpers.initModalPwd("#newUser", 1);

helpers.changeModalPwd("#updateUserModal");
helpers.initModalPwd("#updateUserModal", 0, true)
helpers.eventChangePicture("#inputImgUserUpdate", "#imgUserUpdate");
helpers.changeModalPwd("#newUser");
helpers.initModalPwd("#newUser", 1, true);
helpers.eventChangePicture("#inputImgUserAdd", "#imgUserAdd");
helpers.removeDivFeedback(".alert");

const admins = new Map();
adminsTab.forEach(admin => {
    admins.set(admin.idUser, new User(admin));
})

document.querySelector("#btn-newUser").addEventListener("click", e => {
    const modal = document.querySelector("#newUser");
    modal.querySelector("img").src = "/assets/images/users/user.png";
    modal.querySelectorAll("input").forEach(input => {
        if(input.type !== "hidden")
            input.value = "";
    });
})

document.querySelectorAll(".btn-update-admin").forEach(btn => {
    btn.addEventListener("click", e => {
        admins.get(parseInt(e.currentTarget.dataset.id)).updateModifModal("#updateUserModal");
    });
});

document.querySelectorAll(".btn-removed").forEach(btn => {
    btn.addEventListener("click", e => {
    if(!confirm("Voulez vous vraiment supprimer cet utilisateur ?"))
        e.preventDefault();
    });
});

document.querySelector(".btn-removed-training").addEventListener("click", e => {
    if(!confirm("Voulez vous vraiment supprimer cette formation ?"))
        e.preventDefault();
});