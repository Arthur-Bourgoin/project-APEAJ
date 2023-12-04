document.addEventListener("DOMContentLoaded", function() {
    let emojiContainer = document.querySelector('[data-note]');
    
    if (emojiContainer !== null) {
        let note = emojiContainer.getAttribute('data-note');
        let emojis = emojiContainer.querySelectorAll('.emoji');

        emojis.forEach((emoji, index) => {
            emoji.classList.remove('text-danger', 'text-warning', 'text-info', 'text-success', 'text-success-emphasis');
            emoji.classList.add('text-muted'); // Applique une couleur grise par défaut

            emoji.addEventListener('click', function() {
                resetEmojis(emojis); // Réinitialise les emojis avant d'appliquer la nouvelle couleur

                switch (index + 1) {
                    case 1:
                        emojis[0].classList.remove('text-muted','bi-emoji-angry');
                        emojis[0].classList.add('bi-emoji-angry-fill', 'text-danger'); // Rouge pour la note 1 avec la classe -fill
                        break;
                    case 2:
                        emojis[1].classList.remove('text-muted','bi-emoji-frown');
                        emojis[1].classList.add('bi-emoji-frown-fill', 'text-warning'); // Jaune pour la note 2 avec la classe -fill
                        break;
                    case 3:
                        emojis[2].classList.remove('text-muted','bi-emoji-neutral');
                        emojis[2].classList.add('bi-emoji-neutral-fill', 'text-info'); // Gris pour la note 3 avec la classe -fill
                        break;
                    case 4:
                        emojis[3].classList.remove('text-muted','bi-emoji-smile');
                        emojis[3].classList.add('bi-emoji-smile-fill', 'text-success'); // Bleu pour la note 4 avec la classe -fill
                        break;
                    case 5:
                        emojis[4].classList.remove('text-muted','bi-emoji-laughing');
                        emojis[4].classList.add('bi-emoji-laughing-fill', 'text-success-emphasis'); // Vert pour la note 5 avec la classe -fill
                        break;
                    default:
                        // Aucune classe par défaut
                }
            });
        });

        // Initialisation pour la note donnée au chargement de la page
        switch (note) {
            case '1':
                emojis[0].click();
                break;
            case '2':
                emojis[1].click();
                break;
            case '3':
                emojis[2].click();
                break;
            case '4':
                emojis[3].click();
                break;
            case '5':
                emojis[4].click();
                break;
            default:
                // Aucune action par défaut
        }
    }
});

function resetEmojis(emojis) {
    emojis.forEach((emoji, index) => {
        emoji.classList.remove('bi-emoji-angry-fill', 'bi-emoji-frown-fill', 'bi-emoji-neutral-fill', 'bi-emoji-smile-fill', 'bi-emoji-laughing-fill', 'text-danger', 'text-warning','text-info', 'text-success','text-success-emphasis');
        emoji.classList.add('text-muted');

        switch (index) {
            case 0:
                emoji.classList.add('bi-emoji-angry');
                break;
            case 1:
                emoji.classList.add('bi-emoji-frown');
                break;
            case 2:
                emoji.classList.add('bi-emoji-neutral');
                break;
            case 3:
                emoji.classList.add('bi-emoji-smile');
                break;
            case 4:
                emoji.classList.add('bi-emoji-laughing');
                break;
            default:
                // Aucune action par défaut
        }
    });
}
