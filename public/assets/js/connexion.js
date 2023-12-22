import { User } from "./class/User.js";

const divAlert = document.querySelector(".alert");
if(divAlert) {
    setTimeout(() => {
        divAlert.style.opacity = 1;
        const interval = setInterval(() => {
            divAlert.style.opacity -= 0.01;
            if(divAlert.style.opacity <= 0) {
                clearInterval(interval);
                divAlert.remove();
            }
        }, 10);
    }, 5000);
}

document.querySelector("#btn-admin").addEventListener("click", e => {
    visibleDivAdmin(null);
    document.querySelector("#loginAdmin").value="";
    document.querySelector('#modalConnexionAdmin img').src =  '/assets/images/users/user.png';
    document.querySelectorAll("#modalConnexionAdmin .divChange .input-group input").forEach(input => {
        input.type = "password";
        input.value = "";
        input.name = "";
        input.nextElementSibling.innerHTML = "<i class='bi bi-eye'></i>";
    });
});

document.querySelectorAll('.btn-number').forEach(btn => {
    btn.addEventListener('click', e => {
        btn.closest("form").querySelector(".login-code").value += btn.textContent;
    });
});

document.querySelectorAll(".btn-show").forEach(btn => {
    btn.addEventListener("click", e => {
        const input = e.currentTarget.previousElementSibling;
        if(input.type === "text") {
            input.type = "password";
            e.currentTarget.innerHTML = "<i class='bi bi-eye'></i>";
        } else {
            input.type = "text";
            e.currentTarget.innerHTML = "<i class='bi bi-eye-slash'></i>"
        }
    });
});

document.querySelectorAll(".btn-eraser").forEach(btn => {
    btn.addEventListener("click",e => {
        e.currentTarget.closest("form").querySelector(".login-code").value = ""; 
    });
});




const students = new Map();
studentsTab.forEach(student => {
    students.set(student.idUser, new User(student));
});
document.querySelectorAll(".divStudent").forEach(card => {
    card.addEventListener("click", e => {
        console.log(students.get(parseInt(e.currentTarget.dataset.id)));
        students.get(parseInt(e.currentTarget.dataset.id)).updateConnexionModal();
    });
});

const admins = new Map();
adminsTab.forEach(admin => {
    admins.set(admin.login, new User(admin));
});

document.querySelector("#loginAdmin").addEventListener("input", e => {
    let admin = admins.get(e.currentTarget.value);
    if(admin) {
        document.querySelector('#modalConnexionAdmin img').src = admin.picture;
        switch(admin.typePwd) {
            case 1:
                visibleDivAdmin(".divAdminText");
                break;
            case 2:
                visibleDivAdmin(".divAdminCode");
                break;
            case 3:
                break;
        }
    } else {
        visibleDivAdmin(null);
        document.querySelector('#modalConnexionAdmin img').src =  '/assets/images/users/user.png';
    }
});

function visibleDivAdmin(classDiv) {
    document.querySelectorAll(".divChange").forEach(div => {
        div.classList.add("d-none");
        div.querySelector("div:nth-child(1) input").name = "";
    });
    if(classDiv === null)
        return;
    document.querySelector(classDiv).classList.remove("d-none");
    document.querySelector(classDiv + " div:nth-child(1) input").name = "inputPwd";
}