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
});



var num = 4;
function readImage() {
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
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            
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

