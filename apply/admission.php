<?php
session_start();
error_reporting(1);
include 'header.php';
include('../connect.php');


//update scratch card status
$sqli = " update scratchcard set status='1' where serial='".$_SESSION['serial']."'";
if (mysqli_query($conn, $sqli)) {
}

 date_default_timezone_set('Africa/Lagos');
 $current_date = date('Y-m-d');

if(isset($_POST["btnsubmit"]))
{

//Get application ID
function applicationID(){
$string = (uniqid(rand(), true));
return substr($string, 0,5);
}
	
$applicationID = "ADM/".date("Y")."/".applicationID();		


$fullname = mysqli_real_escape_string($conn,$_POST['txtfullname']);
$sex = mysqli_real_escape_string($conn,$_POST['cmdsex']);
$phone = mysqli_real_escape_string($conn,$_POST['txtphone']);
$email = mysqli_real_escape_string($conn,$_POST['txtemail']);
$place = mysqli_real_escape_string($conn,$_POST['txtplace']);
$state = mysqli_real_escape_string($conn,$_POST['txtstate']);
$schoolname = mysqli_real_escape_string($conn,$_POST['txtschoolname']);
$score = mysqli_real_escape_string($conn,$_POST['txtscore']);
$emisid = mysqli_real_escape_string($conn,$_POST['txtemisid']);
$dept = mysqli_real_escape_string($conn,$_POST['txtdept']);
$exam = mysqli_real_escape_string($conn,$_POST['txtexam']);

$photo='upload/default.jpg';
$credential='upload/Result-Report-card-software.png';

$status='0';


//check if jamb number already exist
$sql_u = "SELECT * FROM admission WHERE schoolname='$schoolname'";
$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {
$msg_error = "Jamb number already exist";

}else {	
//check if  email already exist
$sql_u = "SELECT * FROM admission WHERE email='$email'";
$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {
$msg_error = "Email already exist";

}else {
$sql = "INSERT INTO admission (fullname,gender,phone,email,place,state,school_name,score,EMIS_id,dept,sslc_details,sslc,status,photo,date_admission,applicationID)VALUES( '$fullname','$gender','$phone','$email','$place','$state','$schoolname','$score','$emisid','$dept','$exam','$credential','$status','$photo','$current_date','$applicationID')";
 
 if ($conn->query($sql) === TRUE) {
 
$_SESSION['email']=$email;
$_SESSION['fullname']=$fullname;
$_SESSION['ApplicationID']=$applicationID;

header("Location: upload.php"); 
    }else { 
?>
<script>
alert('Problem Occured , Try Again');

</script>
<?php
}
}
}
}
?>


<title>Application Form| Online student admission system</title>
<?php if ($msg <> "") { ?>
  <style type="text/css">
<!--
.style1 {
	font-size: 12px;
	color: #FF0000;
}
-->
  </style>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">Close</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?>
<center>
<p><h4><?php echo "<p> <font color=red font face='arial' size='3pt'>$msg_error</font> </p>"; ?></h4>  </p>
  <h4><?php echo "<p> <font color=green font face='arial' size='3pt'>$msg_success</font> </p>"; ?></h4>  </p>
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="well contact-form-container">
        <form class="form-horizontal contactform" action="" method="post" name="f" >
          <fieldset>

                         <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">Fullname:
                <input type="text" placeholder="enter your name"  id="pass1" class="form-control" name="txtfullname" value="<?php if (isset($_POST['txtfullname']))?><?php echo $_POST['txtfullname']; ?>" required="">
              </label>
            </div>
			<div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">Gender:
               <select name="cmdsex" id="gender" class="form-control" required="">
                                                    <option value=" ">--Select Gender--</option>
                                                     <option value="Male">Male</option>
                                                      <option value="Female">Female</option>
                                              </select>
              </label>
            </div>
			  <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">phone:
                <input type="number"  id="pass1" placeholder="Mobile" class="form-control" name="txtphone" value="<?php if (isset($_POST['txtphone']))?><?php echo $_POST['txtphone']; ?>" required="">
              </label>
            </div>
				  <div class="form-group">
              <label class="col-lg-12 control-label" for="uemail">Email:
             <input type="email" placeholder="your email" name="txtemail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  value="<?php if (isset($_POST['txtemail']))?><?php echo $_POST['txtemail']; ?>" required>
              </label>
            </div>
			 <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">Place:
                <input type="text" id="pass1" class="form-control" placeholder="your city" name="txtlga" value="<?php if (isset($_POST['txtplace']))?><?php echo $_POST['txtplace']; ?> " required="">
              </label>
            </div>
				<div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">State:
                <input type="text"  id="pass1" placeholder="your state" class="form-control" name="txtstate" value="<?php if (isset($_POST['txtstate']))?><?php echo $_POST['txtstate']; ?>" required="">
              </label>
            </div>
			
		<div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">School:
                <input type="text"  placeholder="school name" id="pass1" class="form-control" name="txtjambno"  value="<?php if (isset($_POST['txtschoolname']))?><?php echo $_POST['txtschoolname']; ?>" required="">
              </label>
            </div>
			<div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">Score:
                <input type="text"  id="pass1"  placeholder="12th mark" class="form-control" name="txtjambscore"  value="<?php if (isset($_POST['txtscore']))?><?php echo $_POST['txtscore']; ?>" required="">
              </label>
            </div>
						<div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">EMIS_id:
                <input type="text"  id="pass1" class="form-control" placeholder="last 5 number" name="txtfaculty"  value="<?php if (isset($_POST['txtemisid']))?><?php echo $_POST['txtemisid']; ?>" required="">
              </label>
            </div>
			<div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">Department:
                <input type="text"  id="pass1" class="form-control" placeholder="HSC Group" name="txtdept"  value="<?php if (isset($_POST['txtdept']))?><?php echo $_POST['txtdept']; ?>" required="">
              </label>
            </div>
			
			<div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">SSLC(Exam Name/Year):
                <input type="text"  id="pass1" class="form-control" name="txtexam"  value="<?php if (isset($_POST['txtexam']))?><?php echo $_POST['txtexam']; ?>" required="">
              </label>
            </div>
		 

            <div style="height: 10px;clear: both"></div>

            <div class="form-group">
           
			
			
              <div class="col-lg-10">
                <button class="btn btn-primary" type="submit" name="btnsubmit">Submit</button> 
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div></center>
</div>

<p>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p data-v-6f398a90="">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
