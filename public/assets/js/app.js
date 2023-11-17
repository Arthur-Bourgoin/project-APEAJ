import { FormElement } from "./class/FormElement.js";

document.querySelector("#bgColor").addEventListener("input", e => {
    document.querySelector("#divForm").style.backgroundColor = e.currentTarget.value;
})

//HashMap qui contient tous les champs du formulaire (voir class FormElement)
const map = new Map();
map.set("div-studentLastName", 
    new FormElement(document.querySelector("#div-studentLastName")));
map.set("div-studentFirstName", 
    new FormElement(document.querySelector("#div-studentFirstName")));

map.forEach((value, key, map) => {
    const element = value.element;

    //Ajout puis suppression des styles en hover
    element.addEventListener("mouseover", e => {
        e.currentTarget.classList.add("border", "border-primary", "border-3", "rounded");
        const span = document.createElement("span");
        span.classList.add("position-absolute", "z-2", "top-0", "start-100", "translate-middle", "py-1", "px-2", "text-light", "bg-primary", "rounded-circle");
        span.innerHTML = '<i class="bi bi-pencil"></i>';
        e.currentTarget.append(span);
    });

    element.addEventListener("mouseout", e => {
        e.currentTarget.classList.remove("border", "border-primary", "border-3", "rounded");
        e.currentTarget.querySelector("span").remove();
    });

    element.addEventListener("click", e => {  
        //e.stopPropagation();      
        const label = e.currentTarget.querySelector("label").cloneNode(true);
        label.classList.add("p-0", "pb-3");
        label.setAttribute("for", "currentInput");
        const input = e.currentTarget.querySelector("input").cloneNode(true);
        input.classList.remove("pe-none");
        input.setAttribute("id", "currentInput");
        const modal = document.querySelector("#staticBackdrop");
        //stockage de l'id pour pouvoir récupérer l'élément après
        modal.dataset.idElement = key;
        const divElement = document.querySelector(".modal-body .row:nth-child(2) div");
        divElement.append(label);
        divElement.append(input);
        modal.querySelector("#modal-textColor").value = toHexa(value.textColor);
        label.style.color = toHexa(value.textColor);
        console.log("txt" + value.textColor + toHexa(value.textColor));
        modal.querySelector("#modal-tts").checked = value.tts;
        modal.querySelector("#modal-bgColor").value = toHexa(value.bgColor);
        divElement.style.backgroundColor = toHexa(value.bgColor);
        console.log("bg" + value.bgColor + toHexa(value.bgColor));
    })
});

//bouton annuler
document.querySelector(".modal-footer button:nth-child(1)").addEventListener("click", e => {
    document.querySelector(".modal-body .row:nth-child(2) div").innerHTML = "";
})

document.querySelector("#btn-cross-modal").addEventListener("click", e => {
    document.querySelector(".modal-body .row:nth-child(2) div").innerHTML = "";
})

//bouton valider
document.querySelector(".modal-footer button:nth-child(2)").addEventListener("click", e => {
    const modal = document.querySelector("#staticBackdrop");
    //on récupère l'élément de la fiche que l'on a finit de traité
    const formElement = map.get(modal.dataset.idElement);
    formElement.textColor = modal.querySelector(".modal-body .row:nth-child(2) label").style.color;
    formElement.bgColor = modal.querySelector(".modal-body .row:nth-child(2) div").style.backgroundColor;
    //on met à jour le style de l'élément avec les nouvelles valeurs
    formElement.element.style.backgroundColor = formElement.bgColor;
    formElement.element.querySelector("label").style.color = formElement.textColor;
    document.querySelector(".modal-body .row:nth-child(2) div").innerHTML = "";
})

/*###################
#   LES SELECTEURS  #
###################*/

document.querySelector("#modal-textColor").addEventListener("input", e => {
    const label = document.querySelector(".modal-body .row:nth-child(2) label");
    label.style.color = e.currentTarget.value;
});

document.querySelector("#modal-bgColor").addEventListener("input", e => {
    const div = document.querySelector(".modal-body .row:nth-child(2) div");
    div.style.backgroundColor = e.currentTarget.value;
});


//convertir un code couleur : rgb(255, 182, 193) --> #FFB6C1
function toHexa(rgb) {
    if(rgb[0] === "#") {
        return rgb;
    }
    const matches = rgb.match(/\d+/g);
    const r = parseInt(matches[0], 10).toString(16).padStart(2, '0');
    const g = parseInt(matches[1], 10).toString(16).padStart(2, '0');
    const b = parseInt(matches[2], 10).toString(16).padStart(2, '0');
    return `#${r}${g}${b}`;
}