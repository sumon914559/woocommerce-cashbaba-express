<?php
 session_start();
/**
 *	Template Name: Thanks
 */	
 
get_header();

$receivedData = $_POST ;

if($_POST != NUll ){

$_SESSION['CustomerName']   = $receivedData['CustomerName'];
$_SESSION['OrderId'] 		= $receivedData['OrderId'];
$_SESSION['TransactionId']  = $receivedData['TransactionId'];


?>


<?php if($_SESSION['CustomerName'] !="" ){ ?> 
			<!--<div class="btn btn-success btn-block" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <strong>Congratulation! </strong>  <?php echo $receivedData['CustomerName']; ?> , Your ORDER ID :
			  <b><?php echo $receivedData['OrderId']; ?> , TRANSACTION ID : <?php echo $receivedData['TransactionId'];?></b>.
			</div>-->




<div class="jumbotron text-sm-center">
  <h1 class="display-2" style="text-align:center">Thank You!</h1>
  <p class="lead"  style="text-align:center"><strong><?php echo $_SESSION['CustomerName']; ?></strong></p> 
  <p  style="text-align:center"><b> ORDER ID :<?php echo $_SESSION['OrderId']; ?></b></p>
  <p  style="text-align:center"><b> TRANSACTION ID  : <?php echo $_SESSION['TransactionId']; ?></b></p>
  <p  style="text-align:center">
    Contact us : support@r-cis.com
  </p>
 
</div>


<?php } unset($_SESSION['CustomerName']); unset($_SESSION['OrderId']); unset($_SESSION['TransactionId']);?>

<?php } else{ ?>


<?php if($_SESSION['CustomerName'] !="" ){ ?> 

<div class="jumbotron text-sm-center">
  <h1 class="display-2" style="text-align:center">Thank You!</h1>
  <p class="lead"  style="text-align:center"><strong><?php echo $_SESSION['CustomerName']; ?></strong></p> 
  <p  style="text-align:center"><b> ORDER ID :<?php echo $_SESSION['OrderId']; ?></b></p>
  <p  style="text-align:center"><b> TRANSACTION ID  : <?php echo $_SESSION['TransactionId']; ?></b></p>
  <p  style="text-align:center">
    Contact us : support@r-cis.com
  </p>
 
</div>


<?php } 
	unset($_SESSION['CustomerName']);
	unset($_SESSION['OrderId']);
	unset($_SESSION['TransactionId']);
?>


<?php

	} 
	
	get_footer();
	
 ?>