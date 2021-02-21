function UploadImage(idimageUpload,tagUpload){
    var property = document.getElementById(idimageUpload).files[0];
    var form_data = new FormData();
    form_data.append("file",property);

    $.ajax({
        url:'index.php?p=about&m=about&o=update',
        method:'POST',
        data:form_data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
            $.ajax({
                url : 'index.php?p=about&m=about',
                type: 'post',
                data :  {imagemName: data, o : tagUpload}
            }).done(function(response){ //
                if(response){
                    ShowMessage('Registo Gravado com Sucesso. Obrigado','success');
                }else{
                    ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
                }
            });
            }
     });
}

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
        if(showImagemUpload(this,600,'imageUploadHead','imagePreviewHead')){
            UploadImage('imageUploadHead','updateimagehead');
        }
    });

    $("#imageUpload1").change(function() {
        if(showImagemUpload(this,600,'imageUpload1','imagePreview1')){
            UploadImage('imageUpload1','updateimage1');
        }
     });
     $("#imageUpload2").change(function() {
        if(showImagemUpload(this,600,'imageUpload2','imagePreview2')){
            UploadImage('imageUpload2','updateimage2');
        }
     });   
     $("#imageUpload3").change(function() {
        if(showImagemUpload(this,600,'imageUpload3','imagePreview3')){
            UploadImage('imageUpload3','updateimage3');
        }     
     });
});
