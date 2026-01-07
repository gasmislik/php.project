<!-- etud_actions.php -->
<?php
require_once('sql_queries.php');
$sqlQueries = new SqlQueries();
$search = $_GET['search'] ?? '';
$result = $sqlQueries->getDocumentActions($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/main.css"/>
    <link rel="icon" href="..\img\3.png" />
    <!-- Include colResizable library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/colresizable/1.6.0/css/colResizable.css" />
</head>
<body id="main1" class="background-slider text-white body-home">
   <?php include '../partials_admin/header.php'; ?>
<div class="container p-5 mt-5 border border-1 borser-white fade-in" style=" backdrop-filter: blur(5px); border-radius: 10px;">
<form action="" method="GET" class="input-group mb-3">
    <input type="text" name="search" onkeyup="searchFunction()" value="<?php if (isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>" class="form-control" placeholder="Search by Matricule, First Name, Last Name, or Document Name">
    <button type="submit" class="btn btn-outline-light" style="background-color:rgb(133, 162, 255);">Search</button>
</form>
    <div class="card">
        <div class="card-body" style=" background:linear-gradient(to right,#e2e2e2,#c9d6ff); ">
        <div class="table-responsive"> 
        <table class="table table-striped text-dark">
    <thead>
        <tr>
            <th>Matricule</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Year</th>
            <th>Group</th>
            <th>Section</th>
            <th>Speciality</th>
            <th>Document Name</th>
            <th>Accept</th>
            <th>Refuse</th>
        </tr>
    </thead>
    <tbody id="table-body">
        <?php if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr data-matricule="<?php echo htmlspecialchars($row['matricule']); ?>" data-document-name="<?php echo htmlspecialchars($row['document_name']); ?>">
                    <td><?php echo htmlspecialchars($row['matricule']); ?></td>
                    <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                    <td><?php echo htmlspecialchars($row['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($row['annee']); ?></td>
                    <td><?php echo htmlspecialchars($row['groupe']); ?></td>
                    <td><?php echo htmlspecialchars($row['section']); ?></td>
                    <td><?php echo htmlspecialchars($row['specialite']); ?></td>
                    <td><?php echo htmlspecialchars($row['document_name']); ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" onclick='acceptDocument("<?php echo htmlspecialchars($row['matricule']); ?>", "<?php echo htmlspecialchars($row['document_name']); ?>")'>Accept</button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick='refuseDocument("<?php echo htmlspecialchars($row['matricule']); ?>", "<?php echo htmlspecialchars($row['document_name']); ?>")'>Refuse</button>
                    </td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='11' class='text-center'>No documents found</td></tr>";
        } ?>
    </tbody>
</table>
</div>
        </div>
    </div>
</div>
   
   <?php include '../partials_admin/sidebar.php'; ?>
   <?php include '../partials_admin/footer.php'; ?>