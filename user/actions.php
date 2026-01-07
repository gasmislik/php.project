<!-- actions.php -->
<?php 
require_once('sql_queries.php');
$docResult = getDocDocuments($conn, $matricule);
$resultGradeAppeal = getGradeAppealInfo($conn, $matricule);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Documents</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/main.css"/>
  <link rel="icon" href="../img/3.png" />
</head>
<body id="main1" class="img2 text-white background-slider">
  <section class="pt-2 mx-auto text-center sticky-top w-100 p-3 mb-5" id="first">
    <nav class="navbar navbar-expand-lg border rounded-5 p-3 bg-transparent shadow box-area border-white"> 
      <div class="text-start ps-2">
        <img id="person" src="../img/18.png" alt="Person" width="50" height="50" onclick="show()"> 
      </div>
      <div class="up ps-5">
        <a href="main.php" class="d-inline-block ps-5 text-white link-offset-2 link-underline link-underline-opacity-0">Home</a>
        <a href="documents.php" class="d-inline-block ps-5 text-white link-offset-2 link-underline link-underline-opacity-0">Documents</a>
        <a href="grade_appeal.php" class="d-inline-block ps-5 text-white link-offset-2 link-underline link-underline-opacity-0">Grade Appeal</a>
      </div>
      <div class="position-absolute top-0 end-0 ps-2"></div>
    </nav>
  </section>

  <!-- Documents Section -->
  <div class="p-5 mt-5 text-white border border1 border-white fade-in" style="background: rgba(0, 0, 0, 0); backdrop-filter: blur(5px);">
    <div class="card-header">   
      <h4>Your Documents</h4>
    </div>
    <div class="row">
      <?php 
      if ($docResult->num_rows > 0) {
          while ($row = $docResult->fetch_assoc()) {
              $status = $row['status'];
              $statusText = '';
              $statusColor = '';
              switch ($status) {
                  case 'Pending':
                      $statusText = 'Pending';
                      $statusColor = 'gray';
                      break;
                  case 'Accepted':
                      $statusText = 'Accepted';
                      $statusColor = 'green';
                      break;
                  case 'Refused':
                      $statusText = 'Refused';
                      $statusColor = 'red';
                      break;
                  default:
                      $statusText = 'Unknown status';
                      $statusColor = 'black';
                      break;
              }
      ?>
      <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card text-dark" style="background: linear-gradient(to right,#e2e2e2,#c9d6ff);">
          <button type="button" class="btn-close" style="position: absolute; top: 10px; right: 10px;" onclick="confirmRemoval('<?php echo $row['id']; ?>', this)"></button>
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
            <p>
              <?php if ($status === 'Pending') { ?>
                <l-dot-pulse size="40" speed="1.3" color="gray"></l-dot-pulse>
                <span style="color: <?php echo $statusColor; ?>;"><?php echo htmlspecialchars($statusText); ?></span>
              <?php } else { ?>
                <span style="color: <?php echo $statusColor; ?>;"><?php echo htmlspecialchars($statusText); ?></span>
              <?php } ?>
            </p>
          </div>
        </div>
      </div> 
      <?php }
      } else {
          echo "<div class='col-12'><p class='text-center text-danger'>No documents found for your matricule.</p></div>";
      }
      ?>
    </div>
  </div>

  <!-- Grade Appeals Section -->
  <div class="p-5 mt-5 text-white border border1 border-white fade-in" style="background: rgba(0, 0, 0, 0); backdrop-filter: blur(5px);">
    <div class="card-header">
      <h4>Grade Appeals</h4>
    </div>
    <div class="row">
      <?php 
      if ($resultGradeAppeal->num_rows > 0) {
          while ($row = $resultGradeAppeal->fetch_assoc()) {
              $status = $row['status'];
              $statusText = '';
              $statusColor = '';
              switch ($status) {
                  case 'Pending':
                      $statusText = 'Pending';
                      $statusColor = 'gray';
                      break;
                  case 'Accepted':
                      $statusText = 'Accepted';
                      $statusColor = 'green';
                      break;
                  case 'Refused':
                      $statusText = 'Refused';
                      $statusColor = 'red';
                      break;
                  default:
                      $statusText = 'Unknown status';
                      $statusColor = 'black';
                      break;
              }
      ?>
      <div class="col-md-4 mb-3">
        <div class="card text-dark" style="background: linear-gradient(to right,#e2e2e2,#c9d6ff);">
          <div class="card-body">
            <h5 class="card-title">Details</h5>
            <p><strong>Module Name:</strong> <?php echo htmlspecialchars($row['moduleName']); ?></p>
            <p><strong>Teacher Name:</strong> <?php echo htmlspecialchars($row['teacherName']); ?></p>
            <p><strong>Incorrect Grade:</strong> <?php echo htmlspecialchars($row['wrongNote']); ?></p>
            <p><strong>Correct Grade:</strong> <?php echo htmlspecialchars($row['correctNote']); ?></p>
            <p>
              <?php if ($status === 'Pending') { ?>
                <l-dot-pulse size="40" speed="1.3" color="gray"></l-dot-pulse>
                <span style="color: <?php echo $statusColor; ?>;"><?php echo htmlspecialchars($statusText); ?></span>
              <?php } else { ?>
                <span style="color: <?php echo $statusColor; ?>;"><?php echo htmlspecialchars($statusText); ?></span>
              <?php } ?>
            </p>
            <button type="button" class="btn-close" style="position: absolute; top: 10px; right: 10px;" onclick="confirmRemove(this, <?php echo $row['id']; ?>)"></button>
          </div>
        </div>
      </div>
      <?php }
      } else {
          echo "<p class='text-center text-danger'>No grade appeals found for your matricule.</p>";
      }
      ?>
    </div>
  </div>

  <?php include '../partials/sidebar.php'; ?>
  <?php include '../partials/footer.php'; ?>