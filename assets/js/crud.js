function affiche(id) {

    let titrecrud2 = document.getElementById("titrecrud2" + id);
    let infocrud = document.getElementById("infocrud" + id);

    // console.log(titrecrud2);
    // console.log(infocrud.style.display)
        
        if (infocrud.style.display != "none") {
            console.log(infocrud.style.display)
            infocrud.style.display = "none";
        } else {
            infocrud.style.display = "block";
        }

}


$(document).ready(function(){

    $('.modifprojetcrud').submit(function(ee)
    {

        ee.preventDefault();

        let valeur = this.dataset.value; // ici c'est la valeur de mon id
        console.log("valeur");
        console.log(valeur);

    var nomprojet = document.getElementById("nomprojet"+valeur).value;
    var clientprojet = document.getElementById("clientprojet"+valeur).value;
    var descriptionprojet = document.getElementById("descriptionprojet"+valeur).value;
    var liensite = document.getElementById("liensite"+valeur).value;
    var liengithub = document.getElementById("liengithub"+valeur).value;
    var datecreation = document.getElementById("datecreation"+valeur).value;
    var createur = document.getElementById("createur"+valeur).value;

    let form_data = new FormData();
    let img = $("#imageprojet"+valeur)[0].files;

    form_data.append('imageprojet', img[0]);
    form_data.append('valeur', valeur);
    form_data.append('nomprojet', nomprojet);
    form_data.append('clientprojet', clientprojet);
    form_data.append('descriptionprojet', descriptionprojet);
    form_data.append('liensite', liensite);
    form_data.append('liengithub', liengithub);
    form_data.append('datecreation', datecreation);
    form_data.append('createur', createur);

        $.ajax({
            url : 'crud_traitement.php?action=editer',
            type: 'post',
            data : form_data,
            contentType : false,
            processData : false,
            success: function(res){
                
                const obj2 = JSON.parse(res);

                $('.messagecrud').empty();
                $('.messagecrud').append(obj2.message);
                $('.messagecrud').append(obj2.mess);
                $('.messagecrud').append(obj2.erreur);

                var idd = obj2.id;

                // console.log("id");
                // console.log(idd);

                // console.log("div id");
                // console.log($('.affichenomprojet'+idd)[0]);

                $('.affichenomprojet'+idd).empty();
                $('.affichenomprojet'+idd).html(obj2.affichenomprojet);

                $('.afficheclientprojet'+idd).empty();
                $('.afficheclientprojet'+idd).html(obj2.afficheclientprojet);

                $('.liensite'+idd).empty();
                $('.liensite'+idd).html(obj2.afficheliensite);

                $('.liengithub'+idd).empty();
                $('.liengithub'+idd).html(obj2.afficheliengithub);

                $('.datecreation'+idd).empty();
                $('.datecreation'+idd).html(obj2.datecreation);
                $('.affichedate'+idd).empty();
                $('.affichedate'+idd).html(obj2.affichedatecreation2);


                $('.createur'+idd).empty();
                $('.createur'+idd).html(obj2.affichecreateur);

                $('.affichecreateur'+idd).empty();
                $('.affichecreateur'+idd).html(obj2.affichecreateur4);

                $('.imageprojet1'+idd).empty();
                $('.imageprojet1'+idd).html(obj2.afficheimage5);

                $('.affichephoto'+idd).empty();
                $('.affichephoto'+idd).html(obj2.afficheimage6);
            }
        });

    });

});