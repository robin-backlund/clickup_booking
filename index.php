<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="assets/style/custom.css" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>

	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	mysqli_select_db($conn, "testie");

	?>

<div id="overlay"></div>
<form action="index.php" method="post">
		<input type="text" id="datepicker" method="post" name="date">
		<select method="post" name="time" id="dropdown">
			<option>1</option value="1">
			<option>2</option value="2">
			<option>3</option value="3">
			<option>4</option value="4">
			<option>5</option value="5">
			<option>6</option value="6">
		</select>
		<input type="text" id="datepicker" method="post" name="name">
		<p><input type="submit" /></p>

<?php
$taken_times = mysqli_query($conn, "SELECT time FROM scheduler");
$rows = mysqli_fetch_all($taken_times);
?>
<script>
var arr = '<?php echo json_encode($rows); ?>';
num_of_dropped_kids = document.getElementById("dropdown").childElementCount;
elements = document.getElementsByTagName("option");

for (i = 0; i < num_of_dropped_kids; i++){
	value = elements[i].value;
	contains_bool = jQuery.inArray(value, arr);
	console.log(value);
	console.log(contains_bool);
	if (contains_bool !== -1) {
		elements[i].setAttribute("style", "background-color: red;");
		elements[i].setAttribute("disabled", "");
	};
};
</script>

		<?php
				$date = $_POST['date'];
				$time = $_POST['time'];
				$name = htmlspecialchars($_POST['name']);

				$test = mysqli_query($conn, "INSERT INTO scheduler (date, time, name) VALUES ('$date', '$time', '$name')");
				$one = mysqli_error($conn);

				$testie = mysqli_query($conn, "SELECT date, time, name FROM scheduler WHERE time = '1'");
				$rowie = mysqli_fetch_row($testie);
		 ?>
</form>

<p>
	<?php echo $one; ?>
</p>



</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
var array = ["2016-11-15","2016-11-13"];

  $( function() {
    $( "#datepicker" ).datepicker({
    	dayNames: [ "Söndag", "Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag" ],
    	dayNamesMin: [ "Sö", "Må", "Ti ", "On", "To", "Fr", "Lö" ],
    	maxDate: "+2m",
    	minDate: new Date(),
    	monthNames: [ "Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December" ],
    	beforeShowDay: function(date){

        	var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        	return [ array.indexOf(string) == -1 ]
        	return $.datepicker.noWeekends
    	},


    });
  } );
</script>
<script type="text/javascript">
setInterval(function(){
	$("#ui-datepicker-div").css("position","absolute");
	$("#ui-datepicker-div").css("left","0");
	$("#ui-datepicker-div").css("top","0");
	$("#ui-datepicker-div").css("margin-top","-20px");
	$(".ui-datepicker-calendar").css("height","100%");
	if($("#ui-datepicker-div").css("display") == "block"){
		$("#overlay").css("display","block");
	}else{
		$("#overlay").css("display","none");
	}
},200);

</script>
</html>
