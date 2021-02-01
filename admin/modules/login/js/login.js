$(document).ready(function() {
    $("#login").click(function(event){
        if(validateForm()){ 
            username = $('#name').val(); 
            password =$('#password').val(); 
            console.log(username);
            //var form_data = $("#autobusForm").serialize(); //Encode form elements for submission
           $.ajax({
                url : 'index.php',
                type: 'post',
                data : {var : 'login' , name : username, password : password}
            }).done(function(response){ //
            
                if(parseInt(response) ==  1){
                    location.reload();
                    ShowMessage('Login efecturado com Sucesso. Obrigado','success');
                }else{
                    ShowMessage('Erro password ou nome errados. Obrigado','error');
                }
            });
        }
    });
});

function validateForm() {
    var x = $('#name').val(); 
 
    if (x == "") {
        ShowMessage('Por favor, preencha o campo Nome. Obrigado','error');
        return false;
    }
    var x2 = $('#password').val(); 
    if (x2 == "") {
        ShowMessage('Por favor, preencha o campo Password. Obrigado','error');
        return false;
    }
    return true;
}