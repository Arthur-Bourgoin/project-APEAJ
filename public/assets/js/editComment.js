function toggleEditMode(event, counter) {
    event.preventDefault();
    var commentContainer = document.getElementById('comment' + counter);
    var commentText = commentContainer.querySelector('.comment-text');
    var commentEdit = commentContainer.querySelector('.comment-edit');

    commentText.style.display = 'none'; // Cache le texte statique
    commentEdit.style.display = 'block'; // Affiche le textarea
    commentEdit.focus(); // Donne le focus au textarea
}