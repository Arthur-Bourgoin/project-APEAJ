import * as helpers from '/assets/js/functions.js';

helpers.eventChangePicture("#inputImgCurrentUser", "#imgCurrentUser");
helpers.changeModalPwd("#profileConsultation");
helpers.initModalPwd("#profileConsultation", parseInt(document.querySelector("#profileConsultation .selectTypePwd").value),true);
document.querySelector('#profileConsultation form').addEventListener('submit', e => helpers.verifPwdModal(e, ".input-pwd", "#profileConsultation"));