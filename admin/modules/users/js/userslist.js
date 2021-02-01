

function searchUser(){
    nameuser = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=userslist&m=users',
        type: 'post',
        data : {o : 'search', nameuser : nameuser, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
    });
}

function DeleteUser(iduser){

    nameuser = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=userslist&m=users',
        type: 'post',
        data : {o : 'delete', iduser : iduser, nameuser : nameuser, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
        ShowMessage('Utilizador removido com sucesso.', 'success') 
    });
}

function EditarUser(iduser){
    window.location.replace('index.php?p=users&m=users&v='+iduser);
}

function ChangeStatusUsers(iduser,statususer){
    nameuser = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=userslist&m=users',
        type: 'post',
        data : {o : 'statusChange', iduser : iduser, statususer : statususer, nameuser : nameuser, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
        ShowMessage('Estado do utilizador alterado com sucesso.', 'success') 
    });
}


$(document).ready(function() {
    $("#searchuser").on("keyup", function() {
        searchUser();
    });
    $("#datatableslength").on("change", function() {
        searchUser();
    });
});

