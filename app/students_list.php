<?php
// students_list.php
require __DIR__ . '/connection.php';

$search = trim($_GET['search'] ?? '');

$sql = "SELECT * FROM students";
$params = [];

if ($search !== '') {
    $sql .= " WHERE meno LIKE :search
              OR priezvisko LIKE :search
              OR email LIKE :search";
    $params['search'] = '%' . $search . '%';
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$students = $stmt->fetchAll();
?>
<!doctype html>
<html lang="sk">
<head>
  <meta charset="utf-8">
  <title>Zoznam študentov</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-success text-white py-3 mb-3">
  <div class="container d-flex flex-column flex-md-row align-items-md-center gap-2">
    <h1 class="h3 mb-0">Zoznam registrovaných študentov</h1>
    <div class="ms-md-auto d-flex gap-2">
      <a class="btn btn-outline-light btn-sm" href="index.php">Späť na registráciu</a>
      <a class="btn btn-outline-light btn-sm" href="http://localhost:8081" target="_blank" rel="noopener">phpMyAdmin</a>
    </div>
  </div>
</header>

<main class="container my-4">

  <!-- Tabuľka študentov -->
  <section>
    <?php if (empty($students)): ?>
      <div class="alert alert-info">
        Zatiaľ neboli nájdené žiadne záznamy.
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead class="table-success">
            <tr>
              <th>#</th>
              <th>Meno</th>
              <th>Priezvisko</th>
              <th>E-mail</th>
              <th>Dátum narodenia</th>
              <th>Program</th>
              <th>Pohlavie</th>
              <th>Záujmy</th>
              <th>Vytvorený</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($students as $row): ?>
              <tr>
                <td><?= (int)$row['id'] ?></td>
                <td><?= htmlspecialchars($row['meno']) ?></td>
                <td><?= htmlspecialchars($row['priezvisko']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['datum_narodenia']) ?></td>
                <td><?= htmlspecialchars($row['program']) ?></td>
                <td>
                  <?= $row['pohlavie'] === 'muz' ? 'Muž' : 'Žena' ?>
                </td>
                <td style="max-width: 220px;">
                  <?= nl2br(htmlspecialchars($row['zaujmy'] ?? '')) ?>
                </td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
