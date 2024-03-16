<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="form__container"> 
        <h2>Painel Administrador</h2>

            <form action="processa_login.php" method="post">
                <label for="nome">Insira seu nome de usuario:</label>
                <input type="text" id="nome" name="nome" required>
                <p></p>
                <label for="senha">Insira sua senha:</label>
                <input type="password" id="senha" name="senha" required>
                <p></p>

                <input type="submit" value="Entrar">
            </form> 
        
    </section>

    <?php
    if (isset($_GET['erro'])) {
        echo '<p style="color:red;">Nome de usuário ou senha incorretos!</p>';
    }
    ?>
</body>

</html>