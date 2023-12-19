export const divText = document.querySelector("#champText");
export const divCode = document.querySelector("#champCode");
export const divSchema = document.querySelector("#champSchema");

export const divErrorPwd = document.createElement("div");
divErrorPwd.classList.add("alert", "alert-danger");
divErrorPwd.role = "alert";
divErrorPwd.style.opacity = 1;
divErrorPwd.innerText = "Erreur, les deux mots de passes ne correspondent pas.";


/**
 * removes all password type divs from the DOM
 * @export
 */
export function removeAllDivPwd() { divText?.remove(); divCode?.remove(); divSchema?.remove(); }

/**
 * removes all input values of the div as parameter
 * @export
 * @param {HTMLElement} div
 */
export function resetInput(div) { div.querySelectorAll("input").forEach(input => input.value = "") }


/**
 * manages the modification of the DOM at each "change" event of the select
 * @export
 * @param {string} select
 */
export function eventChangeTypePwd(select) {
    document.querySelector(select).addEventListener('change', e => {
        removeAllDivPwd();
        switch(e.currentTarget.value) {
            case "1":
                resetInput(divText);
                e.currentTarget.parentElement.parentElement.insertAdjacentElement('afterend', divText);
                break;
            case "2":
                resetInput(divCode);
                e.currentTarget.parentElement.parentElement.insertAdjacentElement('afterend', divCode);
                break;
            case "3":
                resetInput(divSchema);
                e.currentTarget.parentElement.parentElement.insertAdjacentElement('afterend', divSchema);
                break;
        }
    });
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
 * @param {string} input
 * @param {string} img
 */
export function eventChangePicture(input, img) {
    document.querySelector(input).addEventListener("input", e => {
        const reader = new FileReader();
        reader.onload = e => document.querySelector(img).src = e.target.result;
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
 * @param {string} selectors
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