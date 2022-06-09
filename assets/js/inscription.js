$(document).ready(function(){

    $('.gestioninscription').submit(function(ee)
    {
        ee.preventDefault();

        var mail = document.getElementById("mail").value;
        var nom = document.getElementById("nom").value;
        var prenom = document.getElementById("prenom").value;
        var password = document.getElementById("password").value;

        $.post('traitement_inscription.php', {nom:nom, prenom:prenom, mail:mail, password:password}, function (donnees)
        {
            const obj = JSON.parse(donnees);
    
            $('.affichemessageinscription').empty();
            $('.affichemessageinscription').html(obj.message);

            if (obj.valide == 'ok'){
                $('#mail').val('');
                $('#nom').val('');
                $('#prenom').val('');            
                $('#password').val('');
            }
            else {}
    



    
        });

    });

});