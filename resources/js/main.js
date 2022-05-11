const { isArguments, get } = require("lodash");



// au demarrage de l'application 
$(function(){



    const showLoading = (idElement, idLoading) => {
        // Si l'element est visilble, if faut le cacher
        if($(idElement).hasClass('block')){
           $(idElement).addClass('hidden');
           $(idElement).removeClass('block')
       }

       // Si le loading est caché il faut l"afficher
       if($(idLoading).hasClass('hidden')){
           $(idLoading).removeClass('hidden');
           $(idLoading).addClass("block");
      }
   }

   const showElement = (idElement, idLoading) => {

    // si loading est afficher on le retire 
    if($(idLoading).hasClass('block')){
        $(idLoading).removeClass('block');
        $(idLoading).addClass("hidden");
      }
    // si l'element est caché on l'affiche
    if($(idElement).hasClass('hidden')){
            $(idElement).removeClass("hidden")
            $(idElement).addClass("block")
    }
}


  getContacts();
  getContactsFiltre()
    /***************** début modal **********************/

    // const token =  $('meta[name="csrf-token"]').attr('content')

    let action;
    let idEdit;
    let idDelete;

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

        showLoading("#form-add", '#load-form');

        setInterval(() => {
            showElement("#form-add", '#load-form');
        }, 1000);

        action = "new";

        for(input of inputs){
            input.value =''
        }

        $("img#avatar-contact-form").hide()

    });

    /***************** fin modal **********************/

    /***************** début ajax soumission formulaire **********************/

  

  
 

    let inputFile = document.querySelector("#input-form[name='avatar']");
    let imgPrevious = document.querySelector('#avatar-contact-form');
   
    inputFile.addEventListener('change', (e) => {

        const file = e.target.files[0];
        
        if(file){
       
            imgPreview.setAttribute('src', URL.createObjectURL(file));
            imgPreview.style.display = "block";
        }
    })


  // let navigation = document.querySelector('[aria-label="Pagination Navigation"]');
        // let linkPagination = navigation.querySelectorAll("a");

        // console.log(navigation)
        // for(links of linkPagination){
      
        //     links.addEventListener('click', (e) => {
        //         e.preventDefault()
        //         let page = e.target.getAttribute("href").split('page=')[1];
        //         fetch_data(page);
        //     })
        // }

    const pagination = (prevID, nextID, urlRequest, refreshElement) => {

    
        let btnPrev = document.querySelector(prevID);
        let btnNext = document.querySelector(nextID);
        let maxPage = $(nextID).data('max');
        let indicatorPage = document.querySelector("#current-page")


        let page = 1;

        btnPrev.addEventListener('click',(e) => {

            if(page == 1){
                e.target.setAttribute('disabled', true);
            }

            if(page > 1){
               
               btnNext.removeAttribute('disabled')

                page --
              
                getDataPagination(urlRequest, page, refreshElement);

            }else{
                page = 1;
            }

            indicatorPage.textContent = page

        })

        btnNext.addEventListener('click', (e) => {

            if(page < maxPage ){
                page ++   
                btnPrev.removeAttribute('disabled')
            }

          
            if(page == maxPage){
                e.target.setAttribute('disabled', true)
            }

            getDataPagination(urlRequest, page, refreshElement);
            indicatorPage.textContent = page

        })

    }

    function getDataPagination(urlRequest,page, refreshElement)
    {
        $.ajax({
            url:urlRequest+page,
            success:function(data)
            {
                $(refreshElement).html(data.result);
            }
        });
    }

    

  const editContact = () => {

        const allEditBtn = document.querySelectorAll('#editData');

        for(editBtn of allEditBtn){
   
            editBtn.addEventListener('click', (e) => {
    
             
                // e.preventDefault()
                showModal();
                showLoading("#form-add", '#load-form');

                $("img#avatar-contact-form").show()

                action = "edit";
                idEdit = e.target.dataset.id;

                $.ajax({
    
                    url : route('detail-contact', idEdit),
                    type : "GET",
    
                    success:function(res){
                    
                        // apres une seconde afficher le formulaire à la place du loading
                        setInterval(() => {
                            showElement("#form-add", '#load-form')
                        }, 1000);

                            $('input[name="email"]').val(res.result.email);
                            $('input[name="prenom"]').val(res.result.prenom);
                            $('input[name="nom"]').val(res.result.nom);
                            $("img#avatar-contact-form").attr('src', `/storage/${res.img}`);
                       
                            let optionSelect = document.querySelectorAll('select#membres>option');

                            for(option of optionSelect ){
                                if(option.value == res.result.membres){
                                    option.setAttribute('selected', true)
                                }
                            }
                            
                    },
                    error:function(err){
                        console.log(err)
                    },
                     
                })
    
            })
        }
  }


    const deleteContact = () =>{
        
        let allDeleteBtn = document.querySelectorAll('button#delete')

        for(deleteBtn of allDeleteBtn){

            deleteBtn.addEventListener('click', (e) => {

                let confirmation = confirm('Are you sure you want to delete this item?')

                if(confirmation){
                    idDelete = e.target.dataset.id;

                    $.ajax({
            
                        url : route('delete-contact', idDelete),
                        type : "GET",
    
                        success:function(res){
    
                            getContacts();
                            console.log(res.msg)
                                
                        },
                        error:function(err){
                            console.log(err)
                        },
                        
                    })
                }else{
                    return;
                }
               
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
                
                    // si on ajoute un contact, l'afficher
                    if(action === "new"){
                        getContacts(data.id)
                    }

                    // modification du contact par le modale
                    if(action === "edit"){

                        $(`#${idEdit}`).find("p#email").text(data.update.email);
                        $(`#${idEdit}`).find("p#names").text(`${data.update.nom} ${data.update.prenom}`);
                        $(`#${idEdit}`).find("p#prenom").text(data.update.prenom);
                        $(`#${idEdit}`).find("img#avatar").attr("src",`/storage/${data.img}`);
                        $(`#${idEdit}`).find("h5#contact-membres").text(data.update.membres);
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

    
    function getContacts(id=null){

       showLoading("#list-contact", '#load-data');

        $.get(route("contacts"),{}, function(data){

            $('#refresh-list-ajax').html(data.result); 

            setInterval(() => {
                showElement("#list-contact", '#load-data');
                $('#pagination').removeClass('hidden');

            }, 1000);
        
            let membre = window.location.pathname;
            let paramMembre =  membre.replace('/', '').trim()
            let tabMembre = ['famille', 'amis', 'collegues', 'autres'];

            if(tabMembre.includes(paramMembre)){
                //pagination avec filtre
                pagination('button#prev-filtre', 'button#next-filtre', `/${paramMembre}?type=pagination&page=`, '#refresh-list-ajax-filtre')
              
            }else{
                // pagination sans filtre
                pagination('button#prev', 'button#next', "/contacts?type=pagination&page=", '#refresh-list-ajax', 'pagination')
            }
    
            editContact();
            deleteContact();

        },'json');
           
    }

    function getContactsFiltre(id=null){
 
        let membre = window.location.pathname;
        let paramMembre =  membre.replace('/', '').trim()
        console.log(paramMembre)
             
         $.get(route("filtre-contact", paramMembre),{}, function(data){
 
             $('#refresh-list-ajax-filtre').html(data.result); 
             console.log(data.result)
 
         },'json');
            
    }
        
})






