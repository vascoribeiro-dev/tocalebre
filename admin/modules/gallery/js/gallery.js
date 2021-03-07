

$(document).ready(function() {  
    $('#DESCSHORT').trumbowyg();

    $('#DESCSHORT').on('tbwblur', function(){ 
        data = $('#DESCSHORT').trumbowyg('html');
        var lang_id = $("#lang-change").val();
        $.ajax({
            url : 'index.php?p=gallery&m=gallery',
            type: 'post',
            data :  {langid: lang_id,textName: data, o : 'updatetext'}
        }).done(function(response){ //
            if(response){
                ShowMessage('Registo Gravado com Sucesso. Obrigado','success');
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    }); 

    $("#lang-change").change(function() {
        var lang_id = $("#lang-change").val();
        $.ajax({
            url : 'index.php?p=gallery&m=gallery',
            type: 'post',
            data :  {langid: lang_id, o : 'changelang'}
        }).done(function(response){ //
            if(response){
                var obj = JSON.parse(response);
                ShowMessage('Linguagem alterada. Obrigado','info');
                $('#DESCSHORT').trumbowyg('html',obj[0]['description']);
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    });

    $("#imageUploadHead").change(function() {
        if(showImagemUpload(this,600,'imageUploadHead','imagePreviewHead')){
            UploadImage('imageUploadHead','updateimagehead','gallery','gallery',0);
        }
    });
});
