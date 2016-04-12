<div class="price-body editForm" data-url="user/edit/<?=$id?>">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <select class='form-control' name="cat" id="cat">
                <?php foreach($cat as $c){?>
                    <option value="<?=$c["id_tipo"]?>"><?=$c["name_cat"]?></option>
                <?}?>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" id="name2" name="name" class="form-control" placeholder="Usuário" required="" value="<?=$name?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon">@</span>
            <input type="email" id="email2" name="email" class="form-control" placeholder="E-mail" required="" value="<?=$email?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input type="password" id='pass3' class="form-control" placeholder="Senha" >
        </div>
    </div>
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input type="password" id="pass4" name="pass" class="form-control" placeholder="Re-Senha" >
        </div>
    </div>
</div>
<input type="hidden" value="<?=$id?>" id="id"/>


