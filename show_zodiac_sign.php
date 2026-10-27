<?php include 'layouts/header.php'; ?>
$data_nascimento = $_POST['data_nascimento'] ?? '';

if (empty($data_nascimento)) {
    die("Data de nascimento não informada. <a href='index.php'>Voltar</a>");
}

$data = DateTime::createFromFormat('!Y-m-d', $data_nascimento);

if (!$data || $data->format('Y-m-d') !== $data_nascimento) {
    die("Data inválida. <a href='index.php'>Tentar novamente</a>");
}

$dia = (int) $data->format('d');
$mes = (int) $data->format('m');

$signos = simplexml_load_file("signos.xml");

if ($signos === false) {
    die("Não foi possível carregar o arquivo XML.");
}

$signoEncontrado = null;

foreach ($signos->signo as $signo) {
    $inicio = DateTime::createFromFormat('!d/m/Y', $signo->dataInicio . '/' . $data->format('Y'));
    $fim = DateTime::createFromFormat('!d/m/Y', $signo->dataFim . '/' . $data->format('Y'));

    if ($inicio && $fim && $fim < $inicio) {
        $fim->modify('+1 year');
    }

    $dataComparacao = clone $data;

    if ($inicio && $fim && $dataComparacao < $inicio) {
        $dataComparacao->modify('+1 year');
    }

    if ($inicio && $fim && $dataComparacao >= $inicio && $dataComparacao <= $fim) {
        $signoEncontrado = $signo;
        break;
    }
}

if ($signoEncontrado === null) {
    die("Não foi possível identificar o signo. <a href='index.php'>Voltar</a>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Signo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 mx-auto text-center" style="max-width: 600px;">
            <h1 class="mb-3">✨ Seu signo é <?php echo htmlspecialchars($signoEncontrado->signoNome); ?>! ✨</h1>

            <p class="fs-5">
                <?php echo htmlspecialchars($signoEncontrado->descricao); ?>
            </p>

            <a href="index.php" class="btn btn-primary mt-3">Consultar outra data</a>
        </div>
    </div>
</body>
</html>