$(document).ready(function() { 

    $("#imageUpload").change(function() {
        showImagemUpload(this,600,'imageUpload','imagePreview');
      
    });
    
    $(".saveform").click(function(event){
        var  userId =$('#userId').val();
        if(!ValidateForm(userId)  ){  // || (parseInt(userId) > 0 ? true : false)
            var nameuser = $('#nameuser').val(); 
            var username =$('#username').val(); 
            var password =$('#password').val(); 
            var userId =$('#userId').val();
            var useremail =$('#useremail').val();
            var property = document.getElementById('imageUpload').files[0];
            var th = $('tbody tr');
            var premiss = [];
            var imagemName =  $("#photoupload").val();

            //Monta o array
            for(var i = 0; i < th.length; i++) {
                premiss[i] = [ $('#premiss_'+i).is(":checked"), $('#idpageuser_'+i).val()];
            }
            
            var form_data = new FormData();
            form_data.append("file",property);

            $.ajax({
                url:'index.php?p=users&m=users&o=updateimage',
                method:'POST',
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    imagemName = data;
                }
            }).done(function(){ //
                $.ajax({
                    url : 'index.php?p=users&m=users',
                    type: 'post',
                    data :  {imagemName: imagemName, o : (parseInt(userId) > 0 ? 'update' : 'insert') , premiss:JSON.stringify(premiss),useremail:useremail, userId:userId, nameuser : nameuser, username : username,  password : password}
                }).done(function(response){ //
                    if(response){
                        ShowMessage('Registo Gravado com Sucesso. Obrigado','success');
                       //window.location.replace('index.php?p=userslist&m=users');
                    }else{
                        ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
                    }
                });
            });
        }
    });
});



function ValidateForm(userId){
    var findError = false; 
    $( ".requirement" ).each(function() {
        findError =  CheckedFieldForm(this);
    });

    if ($('#password').val() == "" && (parseInt(userId) > 0 ? false : true)) {
        RemoveErroMessageField('#password');
        ShowErroMessageField('#password',"Campo Obrigatório");
        findError = true;
    }else{
        if($('#password').val() != $('#checkpassword').val()){
            RemoveErroMessageField('#checkpassword');
            ShowErroMessageField('#checkpassword',"Passwords tem que ser iguais");
            ShowErroMessageField('#password',"Passwords tem que ser iguais");
            findError = true;
        }else{
            RemoveErroMessageField('#password');
            RemoveErroMessageField('#checkpassword');
        }
    }

    return findError;
}
