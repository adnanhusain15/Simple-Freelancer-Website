<?php include('server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
	if ($_SESSION["Usertype"]==1) {
		$linkPro="freelancerProfile.php";
		$linkEditPro="editFreelancer.php";
		$linkBtn="applyJob.php";
		$textBtn="Apply for this job";
	}
	else{
		$linkPro="employerProfile.php";
		$linkEditPro="editEmployer.php";
		$linkBtn="editJob.php";
		$textBtn="Edit the job offer";
	}
}
else{
    $username="";
	//header("location: index.php");
}

if(isset($_POST["jid"])){
	$_SESSION["job_id"]=$_POST["jid"];
	header("location: jobDetails.php");
}

$sql = "SELECT * FROM job_offer WHERE valid=1 ORDER BY timestamp DESC";
$result = $conn->query($sql);

if(isset($_POST["s_title"])){
	$t=$_POST["s_title"];
	$sql = "SELECT * FROM job_offer WHERE title='$t' and valid=1";
	$result = $conn->query($sql);
}

if(isset($_POST["s_type"])){
	$t=$_POST["s_type"];
	$sql = "SELECT * FROM job_offer WHERE type='$t' and valid=1";
	$result = $conn->query($sql);
}

if(isset($_POST["s_employer"])){
	$t=$_POST["s_employer"];
	$sql = "SELECT * FROM job_offer WHERE e_username='$t' and valid=1";
	$result = $conn->query($sql);
}

if(isset($_POST["s_id"])){
	$t=$_POST["s_id"];
	$sql = "SELECT * FROM job_offer WHERE job_id='$t' and valid=1";
	$result = $conn->query($sql);
}

if(isset($_POST["recentJob"])){
	$sql = "SELECT * FROM job_offer WHERE valid=1 ORDER BY timestamp DESC";
	$result = $conn->query($sql);
}

if(isset($_POST["oldJob"])){
	$sql = "SELECT * FROM job_offer WHERE valid=1";
	$result = $conn->query($sql);
}

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>All Job Offers</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="awesome/css/fontawesome-all.min.css">

<style>
	body{padding-top: 3%;margin: 0;}
	.card{box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background:#fff}
</style>

</head>
<body style="background-color:#ADD8E6">

<!--Navbar menu-->
<nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
	<div class="container">
		<div class="navber-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.php" class="navbar-brand">Freelance Marketplace</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="allJob.php">Browse all jobs</a></li>
				<li><a href="allFreelancer.php">Browse Freelancers</a></li>
				<li><a href="allEmployer.php">Browse Employers</a></li>
				<li class="dropdown" style="background:#000;padding:0 20px 0 20px;">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?>
			        </a>
			        <ul class="dropdown-menu list-group list-group-item-info">
			        	<a href="<?php echo $linkPro; ?>" class="list-group-item"><span class="glyphicon glyphicon-home"></span>  View profile</a>
			          	<a href="<?php echo $linkEditPro; ?>" class="list-group-item"><span class="glyphicon glyphicon-inbox"></span>  Edit Profile</a>
					  	<a href="message.php" class="list-group-item"><span class="glyphicon glyphicon-envelope"></span>  Messages</a> 
					  	<a href="logout.php" class="list-group-item"><span class="glyphicon glyphicon-ok"></span>  Logout</a>
			        </ul>
			    </li>
			</ul>
		</div>		
	</div>	
</nav>
<!--End Navbar menu-->


<!--main body-->
<div style="padding:1% 3% 1% 3%;">
<div class="row">

<!--Column 1-->
	<div class="col-lg-9">

<!--Freelancer Profile Details-->	
		<div class="card" style="padding:20px 20px 5px 20px;margin-top:20px">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>All Job Offers</h3></div>
			  <div class="panel-body"><h4>
                  <table style="width:100%">
                      <tr>
                          <td>Job Id</td>
                          <td>Title</td>
                          <td>Type</td>
                          <td>Budget</td>
                          <td>Emplyer</td>
                          <td>Posted on</td>
                      </tr>
                      <?php 
                      if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $job_id=$row["job_id"];
                                $title=$row["title"];
                                $type=$row["type"];
                                $budget=$row["budget"];
                                $e_username=$row["e_username"];
                                $timestamp=$row["timestamp"];

                                echo '
                                <form action="allJob.php" method="post">
                                <input type="hidden" name="jid" value="'.$job_id.'">
                                    <tr>
                                    <td>'.$job_id.'</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="'.$title.'"></td>
                                    <td>'.$type.'</td>
                                    <td>'.$budget.'</td>
                                    <td>'.$e_username.'</td>
                                    <td>'.$timestamp.'</td>
                                    </tr>
                                </form>
                                ';

                                }
                        } else {
                            echo "<tr></tr><tr><td></td><td>Nothing to show</td></tr>";
                        }

                       ?>
                     </table>
              </h4></div>
			</div>
			<p></p>
		</div>
<!--End Freelancer Profile Details-->

	</div>
<!--End Column 1-->




</div>
</div>
<!--End main body-->


<!--Footer-->

<!--End Footer-->


<script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<?php 

if($e_username!=$username && $_SESSION["Usertype"]!=1){
	echo "<script>
		        $('#applybtn').hide();
		</script>";
} 
?>


</body>
</html>