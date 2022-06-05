<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="<?php echo URL; ?>recursos/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Notícias Etec</title>
</head>
<body>
<?php include "menuadm.php"; ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-8 mx-auto">

            <div class="card">
                <div class="card-header bg-primary text-white">
                Editar Notícia
                    <a href="<?php echo URL;?>consultar-noticia" class="btn btn-secondary btn-sm float-right"><i class="fa fa-arrow-left"></i> Consultar notícia</a>
                </div>
                <div class="card-body">
                <form action="<?php echo URL . 'atualizar-noticia'; ?>" method="post" enctype="multipart/form-data">
                    
                    <input type="hidden" name="idnoticia" value="<?php echo $dadosNoticia->idnoticia;?>">    

                    <div class="form-group">
                        <label>Data:</label>
                        <input type="datetime-local" name="data" class="form-control" value="<?php echo date('Y-m-d\TH:i',strtotime($dadosNoticia->data)); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Título:</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo $dadosNoticia->titulo;?>" required>
                    </div>
                    <div class="form-group">
                        <label>Categoria:</label>
                        <select name="idcategoria" id="idcategoria" class="form-control">
                            <?php
                                foreach($dadosCategoria as $value)
                                {
                                    $selected = $value->idcategoria == 
                                    $dadosNoticia->idcategoria ? "selected" : "";
                                    
                                    echo "<option value='$value->idcategoria' $selected>
                                            $value->nomecategoria
                                          </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Conteúdo:</label>
                        <textarea name="conteudo" class="form-control"><?php echo $dadosNoticia->conteudo;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Imagem adicionada</label>
                        <?php if($dadosNoticia->imagem == "") $dadosNoticia->imagem = "semfoto.png"; ?>
                        <img src="<?php echo URL."recursos/img/$dadosNoticia->imagem";?>" width='100px' class="rounded d-block">
                    </div>
                    
                    <div class="form-group">
                        <label>Trocar imagem</label>
                        <input type="file" name="imagem" accept="image/*" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Ativo:</label>
                        <select name="ativo" id="ativo" class="form-control" required>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Gravar">
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- JS Query--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/jquery-3.5.1.js"></script>
<!-- JS Bootstrap --> 
<script src="<?php echo URL; ?>recursos/js/popper.min.js"></script>
<script src="<?php echo URL; ?>recursos/js/bootstrap.min.js"></script>

<script>
    $("#ativo").
    val("<?php echo $dadosNoticia->ativo;?>");
</script>
</body>
</html>