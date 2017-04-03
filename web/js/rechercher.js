/**
 * Created by dmett on 01/04/2017.
 */
var timer = null;

$("#rechercher").keyup(function () {

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
            $('#listeResultat').append(
                '<li><a href="'+ resultat.link +'">'+ resultat.prenom + ' ' + resultat.nom +'</a></li>'
            )
        })
    }
    else {
        $('#listeResultat').append('<li>pas de résultat</li>')
    }
}

