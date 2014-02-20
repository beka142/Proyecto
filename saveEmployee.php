<?php
//require 'Employee.php';



$employee = $_REQUEST['employee'];
$company = $_REQUEST['company'];

echo $employee['first_name'];
foreach ($employee as $key => $value) {
    echo "$key = $value <br />";
}

//$link = mysqli_connect("localhost", "root", "root", "test");
//$emp = new Employee($employee['first_name'],$employee['last_name'],$employee['genre'],$employee['notify']);
//print_r($emp);
//echo "Saving";
//
//$emp->save($link);
//


?>

<script type="text/javascript"> 
if(confirm('Saved Succesfully, do you want to add another one?')) {
    window.location.href = 'employee.html';
}

</script>