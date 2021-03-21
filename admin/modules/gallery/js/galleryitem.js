$(document).ready(function() {  
    $('#DESCSHORT').trumbowyg();
    document.getElementById('pro-image').addEventListener('change', readImage, false);
    
  //  $( ".preview-images-zone" ).sortable();
    
    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        var imageremove = $(this).data('path');
        $.ajax({
            url : 'index.php?p=galleryitem&m=gallery',
            type: 'post',
            data :  {imageremove: imageremove, o : 'removeimagem'}
        }).done(function(response){ //
            if(response){
                ShowMessage('Imagem Removida. Obrigado','info');
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
        $(".preview-image.preview-show-"+no).remove();
    });

    $(".saveform").click(function(event){
        if(true){  
            var  galleryId =$('#galleryId').val();
            $.ajax({
                url : 'index.php?p=galleryitem&m=gallery',
                type: 'post',
                data :  { o : (parseInt(galleryId) > 0 ? 'updategallery' : 'insertgallery') }
            }).done(function(response){ //
                if(response){
                    ShowMessage('Registo Gravado com Sucesso. Obrigado','success');
                    //window.location.replace('index.php?p=gallerylist&m=gallery');
                }else{
                    ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
                }
            });
        }
    });

    $("#titlegallery").blur(function() {
        var titleGallery =$('#titlegallery').val(); 
        var texthtml = $('#DESCSHORT').trumbowyg('html');
        var langId =$('#lang-change').val(); 
        $.ajax({
            url : 'index.php?p=galleryitem&m=gallery',
            type: 'post',
            data :  {o : 'updateclass',langId: langId, title : titleGallery, text : texthtml}
        }).done(function(response){ //
            if(response){
                ShowMessage('Alterado com Sucesso. Obrigado','success');
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    });
    $('#DESCSHORT').on('tbwblur', function(){ 
        var titleGallery =$('#titlegallery').val(); 
        var texthtml = $('#DESCSHORT').trumbowyg('html');
        var langId =$('#lang-change').val(); 
        $.ajax({
            url : 'index.php?p=galleryitem&m=gallery',
            type: 'post',
            data :  {o : 'updateclass',langId: langId, title : titleGallery, text : texthtml}
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
            url : 'index.php?p=galleryitem&m=gallery',
            type: 'post',
            data :  {langId: langId, o : 'changelang'}
        }).done(function(response){ //
            if(response){
                var obj = JSON.parse(response);
                ShowMessage('Linguagem alterada. Obrigado','info');
                $('#DESCSHORT').trumbowyg('html',obj['text']);
                $('#titlegallery').val(obj['title']);
            }else{
                ShowMessage('Lamento, mas ocorreu um erro. Obrigado','error');
            }
        });
    });

});

function UploadImageGallery(idimageUpload,tagUpload,module,page,num,output){
    var property = document.getElementById(idimageUpload).files[0];
    var form_data = new FormData();
    form_data.append("file",property);
    $.ajax({
        url:'index.php?p='+page+'&m='+module+'&o=updateimagem',
        method:'POST',
        data:form_data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(result){
            ShowMessage('Registo Gravado com Sucesso. Obrigado','success');
            var html =  '<div class="preview-image preview-show-' + num + '">' +
            '<div class="image-cancel" data-path="'+result+'" data-no="' + num + '">x</div>' +
            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + result + '"></div>' +
            '</div>';
            output.append(html);
        }
     });
}


var num = 0;
function readImage() {
        var output = $(".preview-images-zone");
        UploadImageGallery('pro-image','updateimage','gallery','galleryitem',num ,output);
        num = num + 1;
        $("#pro-image").val('');
}




