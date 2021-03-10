function DeleteUser(idblog){

    nameblog = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=bloglist&m=blog',
        type: 'post',
        data : {o : 'delete', idblog : idblog, nameblog : nameblog, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
        ShowMessage('Registo removido com sucesso.', 'success') 
    });
}

function searchUser(){
    nameuser = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=bloglist&m=blog',
        type: 'post',
        data : {o : 'search', nameuser : nameuser, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
    });
}

function EditarUser(idblog){
    window.location.replace('index.php?p=blog&m=blog&v='+idblog);
}

function ChangeStatusUsers(idblog,statusblog){
    nameuser = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=bloglist&m=blog',
        type: 'post',
        data : {o : 'statusChange', idblog : idblog, statusblog : statusblog, nameuser : nameuser, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
        ShowMessage('Estado alterado com sucesso.', 'success') 
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