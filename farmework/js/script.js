$(document).ready(function () {

    $('.startselect2simple').select2();
    $('.startselect2multiple').select2();

    $("#disconect").click(function () {
        $.ajax({
            url: 'index.php',
            type: 'post',
            data : {var : 'logout' }
        }).done(function () {
            window.location.href = "/tocalebre/admin/"
        });
    });

    $(".requirement").change(function(event){
        CheckedFieldForm(this);
    });
});

function ShowErroMessageField(elemt,message){
    $(elemt).next("span").remove();
    $(elemt).after('<span style="display: inline;" class="error invalid-feedback">'+message+'</span>') ;
    $(elemt).addClass('is-invalid');
}

function RemoveErroMessageField(elemt){
    $(elemt).removeClass('is-invalid');
    $(elemt).next("span").remove();
}

function CheckedFieldForm(elemt){
    var findError = false; 
    switch( $(elemt).attr("type")){
        case "text":
            if ($(elemt).val() == "") {
                ShowErroMessageField(elemt,"Campo Obrigatório");
                findError = true;
            }else{
                RemoveErroMessageField(elemt);
            }
        break;
    }
    return findError;
}

function ShowMessage(text, type) {
   var html = '';
    var classChange = '';
    var texthead = '';
    switch (type) {
        case 'error':
            classChange = 'alert-danger';
            texthead = 'Erro';
            break;
        case 'success':
            classChange = 'alert-success';
            texthead = 'Sucesso';
            break;
        case 'info':
            classChange = 'alert-info';
            texthead = 'Info';
            break;
    }

    html += '<div class="sufee-alert alert with-close '+classChange+' alert-dismissible fade show"> ';
    html += '   <div><strong>'+texthead+'!</strong> ' + text + '</div>';
    html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    html += '  <i class="fas fa-times"></i>';
    html += '</button></div>';

    $('#messageAlert').html(html);
    setTimeout(function () {
        $('#messageAlert').html('');
    }, 7000); // 7000 = 3 segundo
}

function RollBack() {
    window.history.back()
}

function ShoworHiderContainer(element) {
    if ($(element).is(":visible")) {
        $(element).hide();
    } else {
        $(element).show();
    }
}

function ReadURL(input,idShowImage) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#'+idShowImage).css('background-image', 'url('+e.target.result +')');
            $('#'+idShowImage).hide();
            $('#'+idShowImage).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function showImagemUpload(input,imgSizeStand, idelement,idShowImage){
        var property = document.getElementById(idelement).files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();

        var img = property.size;
        var imgsize = (img/1024); 

        if(jQuery.inArray(image_extension,['jpg','jpeg','png']) == -1){
            ShowMessage('Lamento '+image_extension+' não suportado, por favor use PNG, JPG ou JPEG. Obrigado','error');
            return false
        }else{
            if(imgsize > imgSizeStand){
                $('#'+idelement).val(null);
                ShowMessage('Lamento tamanho não suportado, o ficheiro ter menos de '+imgSizeStand +'K. Obrigado','error');
                return false
            }else{
               ReadURL(input,idShowImage);
               return true
            }
        }
}