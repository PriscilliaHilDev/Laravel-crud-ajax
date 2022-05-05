const { isArguments } = require("lodash");

 // exo 
    // let tab = ['aa', 5, 8, 'kr'];
    // console.log(!tab?.length,!tab.lenght, tab.length === 0, 'vide')
    // console.log(tab.length > 0, !!tab?.length 'pas vide ?')

// au demarrage de l'application 
$(function(){

  getContacts();
    /***************** début modal **********************/
   

    // const token =  $('meta[name="csrf-token"]').attr('content')

    let action;
    let idEdit;

    const overlay = document.querySelector('#overlay');
    const btnAddContact = document.querySelector('#new-contact');
    const outCloseModal = document.querySelector('#bg-modal');
    let inputs = document.querySelectorAll('#input-form');
    let msgInput = document.querySelectorAll('p.error-text');
    let btnCancel = document.querySelector('#cancel'); 

    const showModal = () => {
        if(overlay.classList.contains('hidden')){
            overlay.classList.remove('hidden');
        }
    }

    const closeModal = () => {

        if(!overlay.classList.contains('hidden')){
            overlay.classList.add('hidden');           
        }
        //resset message errors
        for(msg of msgInput){
            msg.textContent = ''
        } 
    }

    btnCancel.addEventListener('click', () => {
        closeModal()
    });
  
    outCloseModal.addEventListener('click', () =>{
        closeModal()
    });

    btnAddContact.addEventListener('click', ()=> {
      
        showModal();

        showLoading();

        setInterval(() => {
            showForm();
        }, 1000);

        action = "new";

        for(input of inputs){
            input.value =''
        }

        $("img#avatar-contact-form").hide()

    });

    /***************** fin modal **********************/

    /***************** début ajax soumission formulaire **********************/

    const showLoading = () => {
         // cacher le formulaire pour afficher que le loading
         if($("#form-add").hasClass('block')){
            $("#form-add").addClass('hidden');
            $('#form-add').removeClass('block')
        }

        // afficher le loading si il a ete caché
        if($("#loading").hasClass('hidden')){
            $("#loading").removeClass('hidden');
            $("#loading").addClass("block");
       }
    }

    const showForm = () => {

        // si loading est afficher on le retire pour afficher le formulaire
        if($("#loading").hasClass('block')){
            $("#loading").removeClass('block');
            $("#loading").addClass("hidden");
          }
        // si le formulaire est caché on l'affiche 
        if($("#form-add").hasClass('hidden')){
                $("#form-add").removeClass("hidden")
                $("#form-add").addClass("block")
        }
    }
 

    let inputFile = document.querySelector("#input-form[name='avatar']");
    let imgPrevious = document.querySelector('#avatar-contact-form');
   
    inputFile.addEventListener('change', (e) => {

        const file = e.target.files[0];
        
        if(file){
       
            imgPrevious.setAttribute('src', URL.createObjectURL(file));
            imgPrevious.style.display = "block";
        }
    })


  const getOneContact = () => {

        const allEditBtn = document.querySelectorAll('#editData');

        for(editBtn of allEditBtn){
   
            editBtn.addEventListener('click', (e) => {
    
             
                e.preventDefault()
                showModal();
                showLoading();

                $("img#avatar-contact-form").show()

                action = "edit";
                idEdit = e.target.dataset.id;

                $.ajax({
    
                    url : route('detail-contact', idEdit),
                    type : "GET",
    
                    success:function(res){
                    
                        setInterval(() => {
                            showForm()
                        }, 1000);

                            $('input[name="email"]').val(res.email);
                            $('input[name="prenom"]').val(res.prenom);
                            $('input[name="nom"]').val(res.nom);
                            $("img#avatar-contact-form").attr('src', `/storage/${res.image_url}`)
                    },
                    error:function(err){
                        console.log(err)
                    },
                     
                })
    
            })
        }
  }

    const form = document.querySelector('#form-add');

    const submitForm = (urlRequest) => {

        $.ajax({

            url:urlRequest,
            method:'POST',
            data:new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,

            //resset error msg
            beforeSend:function(){
                $(document).find('p.error-text').text('');
            },

            success:function(data){
                
                if(data.status == 0){

                    console.log(data, 'error');
                    $.each(data.error, function(prefix, val){

                        $('p#'+"error_"+prefix).text(val[0]);

                    });

                    // $.each(inputs, (index, input) => {
                        // custom input error red
                    // })
                
                }else{
                    
                    $('#form-add')[0].reset();
                  
                   // si il y a des contacts, ne plus afficher que c'est null
                    // if(!data.contacts?.length ){
                    //     $("#empty-contacts").addClass('hidden');
                    // }

                    // si on ajoute un contact, l'afficher
                    if(action === "new"){
                        getContacts(data.id)
                    }

                    // modification du contact par le modale
                    if(action === "edit"){

                        $(`#${idEdit}`).find("p#email").text(data.update.email);
                        $(`#${idEdit}`).find("p#names").text(`${data.update.nom} ${data.update.prenom}`);
                        $(`#${idEdit}`).find("p#prenom").text(data.update.prenom);
                        $(`#${idEdit}`).find("img#avatar").attr("src",`/storage/${data.update?.image_url}`);
                    }

                    closeModal();
                }
            }
        });
    }
     

    //lorsque je soumets le formulaire
    $("#form-add").on('submit', function(e){
        e.preventDefault();
      
        if(action == "new"){
            submitForm(route("add-contact"))
        }
        
        if(action == "edit"){
            submitForm(route('edit-contact', idEdit))
        } 
    });

    
    function getContacts(id){
    
       
        // $('#refresh-list-ajax').addClass('animate-pulse');

        // $(`#${id}>div#card-contact`).addClass("bg-green-200");
        //  let previous = id-1;
       
       

        $.get(route("list-contacts"),{}, function(data){

        
             $('#refresh-list-ajax').html(data.result);
         
            // if($(`#${previous}`).hasClass("bg-green-200")){
            //     $(`#${previous}>div#card-contact`).removeClass('bg-gree-200')
            // }


            // dans 2 sec supp la classe animate pulse
        //     setTimeout(() => {
        //        if($('#refresh-list-ajax').hasClass("animate-pulse")){
        //             $('#refresh-list-ajax').removeClass('animate-pulse');
        //        } 
        //    }, 2000);

           // edit contact
             getOneContact();

             let cardsContact = document.querySelectorAll('ul#list-contact>li');
            
             for(card of cardsContact){
                 let srcIMG = card.querySelector('img').getAttribute("src");
                if(srcIMG === ""){
                    card.querySelector('img').classList.add('hidden');  
                }
                 
             }

        },'json');
    }
         

})






