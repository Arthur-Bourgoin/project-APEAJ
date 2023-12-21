import * as helpers from '/assets/js/functions.js';

helpers.eventChangePicture("#inputImgUser", "#imgUser");
helpers.removeDivFeedback(".alert");
helpers.changeModalPwd("#ModalModifie");
helpers.initModalPwd('#ModalModifie', parseInt(document.querySelector('#ModalModifie').dataset.typePwd), true);
document.querySelector('#ModalModifie form').addEventListener('submit', e => helpers.verifPwdModal(e, ".input-pwd", "#ModalModifie"));