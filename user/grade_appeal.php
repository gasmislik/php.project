<!-- grade_appeal.php -->
<?php
require 'sql_queries.php';
require '../backend/fetchNotifications.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $moduleName = $_POST['moduleName'] ?? '';
    $teacherName = $_POST['teacherName'] ?? '';
    $wrongGrade = $_POST['wrongGrade'] ?? 0;
    $correctGrade = $_POST['correctGrade'] ?? 0;

    handleGradeAppealSubmission($conn, $moduleName, $teacherName, $wrongGrade, $correctGrade);
    header("Location: grade_appeal.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Appeal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/main.css" />
    <link rel="icon" href="../img/3.png" />
</head>
<body id="main1" class="img1 text-white background-slider">

<?php include '../partials/header.php'; ?>

<div class="container text-center fade-in border border-1 border-white p-3 mt-5">
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
        <h1 class="form-title text-white">Grade Appeal Form</h1>
        <form method="post" action="">
            <div class="input-group">
                <i class="fas fa-book"></i>
                <input type="text" name="moduleName" id="moduleName" placeholder="Module Name" required>
                <label for="moduleName" class="text-white">Module Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="teacherName" id="teacherName" placeholder="Professor's Name" required>
                <label for="teacherName" class="text-white">Professor's Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-times-circle"></i>
                <input type="number" name="wrongGrade" id="wrongGrade" placeholder="Incorrect Grade (0-20)" min="0" max="20" required>
                <label for="wrongGrade" class="text-white">Incorrect Grade</label>
            </div>
            <div class="input-group">
                <i class="fas fa-check-circle"></i>
                <input type="number" name="correctGrade" id="correctGrade" placeholder="Correct Grade (0-20)" min="0" max="20" required>
                <label for="correctGrade" class="text-white">Correct Grade</label>
            </div>
            <input type="submit" class="btn" value="Submit Appeal">
        </form>
    </div>
</div>

<?php include '../partials/sidebar.php'; ?>
<?php include '../partials/footer.php'; ?>