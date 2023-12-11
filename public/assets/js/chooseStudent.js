document.querySelectorAll("#NewFormForStudent .tr-body").forEach(tr => {
    tr.addEventListener("click", e => {
        window.location.href = "/etudiants/" + 
                                tr.querySelector("td:nth-child(1)").innerText + "-" + 
                                tr.querySelector("td:nth-child(2)").innerText + "-" +
                                tr.dataset.id + "/" +
                                "creer-fiche";
    });
});