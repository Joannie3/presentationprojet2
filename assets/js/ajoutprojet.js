$(document).ready(function(){

    $('.ajoutprojet1').submit(function(ee)
    {
        ee.preventDefault();

        var nomprojet = document.getElementById("nomprojet").value;
        var clientprojet = document.getElementById("clientprojet").value;
        var descriptionprojet = document.getElementById("descriptionprojet").value;


        let form_data = new FormData();
        let img = $("#photoprojet")[0].files;
        form_data.append('photoprojet', img[0]);
        form_data.append('nomprojet', nomprojet);
        form_data.append('clientprojet', clientprojet);
        form_data.append('descriptionprojet', descriptionprojet);
        form_data.append('lienprojet', lienprojet);

        $.ajax({
            url : 'ajoutprojet_traitement.php',
            type: 'post',
            data : form_data,
            contentType : false,
            processData : false,
            success: function(donnees){
                
                const obj = JSON.parse(donnees);
    
                $('.affichemessageprojet').empty();
                $('.affichemessageprojet').html(obj.message);

            $('#nomprojet').val('');
            $('#clientprojet').val('');
            $('#descriptionprojet').val('');            
            $('#photoprojet').val('');
            }
        });


    });

});