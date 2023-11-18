$(function() {
    $("#name_error_message").hide();
    $("#description_error_message").hide();

    var error_name=false;
    var error_desc=false;

    $("#category-name").on("keyup",function(){
        check_name();
    });
    $("#category-desc").on("keyup",function(){
        check_desc();
    });
    $("#OK").on("click",function(){
       
        OK = true;
       
    });

    function check_name(){
        var name=$("#category-name").val().trim();

        if(name.length<1){
            $("#category_name_error_message").html("Favor de ingresar el nombre de la categoría")
            $("#category_name_error_message").show();
            $("#category-name").css("border","2px solid #F90A0A");
            error_name=true;
        }else{
            $("#category_name_error_message").hide();
            $("#category-name").css("border","2px solid #34f458", "margin-bottom","0px");
        }
    }
    function check_desc(){
        var desc=$("#category-desc").val().trim();

        if(desc.length<1){
            $("#category_description_error_message").html("Favor de ingresar una descripción a la categoría")
            $("#category_description_error_message").show();
            $("#category-desc").css("border","2px solid #F90A0A");
            error_desc=true;
        }else{
            $("#category_description_error_message").hide();
            $("#category-desc").css("border","2px solid #34f458", "margin-bottom","0px");
        }
    }

    $(document).ready(function() {
        $('#OK').click(function() {
            if(OK===true){
             
                $('#miModal').css('display', 'none');
                OK=false;
                
                location.reload();
               
            }else{
               
                $('#miModal').css('display', 'grid');
            }
        });
    });

    $(document).on('click', '.AddCategoryClic', function() {
       
         // Obtener los elementos de entrada de archivo
       const nombrecategory = document.getElementById('category-name');
       const descripcioncategory = document.getElementById('category-desc');
      
       //vacia los input 
       nombrecategory.value = '';
       descripcioncategory.value = '';
      
    });


    const submitBtn = document.querySelector('#btn_savechangesCat');
    submitBtn.addEventListener('click', function() {

        error_name=false;
        error_desc=false;
    
        check_name();
        check_desc();
    
        if(error_name===false && error_desc===false){

        const formData = new FormData(document.querySelector('#create-category'));

        //verificar en la bd
        $.ajax({
            type: 'POST',
            url: '..//..//API//api-Categoria.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
               Swal.fire({
                    title: 'La categoría se ha guardado con éxito',
                    html: '<div>¡Gracias por tu contribución!</div><div>Ahora debes esperar a que el administrador acepte publicar tu categoría</div>',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor:'#F47B8F'
                }).then((willDelete) => {
                    if (willDelete) {
                        //location.reload();  
                        $('#addCategory').modal('hide');//cierra modal
                    } else {
                      alert("error");
                    }
                }); 
            console.log(data);
            },
            error: function(xhr, status, error){
                console.log('Error', error);

            }
        });
            return false;
        }else{
            $("#category_error_message").html("Por favor llene correctamente todos los campos")
            $("#category_error_message").show();
            return false;
        }
    
    })

    

})