<?php
include 'connection.php';
session_start();
if(isSet($_SESSION['username'])){
  $session_username = $_SESSION['username'];
}
else{
  header("location:login.html");
  exit();
}
?>
<html lang="en">
<head>
    <title>Online Course Registration</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
  <?php include 'menu.php'; ?>
    <div id="homepage_container" class="container">
      <h2>Online Course Registration</h2>
      <form action="#" method="GET">
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Degree:</label>
              <select class="form-control custom-select" name="Degree">
                <option value="Graduate" <?= $_REQUEST["Degree"] == "Graduate" ? " selected='selected'" : "" ?>>
                  Graduate
                </option>
                <option value="UnderGraduate" <?= $_REQUEST["Degree"] == "UnderGraduate" ? " selected='selected'" : "" ?> >
                  UnderGraduate
                </option>
                <option value="Phd" <?= $_REQUEST["Degree"] == "Phd" ? " selected='selected'" : "" ?> >
                  Phd
                </option>
                <option value="All" <?= $_REQUEST["Degree"] == "All" ? " selected='selected'" : "" ?> >
                  All
                </option>
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Major:</label>
                <select class="form-control custom-select" name="Major">
                  <option value="Computer Science"<?= $_REQUEST["Major"] == "Computer Science" ? " selected='selected'" : "" ?>>
                    Computer Science</option>
                  <option value="Mechanical Engineering"<?= $_REQUEST["Major"] == "Mechanical Engineering" ? " selected='selected'" : "" ?>>Mechanical Engineering</option>
                  <option value="itm"<?= $_REQUEST["Major"] == "itm" ? " selected='selected'" : "" ?>>ITM</option>
                  <option value="Electrical Engineering"<?= $_REQUEST["Major"] == "Electrical Engineering" ? " selected='selected'" : "" ?>>Electrical Engineering</option>
                  <option value="All"<?= $_REQUEST["Major"] == "All" ? " selected='selected'" : "" ?>>All</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label >Semester:</label>
              <select class="form-control custom-select" name="Semester">
                <option value="Fall17" <?= $_REQUEST["Semester"] == "Fall17" ? " selected='selected'" : "" ?> >
                  Fall17</option>
                  <option value="Spring18" <?= $_REQUEST["Semester"] == "Spring18" ? " selected='selected'" : "" ?> >
                    Spring18</option>
                <option value="All" <?= $_REQUEST["Semester"] == "All" ? " selected='selected'" : "" ?>  >All</option>
              </select>
            </div>
          </div>
        </div>
        <button id="search" class="btn btn-primary">Search</button>
      </form>

<?php
$course_id = $instructor_id = $semester = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $major  = $_GET["Major"];
    $degree = $_GET["Degree"];
    $sem    = $_GET["Semester"];

    $sql2    = "CALL old_view_courses('$degree','$major','$sem') ";
    $result2 = mysqli_query($conn, $sql2);


    if (mysqli_num_rows($result2) > 0) {
        echo "<form action='myCart.php' method='POST'>
        <table class='table'>
         <thead class='bg-primary'>
          <tr class='text-white'>
            <th>Course Name</th>
            <th>Instructor Name</th>
            <th>Availability</th>
            <th>Days</th>
            <th>Enroll</th>
          </tr>
          </thead>";
        while ($row = mysqli_fetch_assoc($result2)) {

            $course = $row['course_id'] . " " . $inst = $row['instructor_id'] . " " . $row['semester'];

            echo "<tr scope='row'>";
            echo "<td> " . $row['course_name'] . "</td>";
            echo "<td> " . $row['name'] . "</td>";
            echo "<td>" . $row['remaining_seats'] . "</td>";
            echo "<td>" . $row['class_days'] . "</td>";
            echo "<td> <input type='checkbox' value='$course' name='checkbox1[]'> </td>";
            echo "</tr>";
        }


        echo "</table>";
        echo "<button id='AddCart'  class='btn btn-primary'>Add to Cart</button>";
        echo "</form>";

    }


}
?>
</div>
</body>
</html>
