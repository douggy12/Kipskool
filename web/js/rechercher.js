/**
 * Created by dmett on 01/04/2017.
 */
var timer = null;

$("#rechercher").keypress(function () {

    clearTimeout(timer);
    if($('#rechercher').val() != ''){

        timer = setTimeout(function() {rechercher($("#rechercher").val());},800)
    }
});


function rechercher(motcle){
    $.ajax({
        url: '/rechercher',
        method: "POST",
        data: {
            motcle: motcle
        }

    }).done(afficher)
}

function afficher(resultats){
    $('#listeResultat').html('');
    if (resultats != ''){
        $.each(resultats, function (index, resultat) {

            if (resultat.avatar != '') {
                avatar = '../media/cache/avatar_mini2/images/avatar/' + resultat.avatar;
            }
            else {
                avatar = '/media/cache/avatar_mini2/images/perso/avatar/chaton.jpg';
            }

            $('#listeResultat').append(
                // '<li><a href="'+ resultat.link +'">'+ resultat.prenom + ' ' + resultat.nom +'</a></li>'
                '<li>'
                    +'<a href="'+ resultat.link +'">'
                        +'<img src="'+ avatar +'" alt="image" class="nav-users-avatar">'
                            +'<span class="nav-users-heading">'+ resultat.prenom + ' ' + resultat.nom +'</span>'
                            +'<span class="text-muted">'+ resultat.promo +'</span>'
                    +'</a>'
                +'</li>'
            )
        })
    }
    else {
        $('#listeResultat').append('<li>pas de résultat</li>')
    }
}

