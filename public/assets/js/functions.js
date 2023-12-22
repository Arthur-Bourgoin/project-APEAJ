export const divErrorPwd = document.createElement("div");
divErrorPwd.classList.add("alert", "alert-danger");
divErrorPwd.role = "alert";
divErrorPwd.style.opacity = 1;
divErrorPwd.innerText = "Erreur, les deux mots de passes ne correspondent pas.";

function eyeOnClick(e) {
    const input = e.currentTarget.previousElementSibling;
    if(input.type === "text") {
        input.type = "password";
        e.currentTarget.innerHTML = '<i class="bi bi-eye"></i>';
    }
    else {
        input.type = "text";
        e.currentTarget.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
}

export function initModalPwd(modal, typePwd, initEvent) {

    const divText = document.querySelector(modal + " .textField");
    const divCode = document.querySelector(modal + " .codeField");
    const divSchema = document.querySelector(modal + " .schemaField");
    if(initEvent) {
        [divText, divCode].forEach(div => {
            div.querySelectorAll("span").forEach(span => {
                span.addEventListener("click", e => eyeOnClick(e));
            });
        });
    }
    let div;
    switch(typePwd) {
        case 1:
            divCode?.remove();
            divSchema?.remove();
            div = divText;
            break;
        case 2:
            divText?.remove();
            divSchema?.remove();
            div = divCode;
            break;
        case 3:
            divText?.remove();
            divCode?.remove();
            div = divSchema;
            break;
    }
    if(typePwd !== 0) document.querySelector(modal + " .selectTypePwd").parentElement.parentElement.insertAdjacentElement('afterend', div);
}

export function changeModalPwd(modal) {

    const divText = document.querySelector(modal + " .textField");
    const divCode = document.querySelector(modal + " .codeField");
    const divSchema = document.querySelector(modal + " .schemaField");
    function removeAllDivPwd() {
        [divText, divCode, divSchema].forEach(div => {
            div.querySelectorAll("input").forEach(input => input.type = "password");
            div.querySelectorAll("span").forEach(span => span.innerHTML = '<i class="bi bi-eye"></i>');
            div?.remove();
        })
    }

    function appendAllDivPwd() {
        removeAllDivPwd();
        const inputSelect = document.querySelector(modal + " .selectTypePwd").parentElement.parentElement;
        [divText, divCode, divSchema].forEach(div => {
            inputSelect.insertAdjacentElement('afterend', div);
        });
    }

    function resetInput(div) { div.querySelectorAll("input").forEach(input => input.value = "") }

    function eventChangeTypePwd(select) {
        document.querySelector(select).addEventListener('change', e => {
            let div = null;
            removeAllDivPwd();
            switch(e.currentTarget.value) {
                case "1":
                    div = divText; break;
                case "2":
                    div = divCode; break;
                case "3":
                    div = divSchema; break;
            }
            resetInput(div);
            e.currentTarget.parentElement.parentElement.insertAdjacentElement('afterend', div);
        });
    }
    
    function eventBtnsCancel(selectors) {
        document.querySelectorAll(selectors).forEach(btn => {
            btn.addEventListener("click", e => appendAllDivPwd());
        });
    }
    eventBtnsCancel(modal + " .btn-close, " + modal + " .btn-cancel");
    eventChangeTypePwd(modal + " .selectTypePwd");
}

/**
 * checks that the two passwords match and displays an error accordingly
 * @export
 * @param {Event} event
 * @param {string} inputs
 * @param {string} modal
 */
export function verifPwdModal(event, inputs, modal) {
    const pwd = document.querySelectorAll(inputs);
    if(pwd[0].value !== pwd[1].value) {
        if(!document.querySelector(modal + " .modal-body .alert-danger")) {
            document.querySelector(modal + " .modal-body").prepend(divErrorPwd);
            setTimeout(() => {
                const interval = setInterval(() => {
                    divErrorPwd.style.opacity -= 0.01;
                    if(divErrorPwd.style.opacity <= 0) {
                        clearInterval(interval);
                        divErrorPwd.remove();
                        divErrorPwd.style.opacity = 1;
                    }
                }, 10);
            }, 5000);
        }
        event.preventDefault();
    }
}

/**
 * to manage dynamic photo change
 * @export
 * @param {string} 
 * @param {string} 
 */
export function eventChangePicture(input, img) {
    document.querySelector(input).addEventListener("input", e => {
        const reader = new FileReader();
        reader.onload = e => document.querySelector(img).src = e.target.result
        reader.addEventListener('progress', e => {
            if (e.loaded && e.total)
              console.log("Progress: " + Math.round((e.loaded / e.total) * 100));
          });    
        reader.readAsDataURL(e.currentTarget.files[0]);
    });
}  

/**
 * reduces the opacity of the feddback div until it is removed
 * @export
 * @param {string} selectors ".alert"
 */
export function removeDivFeedback(selectors) {
    const divAlert = document.querySelector(selectors);
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
}