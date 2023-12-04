import { FormElement } from "./class/FormElement.js";
import { Form } from "./class/Form.js";

(function createModalPictos(category = null) {
    document.querySelector("#modal-body-pictos .row").remove();
    const divRow = document.createElement("div");
    divRow.classList.add("row", "g-3");
    pictos.forEach(picto => {
        const divImg = document.createElement("div");
        divImg.classList.add("col-3", "d-flex", "align-items-center", "justify-content-center");
        divImg.style.height = "100px";
        const img = document.createElement("img");
        img.src = "/assets/images/pictos/" + picto;
        img.classList.add("object-fit-contain", "mw-100", "mh-100", "border", "border-2", "border-black", "rounded");
        divImg.append(img);
        divRow.append(divImg);
        divImg.addEventListener("click", e => {
            form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.picto = e.currentTarget.firstChild.src.split("/").pop();
            document.querySelector("#modal-content-pictos").classList.add("d-none");
            document.querySelector("#modal-content-home img").src = "/assets/images/pictos/" + picto;
            document.querySelector("#modal-content-home").classList.remove("d-none");
        });
    });
    document.querySelector("#modal-body-pictos .container-fluid").append(divRow);
})();

document.querySelector("#bgColor").addEventListener("input", e => {
    document.querySelector("#divForm").style.backgroundColor = e.currentTarget.value;
});

const form = new Form(datas);

form.forEach((value, key) => {
    const element = value.element;

    /*
    //Ajout puis suppression des styles en hover
    element.addEventListener("mouseover", e => {
        e.currentTarget.classList.add("border", "border-primary", "border-3", "rounded");
        //const span = document.createElement("span");
        //span.classList.add("position-absolute", "z-2", "top-0", "start-100", "translate-middle", "py-1", "px-2", "text-light", "bg-primary", "rounded-circle");
        //span.innerHTML = '<i class="bi bi-pencil"></i>';
        //e.currentTarget.append(span);
    });

    element.addEventListener("mouseout", e => {
        e.currentTarget.classList.remove("border", "border-primary", "border-3", "rounded");
        //e.currentTarget.querySelector("span").remove();
    });
    */
    
    element.addEventListener("click", e => {
        //e.stopPropagation();
        //e.currentTarget.classList.remove("border", "border-primary", "border-3", "rounded");
        if(e.currentTarget.querySelector(".div-hover") !== null)
            return;   
        const docFragment = document.querySelector("#template-hover").content.cloneNode(true);
        e.currentTarget.append(docFragment);
        const divHover = e.currentTarget.querySelector(".div-hover");
        const timeout = setTimeout(() => {
            element.querySelector(".div-hover").remove();
        }, 1500);
        divHover.querySelector("button:nth-child(1)").addEventListener("click", e => {
            e.stopPropagation();
            clearTimeout(timeout);
            value.textToSpeech = !value.textToSpeech;
            value.updateDOM();
            element.querySelector(".div-hover").remove();
        }, {passive: true});
        divHover.querySelector("button:nth-child(2)").addEventListener("click", e => {
            e.stopPropagation();
            clearTimeout(timeout);
            value.active = !value.active;
            value.updateDOM();
            element.querySelector(".div-hover").remove();
        },  {passive: true});
        divHover.querySelector("button:nth-child(3)").addEventListener("click", e => {
            e.stopPropagation();
            clearTimeout(timeout);
            value.updateModal();
            element.querySelector(".div-hover").remove();
        },  {passive: true});
    }, {passive: true});
});

// button cancel
document.querySelectorAll("#btn-modal-cancel, #btn-cross-modal").forEach(btn => {
    btn.addEventListener("click", e => {
        form.get(document.querySelector("#staticBackdrop").dataset.idElement).clearTemp();
        resetModal();
    });
});

// button confirm
document.querySelector("#btn-modal-confirm").addEventListener("click", e => {
    const elem = form.get(document.querySelector("#staticBackdrop").dataset.idElement);
    elem.updateThisFromTemp();
    elem.updateDOM();
    resetModal();
})

/*####################
#      SELECTORS     #
#####################*/

