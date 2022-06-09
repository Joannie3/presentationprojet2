$(document).ready(function(){

    $('.verifconnexion').submit(function(ee)
    {
        ee.preventDefault();

        $('.affichemessageinscription').empty();

        var mail = document.getElementById("mail").value;
        var password = document.getElementById("password").value;

        console.log("mail");
        console.log(mail.length);

        if ((mail.length <= 0) || (password.length <= 0))
        {
            
            $('.affichemessageinscription').html("Merci de mettre un mail et ou un mot de pass");
        }
        else{

            $('.affichemessageinscription').empty();

            $.post('traitement_connexion.php', {mail:mail, password:password}, function (donnees)
            {
                const obj = JSON.parse(donnees);
        
                $('.affichemessageinscription').empty();
                $('.affichemessageinscription').html(obj.message);   
                
                window.setTimeout(function () {
                    location.href = "index.php";
                }, 2000);

        
            });


        }

    });

});