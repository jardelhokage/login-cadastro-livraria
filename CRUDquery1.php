<?php

$conn = new mysqli("localhost","root","","pedroni" ) OR die("ERRO: " . mysqli_error($conn));


//code to save urserś da
if (isset($_POST['save'])){
    if(!empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['cnpj']) && !empty($_POST['telefone'])){
        
        $cnpj = $_POST['cnpj'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone =$_POST['telefone'];
        

        $iQuery = "INSERT INTO cad_livraria(cnpj,nome,endereco,telefone,created) VALUES (?,?,?,?,NOW())";

        $stmt =$conn->prepare($iQuery);
        $stmt->bind_param("isss",$cnpj ,$nome,$endereco,$telefone);
        if ($stmt->execute()){
            # alert msg
            $_SESSION['msg'] = "Cadastrado com sucesso";
            $_SESSION['alert'] ="alert alert-sucess";
        }
        $stmt->close();
        $conn->close();
    }
    else {
             $_SESSION['msg'] = "Atualizado f";
             $_SESSION['alert'] ="alert alert-warning";
    }
    header("location: livros.php"); 
}
#Delete selected data
if (isset($_POST['delete'])){
    $cnpj = $_POST['delete'];

    $dQuery = "DELETE FROM cad_livraria WHERE cnpj = ?";
    $stmt = $conn->prepare($dQuery);
    $stmt->bind_param('i', $cnpj);
    if($stmt->execute()){
        $_SESSION['msg'] = "Selected record is successfully deleted.";
        $_SESSION['alert'] = "alert alert-danger";
    }
    $stmt->close();
    $conn->close();
    header("location: cadastrolivraria.php");
}
#update users
if (isset($_POST['edit'])){
    if(!empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['cnpj']) && !empty($_POST['telefone'])){
        #code....
       
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $cnpj = $_POST['edit'];

        $uQuery = "UPDATE cad_livraria SET nome = ?, endereco = ?, telefone = ? WHERE cnpj = ?";

        $stmt = $conn->prepare($uQuery);
        $stmt->bind_param('sssi', $nome, $endereco, $telefone, $cnpj);

        if($stmt->execute()){
            $_SESSION['msg'] = "Select record is successfully update.";
            $_SESSION['alert'] = "alert alert-success";
        }
        $stmt->close();
        $conn->close();
    }
    else {
        $_SESSION['msg'] = "Atualizado f";
        $_SESSION['alert'] ="alert alert-warning";
    }
    header("location: cadastrolivraria.php");
}
?>