// Selectors level
document.querySelectorAll(".modal-level").forEach(check => {
    check.addEventListener("click", e => {
        const level = parseInt(check.id.charAt(check.id.length - 1), 10);
        switch(level) {
            case 1:
            case 2:
                document.querySelector("#modal-body-home .row:nth-child(2) .div-img").classList.remove("d-none");
                document.querySelector("#modal-body-home .row:nth-child(2) label").classList.add("d-none");
                break;
            case 3:
                document.querySelector("#modal-body-home .row:nth-child(2) .div-img").classList.remove("d-none");
                document.querySelector("#modal-body-home .row:nth-child(2) label").classList.remove("d-none");
                break;
            case 4:
                document.querySelector("#modal-body-home .row:nth-child(2) .div-img").classList.add("d-none");
                document.querySelector("#modal-body-home .row:nth-child(2) label").classList.remove("d-none");
                break;
        }
        form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.level =  level;
    });
});

// Selector font color
document.querySelector("#modal-fontColor").addEventListener("input", e => {
    document.querySelector("#modal-body-home .row:nth-child(2) label").style.color = e.currentTarget.value;
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.fontColor =  e.currentTarget.value;
});

// Selector background color
document.querySelector("#modal-bgColor").addEventListener("input", e => {
    document.querySelector("#modal-body-home .row:nth-child(2) div").style.backgroundColor = e.currentTarget.value;
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.bgColor =  e.currentTarget.value;
});

// Selector text
document.querySelector("#modal-body-home .row:nth-child(2) input").addEventListener("input", e => {
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.text =  e.currentTarget.value;
});

// Selector font size (range)
document.querySelector("#modal-fontSizeRange").addEventListener("input", e => {
    document.querySelector("#modal-fontSizeInput").value = e.currentTarget.value;
    document.querySelector("#modal-body-home .row:nth-child(2) label").style.fontSize = e.currentTarget.value + "px";
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.fontSize = e.currentTarget.value;
});

// Selector font size (input)
document.querySelector("#modal-fontSizeInput").addEventListener("input", e => {
    document.querySelector("#modal-fontSizeRange").value = e.currentTarget.value;
    document.querySelector("#modal-body-home .row:nth-child(2) label").style.fontSize = e.currentTarget.value + "px";
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.fontSize = e.currentTarget.value;
});

// Selector font family
document.querySelector("#modal-fontFamily").addEventListener("change", e => {
    e.currentTarget.style.fontFamily = e.currentTarget.value;
    document.querySelector("#modal-body-home .row:nth-child(2) label").style.fontFamily = e.currentTarget.value;
    document.querySelector("#modal-body-home .row:nth-child(2) input").style.fontFamily = e.currentTarget.value;
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.fontFamily = e.currentTarget.value;
});

// Selector bold
document.querySelector("#modal-bold").addEventListener("input", e => {
    if(e.currentTarget.checked) {
        document.querySelector("#modal-body-home .row:nth-child(2) label").style.fontWeight = "bold"
        document.querySelector("#modal-body-home .row:nth-child(2) input").style.fontWeight = "bold";
        form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.bold = true;
    } else {
        document.querySelector("#modal-body-home .row:nth-child(2) label").style.fontWeight = "normal"
        document.querySelector("#modal-body-home .row:nth-child(2) input").style.fontWeight = "normal";
        form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.bold = false;
    }
});

// Selector italic
document.querySelector("#modal-italic").addEventListener("input", e => {
    if(e.currentTarget.checked) {
        document.querySelector("#modal-body-home .row:nth-child(2) label").style.fontStyle = "italic";
        document.querySelector("#modal-body-home .row:nth-child(2) input").style.fontStyle = "italic";
        form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.italic = true;
    } else {
        document.querySelector("#modal-body-home .row:nth-child(2) label").style.fontStyle = "normal"
        document.querySelector("#modal-body-home .row:nth-child(2) input").style.fontStyle = "normal";
        form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.italic = false;
    }
});

// Selector text to speech 
document.querySelector("#modal-tts").addEventListener("input", e => {
    if(e.currentTarget.checked) {
        const btn = document.createElement("button");
        btn.classList.add("input-group-text", "pe-none");
        const icon = document.createElement("i");
        icon.classList.add("bi", "bi-volume-up");
        btn.append(icon);
        document.querySelector("#modal-body-home .row:nth-child(2) .div-input").append(btn);
    } else {
        document.querySelector("#modal-body-home .row:nth-child(2) .div-input button").remove();
    }
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.textToSpeech =  e.currentTarget.checked;
});

