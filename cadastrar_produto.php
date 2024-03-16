<?php   
session_start();
require_once('conexao.php');

if(!isset($_SESSION['admin_logado'])){
    header('Location:login.php');
    exit();
}


//$_SERVER ['REQUEST_METHOD'] RETORNA O MÉTODO USADO PARA ACESSAR A PÁGINA
if($_SERVER ['REQUEST_METHOD']=='POST'){

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $url_imagem = $_POST['url_imagem'];
    $imagemcompleta = $_FILES['imagem'];
    $imagem = $_FILES['imagem']['name'];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($imagem);

    //Gerar url da imagem:
    $base_url = "http://localhost/PROJETO/";
    

    $url_imagem = $base_url . "uploads/" . basename($imagem);


    //Mover o arquivo de imagem carregado para o diretório de destino
    if(move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file)){
        echo "<p> Imagem " . basename($imagem) . "foi carregada";
    }else{
        echo "Falha ao carregar a imagem";
    }
    
try{
    $sql = "INSERT INTO PRODUTOS (nome, descricao, preco, imagem, url_imagem) VALUES(:nome, :descricao, :preco, :imagem, :url_imagem)";

    $stmt = $pdo->prepare($sql);
    
    $stmt-> bindParam(':nome',$nome, PDO::PARAM_STR);
    $stmt-> bindParam(':descricao',$descricao, PDO::PARAM_STR);
    $stmt-> bindParam(':preco',$preco, PDO::PARAM_STR);
    $stmt-> bindParam(':imagem',$target_file, PDO::PARAM_STR);
    $stmt-> bindParam(':url_imagem',$url_imagem, PDO::PARAM_STR);

    $stmt->execute();

    echo "<p style='color:green;'>Produto cadastrado com sucesso!</p>";

}catch(PDOException $error){
echo "<p style = 'color:red;' > Erro ao cadastrar o produto: " . $error ->getMessage(). "</p>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h2>Cadastro de Produto</h2>
    <form action="cadastrar_produto.php" method = "post" enctype="multipart/form-data">
    <label for="nome">Nome:</label> 
    <input type="text" name="nome" id="nome" required> 
    <p></p>

    <label for="descricao">Descrição:</label> 
    <textarea name="descricao" id="descricao" required> </textarea>
    <p></p>
    
    <label for="preco">Preço:</label> 
    <input type="number" name="preco" id="preco" step="0.01" required> 
    <p></p>

    <label for="imagem">Imagem:</label> 
    <input type="file" name="imagem" id="imagem"> 
    <p></p>

    <label for="url_imagem">URL da Imagem:</label> 
    <input type="text" name="url_imagem" id="url_imagem"> 
    <p></p>

    <input type="submit" value="Cadastrar">
    
    </form>  

</body>
</html>

