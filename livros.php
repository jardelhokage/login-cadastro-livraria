<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>  

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Cairo|Exo&display=swap" rel="stylesheet">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Cadastro de Livraria</title>
  </head>
  <body>
  <nav class="navbar navbar-light" style="background-color: #4ff175;">
      <!-- Conteúdo do navbar -->
      <div class="container">
        <a href="#" class="navbar-brand" href="#"><img src="imagens/ifpa_logo.png" width="96" height="96" alt="IFPA">	</a>
        <form class="form-inline my-2 my-lg-0">
          <a href="cadastro.html"><button type="button" class="btn btn-primary">Cadastre-se</button></a>
          <a href="login.html"><button type="button" class="btn btn-secondary">Entrar</button></a>
        </form>
      </div>
      </div>
    </nav>
    <div class="container-fluid" style="background-color: #4fd3f1;">
      <h1 class="text-center">BEM VINDO AO INSTITUTO FEDERAL</h1>
      <p class="text-center">Faça parte do que há de melhor em Educação pública no Brasil...s</p>
      <form class="form-inline my-2 my-lg-0">
      <a href="livros.php"><button type="button" class="btn btn-secondary">Cadastro livro</button></a>
      </form>
    </div>

        <div>
          <span class="plano02">
              <div class="container mt-2 mb-4 p-2 shadow bg-black">
                  <h6>Sistema de cadastro de livraria</h6>
              </span>
              </div>
        </div>
        <div class="container mt-2 mb-4 p-2 shadow bg-black">
          <form action="CRUDquery1.php" method="POST">
            <div class="form-row justify-content-center">
              <div class="col-auto">
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome da livraria">
              </div>
              <div class="col-auto">
                <input type="text" name="endereco" class="form-control" id="endereco" placeholder="Endereço">
              </div>
              <div class="col-auto">
                  <input type="number" name="cnpj" class="form-control" id="cnpj" placeholder="CNPJ">
              </div>
              <div class="col-auto">
                  <input type="text" name="telefone" class="form-control" id="telefone" placeholder="Telefone">
              </div>
              <div class="col-auto"> 
                <button type="reset" name="reset" class="btn btn-info">Limpar</button>
                <button type="submit" name="save" class="btn btn-info">Cadastrar</button> 
              </div>
              </div>
            </div>
          </form>
          <?php require_once("CRUDquery1.php"); ?>
          <div class="container">
            <?php if(isset($_SESSION['msg'])): ?>
             <div class="<?= $_SESSION['alert']; ?>">
                <?= $_SESSION['msg']; 
                unset($_SESSION['msg']);?>
             </div>
            <?php endif; ?>
            <div class="container mt-2 mb-4 p-2 shadow bg-white">
                <table class="table">
                    <thead>
                      <tr>
                        <th>CNPJ</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Data Registro</th>
                        <th>Opções</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form action="CRUDquery1.php" method="post">
                      <?php 
                      $sQuery = "SELECT * FROM cad_livraria LIMIT 20";
                      $result = $conn->query($sQuery);

                      $x = 1;
                      
                      while($row = $result->fetch_assoc()): ?>
                      
                      <tr>
                          <td><?= $row['cnpj']; ?></td>
                          <td><?= $row['nome']; ?></td>
                          <td><?= $row['endereco']; ?></td>
                          <td><?= $row['telefone']; ?></td>
                          <td><?= $row['created']; ?></td>
                          <td>
                            <button type="submit" name="delete" value="<?= $row['cnpj']; ?>" class="btn btn-danger">Deletar</button>
                            <button type="button" name="edit" value="<?= $x; $x++;?>" class="btn btn-primary">Editar</button>
                          </td>
                      </tr>
                    <?php endwhile; ?>
                    </tbody>
      
                  </table>
            </div>
          </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
      $(document).ready(function(){
        setTimeout(function(){
          $(".alert").remove();
        }, 3000);

        $(".btn-primary").click(function() {
          $(".table").find('tr').eq(this.value).each(function(){
            $("#nome").val($(this).find('td').eq(1).text());
            $("#endereco").val($(this).find('td').eq(2).text());
            $("#cnpj").val($(this).find('td').eq(0).text());
            $("#telefone").val($(this).find('td').eq(3).text());
            $(".btn-info").val($(this).find('td').eq(0).text());
          });
          $(".btn-info").attr("name", "edit");
        });
      })
    </script>
  </body>
</html>
