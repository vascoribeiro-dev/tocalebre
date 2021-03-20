

$(document).ready(function() {  
    $('#DESCLONG').trumbowyg();
    $('#DESCSHORT').trumbowyg();

    $('#DESCSHORT').on('tbwblur', function(){ 
        data = $('#DESCSHORT').trumbowyg('html');
        var lang_id = $("#lang-change").val();
        $.ajax({
            url : 'index.php?p=about&m=about',
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

    $('#DESCLONG').on('tbwblur', function(){ 
        data = $('#DESCLONG').trumbowyg('html');
        var lang_id = $("#lang-change").val();
        $.ajax({
            url : 'index.php?p=about&m=about',
            type: 'post',
            data :  {langid: lang_id,textName: data, o : 'updatetextlong'}
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
            url : 'index.php?p=about&m=about',
            type: 'post',
            data :  {langid: lang_id, o : 'changelang'}
        }).done(function(response){ //
            if(response){
                var obj = JSON.parse(response);
                ShowMessage('Linguagem alterada. Obrigado','info');
                $('#DESCSHORT').trumbowyg('html',obj[0]['description_short']);
                $('#DESCLONG').trumbowyg('html',obj[0]['description_long']);
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    });

    $("#imageUploadHead").change(function() {
        if(showImagemUpload(this,1200,'imageUploadHead','imagePreviewHead')){
            UploadImage('imageUploadHead','updateimagehead','about','about');
        }
    });

    $("#imageUpload1").change(function() {
        if(showImagemUpload(this,1200,'imageUpload1','imagePreview1'){
            UploadImage('imageUpload1','updateimage1','about','about');
        }
     });
     $("#imageUpload2").change(function() {
        if(showImagemUpload(this,1200,'imageUpload2','imagePreview2')){
            UploadImage('imageUpload2','updateimage2','about','about');
        }
     });   
     $("#imageUpload3").change(function() {
        if(showImagemUpload(this,1200,'imageUpload3','imagePreview3')){
            UploadImage('imageUpload3','updateimage3','about','about');
        }     
     });
});
