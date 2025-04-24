<?php
require_once '../../models/Database.php';
require_once '../../models/Student.php';

$db = (new Database())->getConnection();
$studentModel = new Student($db);
$students = $studentModel->getAll();

$editMode = false;
$studentToEdit = null;

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $studentToEdit = $studentModel->getById($editId);
    if ($studentToEdit) {
        $editMode = true;
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editace a mazání studentů</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Správa studentů</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Přepnout navigaci">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../views/students/student_create.php">Přidat studenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Výpis studentů</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php if ($editMode): ?>
            <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                    <h2>Upravit studenta: <?= htmlspecialchars($studentToEdit['first_name'] . ' ' . $studentToEdit['last_name']) ?></h2>
                    </div>
                    <div class="card-body">
                        <form action="../../controllers/student_update.php" method="post">
                            <input type="hidden" name="id" value="<?= $studentToEdit['id'] ?>">
                            <div class="mb-3">
                                <label class="form-label">ID studenta:</label>
                                <input type="text" class="form-control" value="<?= $studentToEdit['id'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Jméno:</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required value="<?= htmlspecialchars($studentToEdit['first_name']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Příjmení:</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required value="<?= htmlspecialchars($studentToEdit['last_name']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Datum narození:</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control" required value="<?= htmlspecialchars($studentToEdit['birth_date']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="class" class="form-label">Třída:</label>
                                <input type="text" id="class" name="class" class="form-control" required value="<?= htmlspecialchars($studentToEdit['class']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" id="email" name="email" class="form-control" required value="<?= htmlspecialchars($studentToEdit['email']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon:</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($studentToEdit['phone']) ?>">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Uložit změny</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <h2>Výpis studentů</h2>
        <?php if (!empty($students)): ?>
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Jméno</th>
                        <th>Příjmení</th>
                        <th>Třída</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['first_name']) ?></td>
                        <td><?= htmlspecialchars($student['last_name']) ?></td>
                        <td><?= htmlspecialchars($student['class']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['phone']) ?></td>
                        <td>
                            <a href="?edit=<?= $student['id'] ?>" class="btn btn-sm btn-primary">Upravit</a>
                            <a href="../../controllers/student_delete.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tohoto studenta?');">Smazat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        
        <?php else: ?>
            <div class="alert alert-info">Žádný student nebyl nalezen.</div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
