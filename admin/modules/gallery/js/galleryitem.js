$(document).ready(function() {  
    $('#DESCSHORT').trumbowyg();
    document.getElementById('pro-image').addEventListener('change', readImage, false);
    
  //  $( ".preview-images-zone" ).sortable();
    
    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        $(".preview-image.preview-show-"+no).remove();
    });

    $(".saveform").click(function(event){
        var  userId =$('#userId').val();
        if(true  ){  // || (parseInt(userId) > 0 ? true : false)
            var DESCSHORT = $('#DESCSHORT').trumbowyg('html');
            var titlegallery =$('#titlegallery').val(); 
            $.ajax({
                url : 'index.php?p=users&m=users',
                type: 'post',
                data :  {imagemName: imagemName, o : (parseInt(userId) > 0 ? 'update' : 'insert') , premiss:JSON.stringify(premiss),useremail:useremail, userId:userId, nameuser : nameuser, username : username,  password : password}
            }).done(function(response){ //
                if(response){
                    ShowMessage('Registo Gravado com Sucesso. Obrigado','success');

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



var num = 0;
function readImage() {
       UploadImage('pro-image','updateimage','gallery','galleryitem',0);

           

        if (window.File && window.FileList && window.FileReader) {
            var files = event.target.files; //FileList object
            var output = $(".preview-images-zone");

            for (let i = 0; i < files.length; i++) {
                var file = files[i];
                if (!file.type.match('image')) continue;
                
                var picReader = new FileReader();
                
                picReader.addEventListener('load', function (event) {
                    var picFile = event.target;
                    var html =  '<div class="preview-image preview-show-' + num + '">' +
                                '<div class="image-cancel" data-no="' + num + '">x</div>' +
                                '<div class="image-zone"><img id="pro-img-' + num + '" data-name='+nameimage+' src="' + picFile.result + '"></div>' +
                                
                                '</div>';

                    output.append(html);

                
                    num = num + 1;
                });

                picReader.readAsDataURL(file);
            }
            $("#pro-image").val('');
        } else {
            console.log('Browser not support');
        }
}

