<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Incluir arquivo de configuração
    require_once "config.php";
    
    // Prepare uma declaração de seleção
    $sql = "SELECT * FROM empregados WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincular variáveis ​​à instrução preparada como parâmetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Definir parâmetros
        $param_id = trim($_GET["id"]);
        
        // Tentativa de executar a declaração preparada
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Busque a linha de resultados como uma matriz associativa. Desde o conjunto de resultados
                contém apenas uma linha, não precisamos usar o loop while */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Recuperar valor do campo individual
                $nome = $row["nome"];
                $endereco = $row["endereco"];
                $salario = $row["salario"];
            } else{
                // O URL não contém um parâmetro de identificação válido. Redirecionar para a página de erro
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Opa! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
     
    // Fecha declaração
    mysqli_stmt_close($stmt);
    
    // Fecha conexão
    mysqli_close($link);
} else{
    // O URL não contém o parâmetro id. Redirecionar para a página de erro
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Dados</title>
</head>
<body>
    <h1>Visualizar Dados</h1>
    <label>nome</label>
    <p><?php echo $row["nome"]; ?></p>
    <label>endereco</label>
    <p><?php echo $row["endereco"]; ?></p>
    <label>salario</label>
    <p><?php echo $row["salario"]; ?></p>
    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
</body>
</html>