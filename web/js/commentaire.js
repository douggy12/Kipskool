$(document).ready(init);


function init(){

    getList();
    $('#addComment').click(addComment);

}
function getList() {

    $.ajax({
        url: "/comlist",
        method: "POST",
        data: {
            article: article,
            articleType: typeArticle
        }

    }).done(showList);

}
function showList(commentaires) {
    $('#commentaires_list').html('');
    $.each(commentaires, function (index, commentaire) {

        $('#commentaires_list').append('<tr><td>' + commentaire.createdAt
            + '</td><td> ' + commentaire.auteur + '</td><td>' + commentaire.texte + '</td></tr>');

    });
}
function addComment() {
    $.ajax({
        url: "/addcom",
        method: "POST",
        data: {
            texte: $('#comment').val(),
            article: article,
            articleType: typeArticle
        }

    }).done(getList())
    $('#comment').val('');
}
