<!--insert_student.php-->
<?php
session_start();
require_once('sql_queries.php');
$sqlQueries = new SqlQueries();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricule = $_POST['matricule'];
    $annee = $_POST['annee'];
    $groupe = $_POST['groupe'];
    $section = $_POST['section'];
    $specialite = $_POST['specialite'];

    $result = $sqlQueries->insertStudent($matricule, $annee, $groupe, $section, $specialite);

    if ($result) {
        $_SESSION['status'] = 'Student added successfully!';
    } else {
        $_SESSION['status'] = 'Error adding student';
    }

    header('Location: insert_student.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/style_index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="icon" href="..\img\3.png" />
</head>
<body id="main1" class="img1 text-white background-slider">
<section class="pt-2 mx-auto text-center sticky-top w-100 p-3 mb-5" id="first">
<nav class="navbar navbar-expand-lg border rounded-5 p-3 bg-transparent shadow box-area border-white"> 
        <div class="text-start ps-2">
            <img id="person" src="..\img\18.png" alt="Profile" width="50" height="50" onclick="show()"> 
        </div>
<div class="up ms-5">
   <a href="etud_actions.php" class="d-inline-block ps-5 text-white link-offset-2 link-underline link-underline-opacity-0">Documents</a>
   <a href="etud_grade_appeal.php" class="d-inline-block ps-5 text-white link-offset-2 link-underline link-underline-opacity-0">Grade Appeal</a>
   <a href="insert_student.php" class="d-inline-block ps-5 text-white link-offset-2 link-underline link-underline-opacity-0">Add Student</a>
  </div>
 </nav>
</section>

    <div class="container text-center fade-in border border-1 border-white p-3 fade-in">
    <?php 
    if (isset($_SESSION['status'])) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Notice:</strong> {$_SESSION['status']}
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        unset($_SESSION['status']);
    }
?>
<div class="p-5 justify-content-center">
        <h1 class="form-title text-white">Enter Student Information</h1>
        <form method="post" action="insert_student.php">
    <div class="input-group">
        <i class="fas fa-id-card"></i>
        <input type="text" name="matricule" id="matricule" placeholder="Student ID" required>
        <label for="matricule" class="text-white">Student ID</label>
    </div>
    <div class="input-group">
        <i class="fas fa-calendar-alt"></i>
        <input type="date" name="annee" id="annee" required>
        <label for="annee" class="text-white">Academic Year</label>
    </div>
    <div class="input-group">
        <i class="fas fa-users"></i>
        <input type="number" name="groupe" id="groupe" placeholder="Group" required>
        <label for="groupe" class="text-white">Group</label>
    </div>
    <div class="input-group">
        <i class="fas fa-users"></i>
        <input type="number" name="section" id="section" placeholder="Section" required>
        <label for="section" class="text-white">Section</label>
    </div>
    <div class="input-group">
        <i class="fas fa-cogs"></i>
        <input type="text" name="specialite" id="specialite" placeholder="Specialization" required>
        <label for="specialite" class="text-white">Specialization</label>
    </div>
    <input type="submit" class="btn" value="Add Student">
</form>
</div>
    </div>

   <?php include '../partials_admin/sidebar.php'; ?>
   <?php include '../partials_admin/footer.php'; ?>