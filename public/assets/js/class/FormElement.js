
export class FormElement {
    bgColor;
    tts;
    textColor

    element;

    constructor(HTMLelement) {
        this.element = HTMLelement;
        this.bgColor = "#FFFFFF";
        this.tts = false;
        this.textColor = "#000000";
    }
}