// Selector modif text to speech
document.querySelector("#modal-modiftts").addEventListener("click", e => {
    e.stopPropagation();
    e.preventDefault();
    document.querySelector("#modal-content-tts textarea").value = form.get(document.querySelector("#staticBackdrop").dataset.idElement).textToSpeechT;
    document.querySelector("#modal-content-home").classList.add("d-none");
    document.querySelector("#modal-content-tts").classList.remove("d-none");
});

//Selector modif picto
document.querySelector("#modal-content-home .div-img").addEventListener("click", e => {
    document.querySelector("#modal-content-home").classList.add("d-none");
    document.querySelector("#modal-content-pictos").classList.remove("d-none");
});


/* ######################
   MODAL TEXT TO SPEECH
########################*/

document.querySelector("#modal-body-tts #div-buttons button:nth-child(1)").addEventListener("click", e => {
    document.querySelector("#modal-content-tts").classList.add("d-none");
    document.querySelector("#modal-content-home").classList.remove("d-none");
});

document.querySelector("#modal-body-tts #div-buttons button:nth-child(2)").addEventListener("click", e => {
    form.get(document.querySelector("#staticBackdrop").dataset.idElement).textToSpeechT = document.querySelector("#modal-body-tts textarea").value;
    document.querySelector("#modal-content-tts").classList.add("d-none");
    document.querySelector("#modal-content-home").classList.remove("d-none");
});

document.querySelector("#modal-body-tts div:nth-child(1) button").addEventListener("click", e => {
    const msg = new SpeechSynthesisUtterance();
    msg.voice = speechSynthesis.getVoices()[2];
    msg.text = document.querySelector("#modal-body-tts textarea").value;
    msg.lang = 'fr';
    speechSynthesis.speak(msg);
});


/*################
   MODAL PICTOS
################*/

document.querySelector("#modal-content-pictos .btn-close").addEventListener("click", e => {
    document.querySelector("#modal-content-pictos").classList.add("d-none");
    document.querySelector("#modal-content-home").classList.remove("d-none");
});




function resetModal() {
    document.querySelector("#modal-body-home .row:nth-child(2) div").remove();
    document.querySelector("#modal-body-home .row:nth-child(2)").append(
        document.querySelector("#template-modal").content.cloneNode(true)
    );
    document.querySelector("#modal-body-home .row:nth-child(2) input").addEventListener("input", e => {
        form.get(document.querySelector("#staticBackdrop").dataset.idElement).temp.text =  e.currentTarget.value;
    });
    document.querySelector("#modal-content-home .div-img").addEventListener("click", e => {
        document.querySelector("#modal-content-home").classList.add("d-none");
        document.querySelector("#modal-content-pictos").classList.remove("d-none");
    });
}


document.addEventListener("keyup", e => {
    if(!document.querySelector("#staticBackdrop").classList.contains("show") || document.querySelector("#modal-content-home").classList.contains("d-none"))
        return;
    switch(e.key) {
        case "1":
        case "2":
        case "3":
        case "4":
            document.querySelectorAll("#modal-level input").forEach(checkbox => {
                if( checkbox.id.charAt(checkbox.id.length - 1) === e.key ) {
                    checkbox.checked = true;
                    checkbox.dispatchEvent(new Event("click"));
                } else {
                    checkbox.checked = false;
                }
            });
            break;
        case "i":
        case "I":
            const checkboxItalic = document.querySelector("#modal-italic");
            checkboxItalic.checked = !checkboxItalic.checked;
            checkboxItalic.dispatchEvent(new Event("input"));
            break;
        case "b":
        case "B":
            const checkboxBold = document.querySelector("#modal-bold");
            checkboxBold.checked = !checkboxBold.checked;
            checkboxBold.dispatchEvent(new Event("input"));
            break;
        case "t":
        case "T":
            const checkboxTts = document.querySelector("#modal-tts");
            checkboxTts.checked = !checkboxTts.checked;
            checkboxTts.dispatchEvent(new Event("input"));
            break;
        case "Enter":
            document.querySelector("#btn-modal-confirm").dispatchEvent(new Event("click"));
            break;
        case "Escape":
            document.querySelector("#btn-modal-cancel").dispatchEvent(new Event("click"));
            break;
    }
});