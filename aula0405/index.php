<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <a href="create.php">Adicionar novo empregado</a>
    <?php
        require_once "config.php";
                    
        $sql = "SELECT * FROM empregados";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Nome</th>";
                echo "<th>Endereço</th>";
                echo "<th>Salário</th>";
                echo "<th>Ação</th>";
                echo "</tr>";
                echo "</thead>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['endereco'] . "</td>";
                    echo "<td>" . $row['salario'] . "</td>";
                    echo "<td>";
                    echo "<a href='read.php?id=". $row['id'] ."'>Visualizar</a>";
                    echo "<a href='update.php?id=". $row['id'] ."'>Atualizar</a>";
                    echo "<a href='delete.php?id=". $row['id'] ."'>Apagar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result);
            } else{
                echo "<p><em>Não há dados para serem apresentados.</em></p>";
            }
        } else{
            echo "ERRO: Não foi possível executar $sql. " . mysqli_error($link);
        }
    mysqli_close($link);
?>
</body>
</html>