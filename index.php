<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'), {
                keyboard: false
            });

            // Se desejar exibir o modal automaticamente ao carregar a página
            myModal.show();
        });

        // Certifique-se de que você tem a versão correta do Bootstrap
        // Se estiver usando uma versão anterior, o código abaixo pode ser necessário
        if (typeof bootstrap === 'undefined') {
            document.write(
                '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"><\/script>'
            );
        }

    </script>


    <!--Cadastro-->
    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Cadastar</a>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Cadastro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="cadastrar.php">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Título</span>
                            <input type="text" class="form-control" aria-label="name" aria-describedby="basic-addon1"
                                name="name" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Data</span>
                            <input type="date" class="form-control" aria-label="date" aria-describedby="basic-addon1"
                                name="date" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                type="submit">Confirmar</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
       
    


    <!--card-->
    <div class="container mt-4">
        <?php
        include("db.php");
        $sql = "SELECT * FROM cadastro";
        $resultado = $db->query($sql);

        if ($resultado->rowCount() > 0) {
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

                echo '<div class="card mb-3">';
                echo '<div class="card-header">' . $registro['name'] . '</div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $registro['name'] . '</h5>';
                echo '<p class="card-text">Data: ' . $registro['date'] . '</p>';
                echo '</div>';

            }
        } else {
            echo '<p>Nenhum registro encontrado.</p>';
        }
        ?>
    </div>
    
    <?php
    include("db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Certifique-se de que o ID foi enviado através do formulário
        if (isset($_POST["id"])) 
        {
            $id = $_POST["id"];

            // Preparando a consulta SQL para exclusão
            $sql = "DELETE FROM CADASTRO WHERE ID = :id";
            $stmt = $db->prepare($sql);

            // Vinculando o parâmetro :id
            $stmt->bindParam(':id', $id);

            // Executando a consulta SQL
            $resultado = $stmt->execute();

            // Verificando se a exclusão foi bem-sucedida
            if (!$resultado) {
                var_dump($stmt->errorInfo());
                exit;
            } else {
                echo $stmt->rowCount() . " linha deletada";
            }
        } else {
            echo "ID não fornecido para exclusão.";
        }
    }
    ?>


    <!--Editar-->





</body>

</html>