<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  
    <title>Horóscopo</title> 
  </head>
  <body class="p-5">
    
    <div style="opacity: 98%;" class="position-absolute top-50 start-50 translate-middle bg-white rounded shadow p-5 max-w">
        <h1 class="text-center">Olá, <?= $nomeUsuario ?>!</h1>
        <hr>

        <div class="row">
            <div class="col-sm-12 col-lg-8">
              <h2>Seu signo é <?= $signoUsuario['nome'] ?></h2>
              <p><?= $signoUsuario['descricao'] ?></p>
            </div>
            
            <img style="max-width: 180px;" class="col-sm-12 col-lg-4 mx-auto" src="<?= $signoUsuario['imagem'] ?>">
        </div>
        
        <p class="mt-3 fw-bold fst-italic">de <?= $signoUsuario['dataInicio'] ?> até <?= $signoUsuario['dataFim'] ?></p>
        
        <a class="btn mt-3 w-50" href="index.php">Voltar</a>
    </div>
    
  </body>
</html>