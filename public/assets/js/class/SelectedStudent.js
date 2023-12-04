export class SelectedStudent {

    /**
     * Creates an instance of SelectedStudent.
     * @param {String} login
     * @param {String} lastName
     * @param {String} name
     * @param {string} picture
     * @param {String} typeMDP
     * @memberof SelectedStudent
     */
    constructor(login,lastName,name,picture,typeMDP) {
        this._login = login;
        this._lastName = lastName;
        this._name=name;
        this._picture = picture;
        this._typeMDP=typeMDP;
        console.log(typeMDP);
    }
    
    get id(){
        return this._id;
    }
    set id(value){
        this._id=value;
    }

    get login(){
        return this._login;
    }
    set login(value){
        this._login=value;
    }
    get lastName(){
        return this._lastName;
    }
    set lastName(value){
        this._lastName=value;
    }
    get name(){
        return this._name;
    }
    set name(value){
        this._name=value;
    }
    get picture(){
        return this._picture;
    }
    set picture(value){
        this._picture=value;
    }
    get typeMDP(){
        return this._typeMDP;
    }
    set typeMDP(value){
        this._typeMDP=value;
    }
}