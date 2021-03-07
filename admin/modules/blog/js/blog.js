$(document).ready(function() {  
    $('#DESCSHORT').trumbowyg();
    $(".saveform").click(function(event){
        if(true){  
            var  BLOGID =$('#BLOGID').val();
            $.ajax({
                url : 'index.php?p=blog&m=blog',
                type: 'post',
                data :  { o : (parseInt(BLOGID) > 0 ? 'update' : 'insert') }
            }).done(function(response){ //
                if(response){
                    ShowMessage('Registo Gravado com Sucesso. Obrigado','success');
                }else{
                    ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
                }
            });
        }
    });

    $("#titleblog").blur(function() {
        var titleblog =$('#titleblog').val(); 
        var texthtml = $('#DESCSHORT').trumbowyg('html');
        var langId =$('#lang-change').val(); 
        $.ajax({
            url : 'index.php?p=blog&m=blog',
            type: 'post',
            data :  {o : 'updateclass',langId: langId, title : titleblog, text : texthtml}
        }).done(function(response){ //
            if(response){
                ShowMessage('Alterado com Sucesso. Obrigado','success');
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    });
    $('#DESCSHORT').on('tbwblur', function(){ 
        var titleblog =$('#titleblog').val(); 
        var texthtml = $('#DESCSHORT').trumbowyg('html');
        var langId =$('#lang-change').val(); 
        $.ajax({
            url : 'index.php?p=blog&m=blog',
            type: 'post',
            data :  {o : 'updateclass',langId: langId, title : titleblog, text : texthtml}
        }).done(function(response){ //
            if(response){
                ShowMessage('Alterado com Sucesso. Obrigado','success');
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    }); 

    $("#lang-change").change(function() {
        var langId = $("#lang-change").val();
        $.ajax({
            url : 'index.php?p=blog&m=blog',
            type: 'post',
            data :  {langId: langId, o : 'changelang'}
        }).done(function(response){ //
            if(response){
                var obj = JSON.parse(response);
                ShowMessage('Linguagem alterada. Obrigado','info');
                $('#DESCSHORT').trumbowyg('html',obj['text']);
                $('#titleblog').val(obj['title']);
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    });

    $("#imageUploadHead").change(function() {
        if(showImagemUpload(this,600,'imageUploadHead','imagePreviewHead')){
            var property = document.getElementById('imageUploadHead').files[0];
            var form_data = new FormData();
            form_data.append("file",property);
            $.ajax({
                url:'index.php?p=blog&m=blog&o=updateimage',
                method:'POST',
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(result){
                    if(result){
                     
                        ShowMessage('Registo Gravado com Sucesso. Obrigado','success');
                        window.location.replace('index.php?p=bloglist&m=blog');
                    }else{
                        ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
                    }
                }
            });
        }
    });
});
