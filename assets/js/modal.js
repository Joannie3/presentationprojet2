window.onload = () => {
    // on recupere tous les boutons d'ouverture de modal
    

    $('.suppression').click(function(ee)
    {
        ee.preventDefault();

        let valeur = this.dataset.value; // ici c'est la valeur de mon id

        $.post('crud_traitement.php?action=suppr', {valeur:valeur}, function (donnees)
        {
            const obj = JSON.parse(donnees);

            $('.titremodal_jo').empty();
            $('.titremodal_jo').html("Suppression du projet N°"+valeur);

            $('.infosuppression').html(obj.message);
            $('.boutonsuppr').html(obj.boutonsuppr);

        });

        


    });

    const modalButtons = document.querySelectorAll("[data-toggle=modal]");

    for(let button of modalButtons)
    {
        button.addEventListener("click", function(e){
            // on empeche la navigation
            e.preventDefault();

            // on recupere le data-target
            let target = this.dataset.target

            let valeur = this.dataset.value; // ici c'est la valeur de mon id
            console.log(valeur);

            // on recupere la bonne modal 
            let modal = document.querySelector(target);

            // let recupValeur = document.querySelector(valeur);

            // on affiche la modal 
            modal.classList.add("show");

                // on recupere les boutons de fermeture
            const modalClose = modal.querySelectorAll("[data-dismiss=dialog]");

            for(let close of modalClose){
                close.addEventListener("click", () => {
                    modal.classList.remove("show");
                });
            }
            // on gere la fermeture lors du clic sur la zone grise
            modal.addEventListener("click", function(){
                this.classList.remove("show");
            });

            // // on evite la prpagation du clic d'un enfant a son parent
            // modal.children[0].addEventListener("click", function(e)
            // {
            //     e.stopPropagation();
            // });

        });        
    }               
    
}