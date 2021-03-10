
<div class="row ">
    <div class="col-md-12">
        <div class="card card-primary"  >
            <div class="card-header">
                <h3 class="card-title">Imgens</h3>
            </div>
            <form role="form">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label ><h2>Imagem do Blog</h2></label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUploadHead" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUploadHead"><i class="fas fa-pencil-alt"></i>Editar</label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreviewHead" style="background-image: url([@IMAGEHEAD]);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card card-primary" >
            <div class="card-header">
                <h3 class="card-title">Textos</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="lang-change">
                        <select class="form-control" name="lang-change" id="lang-change" style="width: 100%">
                            <option value="1">Português</option>
                            <option value="2">Inglês</option>
                        </select>
                    </div>
                    <div class="row ">
                        <div class="col-xl-12">
                            <div class="form-group"> 
                            <label ><h2>Título</h2></label>               
                                <input type="text" class="form-control" value="[@TITLEBLOG]" id="titleblog"></input>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <form role="form">  
                            <label ><h2>Descrição</h2></label>               
                                <textarea id="DESCSHORT" >[@DESCSHORT]</textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card card-primary">
            <form role="form">
                <div class="card-body">
                    <button type="button" class=" float-right btn btn-primary saveform">Gravar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="BLOGID" name="BLOGID" value="[@BLOGID]"> 
