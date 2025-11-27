<?php
// process_form.php
require __DIR__ . '/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /index.php');
  exit;
}

$meno       = trim($_POST['meno'] ?? '');
$priezvisko = trim($_POST['priezvisko'] ?? '');
$email      = trim($_POST['email'] ?? '');
$datum      = trim($_POST['datum'] ?? '');
$program    = trim($_POST['program'] ?? '');
$pohlavie   = $_POST['pohlavie'] ?? '';
$zaujmyArr  = $_POST['zaujmy'] ?? [];
$zaujmyCsv  = is_array($zaujmyArr) ? implode(',', $zaujmyArr) : '';

$errors = [];
if (mb_strlen($meno) < 2)         $errors[] = "Meno musí mať aspoň 2 znaky.";
if (mb_strlen($priezvisko) < 2)   $errors[] = "Priezvisko musí mať aspoň 2 znaky.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Neplatný e-mail.";
if (!$datum)                      $errors[] = "Zadajte dátum narodenia.";
if (!$program)                    $errors[] = "Vyberte študijný program.";
if (!in_array($pohlavie, ['muz','zena'], true)) $pohlavie = 'muz';

if ($errors) {
  http_response_code(422);
  echo "<h1>Formulár obsahuje chyby</h1><ul>";
  foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>";
  echo "</ul><p><a href='index.php'>&larr; Späť na formulár</a></p>";
  exit;
}

$sql = "INSERT INTO students (meno, priezvisko, email, datum_narodenia, program, pohlavie, zaujmy)
        VALUES (:meno, :priezvisko, :email, :datum, :program, :pohlavie, :zaujmy)";

$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([
    ':meno'      => $meno,
    ':priezvisko'=> $priezvisko,
    ':email'     => $email,
    ':datum'     => $datum,
    ':program'   => $program,
    ':pohlavie'  => $pohlavie,
    ':zaujmy'    => $zaujmyCsv ?: null,
  ]);
} catch (PDOException $e) {
  if ($e->getCode() === '23000') {
    http_response_code(409);
    echo "<h1>Registrácia zlyhala</h1><p>Tento e-mail už je zaregistrovaný.</p>";
    echo "<p><a href='index.php'>&larr; Späť</a></p>";
    exit;
  }
  throw $e;
}

?>
<!doctype html>
<html lang="sk">
<head>
  <meta charset="utf-8">
  <title>Ďakujeme</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="mx-auto" style="max-width: 680px;">
      <div class="card shadow-sm">
        <div class="card-body">
          <h1 class="h4 mb-3 text-success">Ďakujeme za registráciu!</h1>
          <p>Študent <strong><?=htmlspecialchars($meno . ' ' . $priezvisko)?></strong> bol úspešne uložený.</p>
          <a class="btn btn-outline-success" href="index.php">Späť na formulár</a>
          <a class="btn btn-secondary ms-2" href="http://localhost:8081" target="_blank" rel="noopener">Otvoriť phpMyAdmin</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
