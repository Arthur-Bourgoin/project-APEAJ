export class FormElement {
   
    id;
    label; // OK
    text; // OK
    bold; // OK
    italic; // OK
    level;
    picto;
    fontFamily; // OK
    fontSize; // OK
    fontColor; // OK
    bgColor; // OK
    textToSpeechT; 
    textToSpeech; // OK
    active; // OK

    temp; // contains temporary values (modal)
    #element; // HTMLelement

    /**
     * Creates an instance of FormElement.
     * @param {object} obj
     * @memberof FormElement
     */
    constructor(obj) {
        for (const property in this) {
            this[property] = obj[property];
        }
        this.#element = document.querySelector("#div-" + obj.id);
        this.temp = {};
    }

    get element() {
        return this.#element;
    }

    updateDOM() {
        // Level
        switch(this.level) {
            case 1:
            case 2:
                this.#element.querySelector(".div-img").classList.remove("d-none");
                this.#element.querySelector("label").classList.add("d-none");
                break;
            case 3:
                this.#element.querySelector(".div-img").classList.remove("d-none");
                this.#element.querySelector("label").classList.remove("d-none");
                break;
            case 4:
                this.#element.querySelector(".div-img").classList.add("d-none");
                this.#element.querySelector("label").classList.remove("d-none");
                break;

        }
        // Text
        this.#element.querySelector("input").value = this.text;
        // Bold
        this.#element.querySelector("label").style.fontWeight = this.bold ? "bold" : "normal";
        this.#element.querySelector("input").style.fontWeight = this.bold ? "bold" : "normal";
        // Italic
        this.#element.querySelector("label").style.fontStyle = this.italic ? "italic" : "normal";
        this.#element.querySelector("input").style.fontStyle = this.italic ? "italic" : "normal";
        // Font size
        this.#element.querySelector("label").style.fontSize = this.fontSize + "px";
        // Font family
        this.#element.querySelector("label").style.fontFamily = this.fontFamily;
        this.#element.querySelector("input").style.fontFamily = this.fontFamily;
        // Font color
        this.#element.style.color = this.fontColor;
        // Background color
        this.#element.style.backgroundColor = this.bgColor;
        // Text to speech
        if(this.textToSpeech) {
            if(this.#element.querySelector(".div-input button") === null) {
                const btn = document.createElement("button");
                btn.classList.add("input-group-text", "pe-none");
                const icon = document.createElement("i");
                icon.classList.add("bi", "bi-volume-up");
                btn.append(icon);
                this.#element.querySelector(".div-input").append(btn);
            }
        } else {
            this.#element.querySelector(".div-input button")?.remove();
        }
        // Hidden/active element
        if(this.active) {
            this.#element.classList.remove("opacity-25");
            this.#element.classList.add("opacity-100");
        } else {
            this.#element.classList.remove("opacity-100");
            this.#element.classList.add("opacity-25");
        }
        // Images
        const img = this.#element.querySelector("img");
        img.src = "/assets/images/pictos/" + this.picto;
        img.alt = this.label;
        //this.adjustImageSize("DOM");
    }

    updateModal() {
        const modal = document.querySelector("#staticBackdrop");
        const divElem = modal.querySelector("#modal-body-home .row:nth-child(2) div");
        const label = divElem.querySelector("label");
        //label.classList.add("p-0", "pb-3");
        modal.dataset.idElement = "#div-" + this.id;
        // Level
        switch(this.level) {
            case 1:
            case 2:
                modal.querySelector("#modal-body-home .row:nth-child(2) .div-img").classList.remove("d-none");
                modal.querySelector("#modal-body-home .row:nth-child(2) label").classList.add("d-none");
                break;
            case 3:
                modal.querySelector("#modal-body-home .row:nth-child(2) .div-img").classList.remove("d-none");
                modal.querySelector("#modal-body-home .row:nth-child(2) label").classList.remove("d-none");
                break;
            case 4:
                modal.querySelector("#modal-body-home .row:nth-child(2) .div-img").classList.add("d-none");
                modal.querySelector("#modal-body-home .row:nth-child(2) label").classList.remove("d-none");
                break;
        }
        modal.querySelector("#modal-level-" + this.level).checked = true;
        // Label
        label.innerText = this.label;
        // Text
        modal.querySelector("#modal-body-home .row:nth-child(2) input").value = this.text;
        // Bold
        modal.querySelector("#modal-bold").checked = this.bold;
        label.style.fontWeight = this.bold ? "bold" : "normal";
        modal.querySelector("#modal-body-home .row:nth-child(2) input").style.fontWeight = this.bold ? "bold" : "normal";
        // Italic
        modal.querySelector("#modal-italic").checked = this.italic;
        label.style.fontStyle = this.italic ? "italic" : "normal";
        modal.querySelector("#modal-body-home .row:nth-child(2) input").style.fontStyle = this.italic ? "italic" : "normal";
        // Font family
        label.style.fontFamily = this.fontFamily;
        modal.querySelector("#modal-body-home .row:nth-child(2) input").style.fontFamily = this.fontFamily;
        modal.querySelector("#modal-fontFamily").style.fontFamily = this.fontFamily;
        Array.from(modal.querySelector("#modal-fontFamily").options).forEach(opt => {
            if(opt.value === this.fontFamily)
                opt.selected = true;
        });
        // Font size
        label.style.fontSize = this.fontSize + "px";
        modal.querySelector("#modal-fontSizeInput").value = this.fontSize;
        // Font color
        modal.querySelector("#modal-fontColor").value = toHexa(this.fontColor);
        label.style.color = toHexa(this.fontColor);
        // Background color
        modal.querySelector("#modal-bgColor").value = toHexa(this.bgColor);
        divElem.style.backgroundColor = toHexa(this.bgColor);
        // Text to speech booleen
        modal.querySelector("#modal-tts").checked = this.textToSpeech;
        if(this.textToSpeech) {
            const btn = document.createElement("button");
            btn.classList.add("input-group-text", "pe-none");
            const icon = document.createElement("i");
            icon.classList.add("bi", "bi-volume-up");
            btn.append(icon);
            divElem.querySelector(".div-input").append(btn);
        }
        // Images
        const img = document.querySelector("#modal-body-home .row:nth-child(2) img");
        img.src = "/assets/images/pictos/" + this.picto;
        img.alt = this.label;
        //this.adjustImageSize("modal");
    }

    // if click on "annuler"
    clearTemp() {
        for (const prop in this.temp)
            delete this.temp[prop];
    }

    // if click on "valider"
    updateThisFromTemp() {
        console.log(this.temp);
        for (const prop in this.temp) {
            if(prop in this)
                this[prop] = this.temp[prop];
        }
        this.clearTemp();
    }

    /**
     * @param {String} context
     * @memberof FormElement
     */
    adjustImageSize(context) {
        if(context !== "DOM" && context !== "modal")
            throw new Error("The context must be 'DOM' or 'modal'");
        const img = context === "DOM" ? this.#element.querySelector("img") : document.querySelector("#modal-body-home .row:nth-child(2) img");
        const ratioImg = img.naturalWidth / img.naturalHeight;
        console.log("img : " + img.naturalWidth, img.naturalHeight)
        const ratioDiv = img.parentElement.offsetWidth / img.parentElement.offsetHeight;
        console.log("dom : " + img.parentElement.offsetWidth, img.parentElement.offsetHeight);
        if(ratioImg > ratioDiv) {
            img.classList.remove("h-100", "w-auto");
            img.classList.add("h-auto", "w-100");
        } else {
            img.classList.remove("w-100", "h-auto");
            img.classList.add("h-100", "w-auto");
        }
    }

}

/**
 * converts a color code : rgb(255, 182, 193) --> #FFB6C1
 * @param {string} rgb
 * @return {string} 
 */
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


