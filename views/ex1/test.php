<form class="" action="index.html" method="post">
  <input type="text" name="username" class="form-control">
  <input type="text" name="password" class="form-control">
</form>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["firstname"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<?php
foreach (Employee::findALl() as $model) {
  echo $model->firstname;
}

 ?>


<?php
$form = ActiveForm::begin();
echo $form->field($model, 'username')
echo $form->field($model, 'password')
ActiveForm::end();
?>
