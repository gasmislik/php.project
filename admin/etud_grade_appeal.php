<!--etud_grade_appeal.php-->
<?php
require_once('sql_queries.php');
$sqlQueries = new SqlQueries();
$search = $_GET['search'] ?? '';
$result = $sqlQueries->getGradeAppealRequests($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Appeal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/main.css"/>
    <link rel="icon" href="..\img\3.png" />
</head>
<body id="main1" class="background-slider body-home">
<div class="text-white">  
 <?php include '../partials_admin/header.php'; ?>
<div class="container p-5 mt-5 border border-1 borser-white fade-in" style=" backdrop-filter: blur(5px); border-radius: 10px;">

    <!-- Search Form -->
    <form action="" method="GET" class="input-group mb-3">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="form-control" placeholder="Search by any field">
        <button type="submit" class="btn btn-outline-light" style="background-color: rgb(133, 162, 255);">Search</button>
    </form>

    <!-- Table -->
    <div class="card">
    <div class="card-body" style="background:linear-gradient(to right,#e2e2e2,#c9d6ff);">
    <div class="table-responsive">
    <table class="table table-striped text-dark">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Year</th>
                <th>Group</th>
                <th>Section</th>
                <th>Speciality</th>
                <th>Module Name</th>
                <th>Teacher Name</th>
                <th>Current Grade</th>
                <th>Requested Grade</th>            
                <th>Accept</th>
                <th>Reject</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td><?php echo htmlspecialchars($row['matricule']); ?></td>
                        <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                        <td><?php echo htmlspecialchars($row['lastName']); ?></td>
                        <td><?php echo htmlspecialchars($row['annee']); ?></td>
                        <td><?php echo htmlspecialchars($row['groupe']); ?></td>
                        <td><?php echo htmlspecialchars($row['section']); ?></td>
                        <td><?php echo htmlspecialchars($row['specialite']); ?></td>
                        <td><?php echo htmlspecialchars($row['moduleName']); ?></td>
                        <td><?php echo htmlspecialchars($row['teacherName']); ?></td>
                        <td><?php echo htmlspecialchars($row['wrongNote']); ?></td>
                        <td><?php echo htmlspecialchars($row['correctNote']); ?></td>
                        <td><button class="btn btn-success btn-sm" onclick="acceptDocumentById(<?php echo $row['id']; ?>)">Accept</button></td>
                        <td><button class="btn btn-danger btn-sm" onclick="refuseDocumentById(<?php echo $row['id']; ?>)">Reject</button></td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='13' class='text-center'>No grade appeal requests found</td></tr>";
            } ?>
        </tbody>
    </table>
    </div>
</div>
</div></div>
   <?php include '../partials_admin/sidebar.php'; ?></div>     
   <?php include '../partials_admin/footer.php'; ?>