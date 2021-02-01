
<div class="row ">
    <div class="col-md-4">
        <div class="card card-primary"  style="overflow-y: auto;height: 1070px;">
            <div class="card-header">
                <h3 class="card-title">Utilizador</h3>
            </div>
            <form role="form">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nome</label>
                                <input type="text" class="form-control requirement" id="nameuser" value="[@USER_NAME]" placeholder="Ex: Primeiro Segundo" maxlength="20">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >NickName</label>
                                <input type="text" class="form-control requirement" id="username" value="[@USER_NICKNAME]" placeholder="Ex: Sname">
                            </div>
                        </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label >Mail</label>
                                <input type="text" class="form-control requirement" id="useremail" value="[@USER_MAIL]" placeholder="Ex: exemplo@exe.com">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form role="form" >
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password" class="form-control requirement" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label >Confirmação de Password</label>
                                <input type="password" class="form-control checkpassword" id="checkpassword" placeholder="Confirmação Password">
                              
                            </div>
                           
                        </div>
                    </div>
                </div>
            </form>
             <form role="form" >
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <label >Foto</label>
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"><i class="fas fa-pencil-alt"></i></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url([@AVATARPHOTO]);">
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-primary"   style="overflow-y: auto;height: 1070px;">
            <div class="card-header">
                <h3 class="card-title">Premissões</h3>
            </div>
            <form role="form">
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div id="bodymain" class="row">
                            [@TABLE]
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-primary">
            <form role="form">
                <div class="card-body">
                    <button type="button" class=" float-right btn btn-primary saveform">Gravar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="userId" name="userId" value="[@USERID]"> 
<input type="hidden" id="photoupload" name="photoupload" value="[@AVATARPHOTO]"> 