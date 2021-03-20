function DeleteUser(idgalleryitem){

    namesearch = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=gallerylist&m=gallery',
        type: 'post',
        data : {o : 'delete', idgalleryitem : idgalleryitem, namesearch : namesearch, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
        ShowMessage('Registo removido com sucesso.', 'success') 
    });
}

function searchUser(){
    namesearch = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=gallerylist&m=gallery',
        type: 'post',
        data : {o : 'search', namesearch : namesearch, datatableslength : datatableslength}
    }).done(function(response){ //
        $( "#bodymain" ).html(response);
    });
}

function EditarUser(idgalleryitem){
    window.location.replace('index.php?p=galleryitem&m=gallery&v='+idgalleryitem);
}

function ChangeStatusUsers(idgalleryitem,statusgalleryitem){
    namesearch = $('#searchuser').val(); 
    datatableslength = $('#datatableslength').val(); 
    $.ajax({
        url : 'index.php?p=gallerylist&m=gallery',
        type: 'post',
        data : {o : 'statusChange', idgalleryitem : idgalleryitem, statusgalleryitem : statusgalleryitem, namesearch : namesearch, datatableslength : datatableslength}
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