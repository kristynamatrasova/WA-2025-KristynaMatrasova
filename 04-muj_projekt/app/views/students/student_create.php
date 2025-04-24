<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat studenta</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Školní systém</a>
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
                            <a class="nav-link" href="../controllers/students_list.php">Výpis studentů</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Přidat nového studenta</h2>
                    </div>
                    <div class="card-body">
                        <form action="../controllers/StudentController.php" method="post">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Jméno studenta: <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="surname" class="form-label">Příjmení: <span class="text-danger">*</span></label>
                                <input type="text" id="surname" name="surname" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Datum narození: <span class="text-danger">*</span></label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email: <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon: </label>
                                <input type="tel" id="phone" name="phone" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Adresa: </label>
                                <textarea id="address" name="address" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Uložit studenta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
