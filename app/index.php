<?php /* app/index.php */ ?>
<!doctype html>
<html lang="sk">
<head>
  <meta charset="utf-8">
  <title>Registrácia študenta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-success text-white py-3 mb-3">
  <div class="container d-flex flex-column flex-md-row align-items-md-center gap-2">
    <h1 class="h3 mb-0">Registrácia študenta</h1>
    <a class="btn btn-outline-light btn-sm ms-md-auto" href="students_list.php">
      Zobraziť registrovaných študentov
    </a>
  </div>
</header>

<main class="container my-4">
  <section class="mb-4">
    <h2 class="h4">Vyplňte registračný formulár</h2>

    <form id="regForm" action="process_form.php" method="post" novalidate>
      <!-- Osobné údaje -->
      <fieldset class="border rounded p-3 mb-4">
        <legend class="w-auto px-2 text-success fw-semibold">Osobné údaje</legend>

        <div class="mb-3">
          <label for="meno" class="form-label">Meno</label>
          <input type="text" class="form-control" id="meno" name="meno" required minlength="2" placeholder="Zadaj meno">
          <div class="invalid-feedback">Prosím, vyplňte meno (min. 2 znaky).</div>
        </div>

        <div class="mb-3">
          <label for="priezvisko" class="form-label">Priezvisko</label>
          <input type="text" class="form-control" id="priezvisko" name="priezvisko" required minlength="2" placeholder="Zadaj priezvisko">
          <div class="invalid-feedback">Prosím, vyplňte priezvisko (min. 2 znaky).</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="napr. student@example.com">
          <div class="invalid-feedback">Zadajte platný e-mail.</div>
        </div>

        <div class="mb-3">
          <label for="datum" class="form-label">Dátum narodenia</label>
          <input type="date" class="form-control" id="datum" name="datum" required>
          <div class="invalid-feedback">Vyberte dátum narodenia.</div>
        </div>

        <div class="mb-3">
          <label for="program" class="form-label">Študijný program</label>
          <select id="program" name="program" class="form-select" required>
            <option value="">-- Vyber študijný program --</option>
            <option value="Automatizácia">Automatizácia</option>
            <option value="Manažérstvo procesov">Manažérstvo procesov</option>
            <option value="Iný">Iný</option>
          </select>
          <div class="invalid-feedback">Vyberte študijný program.</div>
        </div>
      </fieldset>

      <!-- Pohlavie -->
      <fieldset class="border rounded p-3 mb-4">
        <legend class="w-auto px-2 text-success fw-semibold">Pohlavie</legend>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="pohlavie" id="pohl_m" value="muz" required>
          <label class="form-check-label" for="pohl_m">Muž</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pohlavie" id="pohl_z" value="zena">
          <label class="form-check-label" for="pohl_z">Žena</label>
        </div>
      </fieldset>

      <!-- Záujmy -->
      <fieldset class="border rounded p-3 mb-4">
        <legend class="w-auto px-2 text-success fw-semibold">Záujmy</legend>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="z_sport" name="zaujmy[]" value="sport">
          <label class="form-check-label" for="z_sport">Šport</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="z_hudba" name="zaujmy[]" value="hudba">
          <label class="form-check-label" for="z_hudba">Hudba</label>
        </div>
        <div class="form-check mb-1">
          <input class="form-check-input" type="checkbox" id="z_prog" name="zaujmy[]" value="programovanie">
          <label class="form-check-label" for="z_prog">Programovanie</label>
        </div>
      </fieldset>

      <!-- Odoslanie -->
      <fieldset class="border rounded p-3 mb-4">
        <legend class="w-auto px-2 text-success fw-semibold">Odoslanie</legend>
        <button type="submit" class="btn btn-success me-2">Odoslať</button>
        <button type="reset" class="btn btn-outline-secondary">Vymazať</button>
      </fieldset>
    </form>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
