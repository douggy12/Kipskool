$(document).ready(init);


function init() {

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
            comDate = new Date(commentaire.createdAt * 1000);
            comDate = comDate.getDay() + '/' + comDate.getMonth() + '/' + comDate.getFullYear() + ' ' + comDate.getHours() + ':' + comDate.getMinutes();

            if (commentaire.avatar != null) {
                avatar = '../media/cache/avatar_mini/images/avatar/' + commentaire.avatarName;
            }
            else {
                avatar = '/media/cache/avatar_mini/images/perso/avatar/chaton.jpg';
            }

            $('#commentaires_list').append(
                // '<a class="pull-left"><img src="'+ avatar +'" alt="Avatar" class="img-circle"> </a><div class="media-body"><span class="text-muted"><small><em>' + commentaire.createdAt + '</em></small></span><strong>' + commentaire.auteur + '</strong> ' + commentaire.texte + '<input type="button" id="delCom" value="Supprimer" onclick="delCom('+ commentaire.id +')"></div>'
                '<li class="media">'
                + '<a href="/perso/' + commentaire.id + '" class="pull-left">'
                + '<img src="' + avatar + '" alt="Avatar" class="img-circle">'
                + '</a>'
                + '<div class="media-body">'
                + '<a href="/perso/' + commentaire.id + '"><strong>' + commentaire.auteur + '</strong></a>'
                + '<span class="text-muted"><small><em>' + comDate + '</em></small></span>'
                + '<p>' + commentaire.texte + '</p>'
            );
            if (roleStaff) {
                $('#commentaires_list').append(
                    '<input type="button" id="delCom" value="Supprimer" onclick="delCom(' + commentaire.id + ')" class="btn btn-danger">'
                    + '</div>'
                    + '</li>');
            }


        }
    )
    ;
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

    }).done(getList());
    $('#comment').val('');
}

function delCom(id) {
    $.ajax({
        url: "/delcom",
        method: "POST",
        data: {
            commentaire: id,
            articleType: typeArticle
        }
    }).done(getList());
}
