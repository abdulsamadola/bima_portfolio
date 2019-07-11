<?php
include('db.php');
include('session.php');
	$query = mysql_query("select * from tbl_students, card where tbl_students.sid ='$sid' and card.cid='$cid'")or die('error connecting...');
	$row = mysql_fetch_array($query);
	$count =$row['CardCount'];
	$termused =$row['TermUsed'];
	$CardStatus =$row['CardStatus'];
	$CardUsedby =$row['CardUsedby'];
	$csid = $row['cid'];
	$regno = $_SESSION['ExamNumber'];
	$termy = $_SESSION['Term'];
 
if($count >= 6 ){unset($_SESSION['ExamNumber']); header("location: index.php?msg=This Card has been disabled because the maximum number of usage has been exceeded!");
	}
if($termused != $termy ){unset($_SESSION['ExamNumber']); header("location: index.php?msg=Sorry, this card has been used to check $termused Term result, and thereby is not more valid for this term");
	}
if($CardUsedby != $regno and $CardStatus == 'Used'){
		
		mysql_query("update card set CardCount=CardCount-1 where cid = '$csid'");
		header("location: index.php?msg=Sorry the card has already been used by other user, kindly purchase new card and try again!");
	
unset($_SESSION['ExamNumber']);		
}


 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:EDCON TECHNOLOGY RESULT PORTAL:.</title>
<link rel="shortcut icon" href="img/favicon.ico" />
<link rel="stylesheet" type="text/css" media="print" href="SpryAssets/page.css">
<link rel="stylesheet" type="text/css" media="screen" href="SpryAssets/print.css">
<style>
.result{width:798px;margin:0 auto;border-right:1px solid #333;border-left:1px solid #333;border-bottom:1px solid #333; font-family:Arial, Helvetica, sans-serif;}
.logo{height:120px;width:800px;margin:0 auto;}
.title{
	padding: 8px;
	font-size: 13px;
	color: #fff;
	background-color: #51A351;
	font-weight: bold;
}
.disclaimer{padding:20px; border-bottom:1px solid #093;}
.detailpanel{width:650px; border-collapse:collapse;margin:0 auto; font-size:12px; font-weight:bold; }
.detail .short input{height:20px;width:200px;border:#999 1px solid; color:#777;}
.detail .long input{height:20px;width:550px;border:#999 1px solid; color:#777;}
p{ font-size:12px; text-align:center;}
.detail{padding-bottom:20px;padding-top:20px;}
.scores{
	padding-bottom: 20px;
	color: #C60;
}
.resultpanel{width:650px; border-collapse:collapse;margin:0 auto; font-size:12px; font-weight:bold; border:1px solid #063; background:url(images/reg.png) repeat; }
.resultpanel tr{height:24px;}
.resultpanel th{ text-align:left;padding:8px; border-left:1px solid #096;border-bottom:1px #063 solid; color:#063;font-size:13px;}
.resultpanel td{
	text-align: left;
	padding: 8px;
	border-left: 1px solid #51A351;
	border-bottom: 1px solid #51A351;
	text-align: center;
}
.resultpanel .sub{ text-align:left;}
.resultpanel .even{color:#666;}
.resultpanel .head{
	background-color: #FCFCFC;
}
.panel p{text-align:left;font-size:11px; text-align:left;}
.foot{color:#093; padding:10px;font-size:11px;}
.control{width:800px;margin:0 auto; font:12px Arial, Helvetica, sans-serif;color:#666;}
.control a{color:#666;}
.control a:hover{color:#000;}
</style>
 <style type="text/css"> 
 
    #printable { display: block; } 
 
    @media print 
    { 
        #non-printable { display: none; } 
        #printable { display: block; } 
    } 
    a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
 </style>
</head>

<body link="#999999" vlink="#999999" alink="#999999">
<script language=JavaScript>


var message="Function Disabled!";


function clickIE4(){
if (event.button==2){

return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("return false")

</script>
<form>
<div>

</div>

<div>

</div>
<div id="non-printable">
<table width="84%" >
<tr>
  <td width="189">&nbsp;</td>
  <td width="517">&nbsp;</td>
  <td width="99"><a href="javascript:print();"><img src="img/print.jpg" /></a> <a href="javascript:print();" class="">Print</a></td>
<td width="78"><a href="logout.php"><img src="img/logout.jpg" /></a> <a href="logout.php">Logout</a></td>
</tr>
</table>
</div>
<?php if($row['class_category'] == 'Kindergarten'){?>
<div id="printable" style=" background-blend-mode: lighten; background-repeat: no-repeat; background-position: center;background-image: url(img/watermark.jpg)">
<div class="logo"><img src="img/logo.jpg" alt="Logo" /></div>
<div class="result">
<br />
	<p></p>
<div class="title"><strong>Examination Result Details: <?php echo strtoupper($row['Surname']).', '.$row['Firstname'].' '.$row['Othernames'];?></strong></div>
<div class="detail">
    <table class="detailpanel">
    <tr valign="top">
    <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Surname: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Surname']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Othernames: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['Othernames']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Number: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['ExamNumber']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Session: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Session']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Term : </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Term']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
  
    </table>
    </td>
    <td width="22"></td>
    <td width="309">
      <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Class: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Class']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
		<!--
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Number_In_Class: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['NumberInClass']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
-->
        
        <tr>
          <td align="right" class="LabelTag"> <div align="left">TotalMarkObtained: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['TotalMarkObtained']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Overall_Total: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['OverallTotal']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Average: </div></td>
          <td align="left"><input type="text" value="<?php echo $row[+'Average']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <!--
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Grade: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Position']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
-->
<tr>
          <td align="right" class="LabelTag"> <div align="left">Next_Term_Begins: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['NextTermBegins']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
  
    </table>
    </td>        
    </td>
    </tr>
    </table>
   </div>
<div class="scores">
                  &nbsp;
                       <table class="resultpanel">
                      <tr valign="middle" class="head">
                        <td width="33%" >SUBJECTS</td>
                        <td width="10%">1ST CA  /20</td>
                        <td width="10%">2ND CA  /20</td>
                        <td width="10%">EXAM  /60</td>
                        <td width="11%">TOTAL</td>
                        <td width="11%">GRADE</td>
                        <td width="25%">REMARK</td></tr>
                  
                  <tr width="100%">
                                                              <?php 
					 
																 if($row['Subject1']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject1'];?>
                                                                  
                                                              </td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca11'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca12'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade1=$row['Grade1']; echo $grade1; ?>
                                                                 
                                                             </td>
                                                           
                                                           
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade1=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade1=='A1'){
																		 echo 'Excellent';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade1=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>      <?php
                                                             }
                                                             
                                                             ?>               </tr>
                 
                  <tr width="100%">
                                                             <?php if($row['Subject2']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject2'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca21'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca22'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade2=$row['Grade2']; echo $grade2;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade2=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade2=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade2=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade2=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade2=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject3']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject3'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca31'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca32'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade3=$row['Grade3']; echo $grade3; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade3=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade3=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade3=='B2'){
																		 echo 'Very Good';
																		 } else if($grade3=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade3=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade3=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject4']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject4'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca41'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca42'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade4=$row['Grade4']; echo $grade4;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                     <?php 
																 if($grade4=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade4=='A1'){
																		 echo 'Excellent';
																		 } else if($grade4=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade4=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?>  
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject5']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject5'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca51'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca52'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade5=$row['Grade5']; echo $grade5; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade5=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade5=='A1'){
																		 echo 'Excellent';
																		 } else if($grade5=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade5=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject6']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject6'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca61'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca62'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade6=$row['Grade6']; echo $grade6;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                   <?php 
																 if($grade6=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade6=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade6=='B2'){
																		 echo 'Very Good';
																		 } else if($grade6=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade6=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade6=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject7']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject7'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca71'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca72'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade7=$row['Grade7']; echo $grade7; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade7=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade7=='A1'){
																		 echo 'Excellent';
																		 } else if($grade7=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade7=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject8']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject8'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca81'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca82'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade8=$row['Grade8']; echo $grade8;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade8=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade8=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade8=='B2'){
																		 echo 'Very Good';
																		 } else if($grade8=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade8=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade8=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject9']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub"><?php echo $row['Subject9'];?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca91'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca92'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Exam9'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Total9'] ;?></td>
                                                              <td align="center" class="sub"><?php $grade9=$row['Grade9']; echo $grade9;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                 <?php 
																 if($grade9=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade9=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade9=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade9=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  <tr width="100%">
                   <?php if($row['Subject10']==''){
																	 echo '';
											
																 }else{
																	 ?>
                    <td align="left" class="sub"><?php echo $row['Subject10'];?></td>
                    <td align="center" class="sub"><?php echo $row['Ca101'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Ca102'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Exam10'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Total10'] ;?></td>
                    <td align="center" class="sub"><?php $grade10=$row['Grade10']; echo $grade10;?></td>
                    <td align="left" class="sub"><?php 
																 if($grade10=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade10=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade10=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade10=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?></td>
																  <?php
                                                             }
                                                             
                                                             ?>         
                  </tr>
                  
                  </table>
                  
                                      
                     
</div>
	<div class="detail" id="non-printable">
		 <table width="678"  class="detailpanel">
    <tr valign="">
    <td width="676" height="135">
           <table border="0" cellpadding="3" cellspacing="0" width="100%" class="long">
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card_Pin No:</td>
                      <td width="87%" align="left" style="width: 77%">
                          <input type="text" value="<?php

$pass = $row['CardPin'];
$masked =  str_pad(substr($pass, -4), strlen($cc), '*', STR_PAD_LEFT);
print '********'.$masked;

?>" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card Usage:</td>
                      <td align="left" style="width: 77%">
                          <input type="text" value="You Have logged in <?php echo $count; ?> time(s)" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" width="13%">
                      </td>
                      <td align="left" class="LabelTag" style="width: 77%">
                          * Please note that only the last four (4) characters of the Card PIN is displayed.</td>
                  </tr>
              </table>
     </td>
     </tr>
     </table>

	</div>
	
	<?php }elseif($row['class_category'] == 'Primary'){?>
<div id="printable" style=" background-blend-mode: lighten; background-repeat: no-repeat; background-position: center;background-image: url(img/watermark.jpg)">
<div class="logo"><img src="img/logo.jpg" alt="Logo" /></div>
<div class="result">
<br />
	<p></p>
<div class="title"><strong>Examination Result Details: <?php echo strtoupper($row['Surname']).', '.$row['Firstname'].' '.$row['Othernames'];?></strong></div>
<div class="detail">
    <table class="detailpanel">
    <tr valign="top">
    <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Surname: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Surname']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Othernames: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['Othernames']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Number: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['ExamNumber']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Session: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Session']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Term : </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Term']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
  
    </table>
    </td>
    <td width="22"></td>
    <td width="309">
      <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Class: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Class']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
		<!--
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Number_In_Class: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['NumberInClass']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
 -->
       
       
        <tr>
          <td align="right" class="LabelTag"> <div align="left">TotalMarkObtained: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['TotalMarkObtained']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Overall_Total: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['OverallTotal']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Average: </div></td>
          <td align="left"><input type="text" value="<?php echo $row[+'Average']; ?>" readonly="readonly" class="msInput" /></td>
        </tr> 
        <!--
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Grade: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Position']; ?>" readonly="readonly" class="msInput" /></td>
        </tr> 
    -->
    <tr>
          <td align="right" class="LabelTag"> <div align="left">Next_Term_Begins: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['NextTermBegins']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
    </table>

    </td>        
    </td>
    </tr>
    </table>
   </div>
<div class="scores">
                  &nbsp;
                       <table class="resultpanel">
                      <tr valign="middle" class="head">
                        <td width="33%" >SUBJECTS</td>
                        <td width="10%">1ST CA  /20</td>
                        <td width="10%">2ND CA  /20</td>
                        <td width="10%">3RD CA  /20</td>
                        <td width="10%">EXAM  /40</td>
                        <td width="11%">TOTAL</td>
                        <td width="11%">GRADE</td>
                        <td width="25%">REMARK</td></tr>
                  
                  <tr width="100%">
                                                              <?php 
					 
																 if($row['Subject1']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject1'];?>
                                                                  
                                                              </td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca11'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca12'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca13'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade1=$row['Grade1']; echo $grade1; ?>
                                                                 
                                                             </td>
                                                           
                                                           
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade1=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade1=='A1'){
																		 echo 'Excellent';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade1=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>      <?php
                                                             }
                                                             
                                                             ?>               </tr>
                 
                  <tr width="100%">
                                                             <?php if($row['Subject2']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject2'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca21'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca22'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca23'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade2=$row['Grade2']; echo $grade2;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade2=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade2=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade2=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade2=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade2=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject3']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject3'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca31'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca32'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca33'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade3=$row['Grade3']; echo $grade3; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade3=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade3=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade3=='B2'){
																		 echo 'Very Good';
																		 } else if($grade3=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade3=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade3=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject4']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject4'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca41'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca42'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca43'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade4=$row['Grade4']; echo $grade4;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                     <?php 
																 if($grade4=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade4=='A1'){
																		 echo 'Excellent';
																		 } else if($grade4=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade4=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?>  
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject5']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject5'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca51'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca52'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca53'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade5=$row['Grade5']; echo $grade5; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade5=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade5=='A1'){
																		 echo 'Excellent';
																		 } else if($grade5=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade5=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject6']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject6'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca61'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca62'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca63'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade6=$row['Grade6']; echo $grade6;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                   <?php 
																 if($grade6=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade6=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade6=='B2'){
																		 echo 'Very Good';
																		 } else if($grade6=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade6=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade6=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject7']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject7'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca71'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca72'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca73'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade7=$row['Grade7']; echo $grade7; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade7=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade7=='A1'){
																		 echo 'Excellent';
																		 } else if($grade7=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade7=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject8']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject8'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca81'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca82'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca83'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade8=$row['Grade8']; echo $grade8;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade8=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade8=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade8=='B2'){
																		 echo 'Very Good';
																		 } else if($grade8=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade8=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade8=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject9']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub"><?php echo $row['Subject9'];?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca91'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca92'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca93'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Exam9'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Total9'] ;?></td>
                                                              <td align="center" class="sub"><?php $grade9=$row['Grade9']; echo $grade9;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                 <?php 
																 if($grade9=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade9=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade9=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade9=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  <tr width="100%">
                   <?php if($row['Subject10']==''){
																	 echo '';
											
											 					 }else{
																	 ?>
                    <td align="left" class="sub"><?php echo $row['Subject10'];?></td>
                    <td align="center" class="sub"><?php echo $row['Ca101'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Ca102'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Ca103'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Exam10'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Total10'] ;?></td>
                    <td align="center" class="sub"><?php $grade10=$row['Grade10']; echo $grade10;?></td>
                    <td align="left" class="sub"><?php 
																 if($grade10=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade10=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade10=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade10=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?></td>
																  <?php
                                                             }
                                                             
                                                             ?>         
                  </tr>
                  
                  
                  
                  
                  
                   <tr width="100%">
                                                             <?php if($row['Subject11']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject11'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca111'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca112'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca113'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam11'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total11'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade11=$row['Grade11']; echo $grade11;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade11=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade11=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade11=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade11=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade11=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                 
                   <tr width="100%">
                                                             <?php if($row['Subject12']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject12'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca121'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca122'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca123'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam12'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total12'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade12=$row['Grade12']; echo $grade12;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade12=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade12=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade12=='B2'){
																		 echo 'Very Good';
																		 } else if($grade12=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade12=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade12=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                 
                   <tr width="100%">
                                                             <?php if($row['Subject13']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject13'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca131'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca132'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca133'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam13'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total13'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade13=$row['Grade13']; echo $grade13;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade13=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade13=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade13=='B2'){
																		 echo 'Very Good';
																		 } else if($grade13=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade13=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade13=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                          
                   <tr width="100%">
                                                             <?php if($row['Subject14']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject14'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca141'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca142'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca143'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam14'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total14'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade14=$row['Grade14']; echo $grade14;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade14=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade14=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade14=='B2'){
																		 echo 'Very Good';
																		 } else if($grade14=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade14=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade14=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                   
                   
                            
                   <tr width="100%">
                                                             <?php if($row['Subject15']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject15'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca151'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca152'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca153'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam15'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total15'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade15=$row['Grade15']; echo $grade15;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade15=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade15=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade15=='B2'){
																		 echo 'Very Good';
																		 } else if($grade15=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade15=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade15=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                   <tr width="100%">
                                                             <?php if($row['Subject16']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject16'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca161'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca162'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca163'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam16'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total16'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade16=$row['Grade16']; echo $grade16;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade16=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade16=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade16=='B2'){
																		 echo 'Very Good';
																		 } else if($grade16=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade16=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade16=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                   
                  
                    </table>
                  
                                      
                     
</div>
	<div class="detail" id="non-printable">
		 <table width="678"  class="detailpanel">
    <tr valign="">
    <td width="676" height="135">
           <table border="0" cellpadding="3" cellspacing="0" width="100%" class="long">
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card_Pin No:</td>
                      <td width="87%" align="left" style="width: 77%">
                          <input type="text" value="<?php

$pass = $row['CardPin'];
$masked =  str_pad(substr($pass, -4), strlen($cc), '*', STR_PAD_LEFT);
print '********'.$masked;

?>" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card Usage:</td>
                      <td align="left" style="width: 77%">
                          <input type="text" value="You Have logged in <?php echo $count; ?> time(s)" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" width="13%">
                      </td>
                      <td align="left" class="LabelTag" style="width: 77%">
                          * Please note that only the last four (4) characters of the Card PIN is displayed.</td>
                  </tr>
              </table>
     </td>
     </tr>
     </table>

	</div>
	
	<?php }elseif($row['class_category'] == 'JSS'){?>
	
	<div id="printable" style=" background-blend-mode: lighten; background-repeat: no-repeat; background-position: center;background-image: url(img/watermark.jpg)">
<div class="logo"><img src="img/logo.jpg" alt="Logo" /></div>
<div class="result">
<br />
	<p></p>
<div class="title"><strong>Examination Result Details: <?php echo strtoupper($row['Surname']).', '.$row['Firstname'].' '.$row['Othernames'];?></strong></div>
<div class="detail">
    <table class="detailpanel">
    <tr valign="top">
    <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Surname: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Surname']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Othernames: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['Othernames']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Number: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['ExamNumber']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Session: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Session']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Term : </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Term']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
  
    </table>
    </td>
    <td width="22"></td>
    <td width="309">
      <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Class: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Class']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
		<!--
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Number_In_Class: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['NumberInClass']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
		-->
    
        <tr>
          <td align="right" class="LabelTag"> <div align="left">TotalMarkObtained: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['TotalMarkObtained']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Overall_Total: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['OverallTotal']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Average: </div></td>
          <td align="left"><input type="text" value="<?php echo $row[+'Average']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <!-- 
		<tr>
          <td align="right" class="LabelTag"> <div align="left">Grade: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Position']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>  
    -->
    <tr>
          <td align="right" class="LabelTag"> <div align="left">Next_Term_Begins: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['NextTermBegins']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
    </table>

    </td>        
    </td>
    </tr>
    </table>
   </div>
<div class="scores">
                  &nbsp;
                       <table class="resultpanel">
                      <tr valign="middle" class="head">
                        <td width="33%" >SUBJECTS</td>
                        <td width="10%">1ST CA  /10</td>
                        <td width="10%">2ND CA  /10</td>
                        <td width="10%">3RD CA  /10</td>
                        <td width="10%">EXAM  /70</td>
                        <td width="11%">TOTAL</td>
                        <td width="11%">GRADE</td>
                        <td width="25%">REMARK</td></tr>
                  
                  <tr width="100%">
                                                              <?php 
					 
																 if($row['Subject1']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject1'];?>
                                                                  
                                                              </td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca11'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca12'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca13'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade1=$row['Grade1']; echo $grade1; ?>
                                                                 
                                                             </td>
                                                           
                                                           
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade1=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade1=='A1'){
																		 echo 'Excellent';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade1=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>      <?php
                                                             }
                                                             
                                                             ?>               </tr>
                 
                  <tr width="100%">
                                                             <?php if($row['Subject2']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject2'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca21'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca22'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca23'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade2=$row['Grade2']; echo $grade2;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade2=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade2=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade2=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade2=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade2=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject3']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject3'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca31'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca32'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca33'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade3=$row['Grade3']; echo $grade3; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade3=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade3=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade3=='B2'){
																		 echo 'Very Good';
																		 } else if($grade3=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade3=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade3=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject4']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject4'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca41'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca42'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca43'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade4=$row['Grade4']; echo $grade4;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                     <?php 
																 if($grade4=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade4=='A1'){
																		 echo 'Excellent';
																		 } else if($grade4=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade4=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?>  
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject5']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject5'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca51'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca52'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca53'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade5=$row['Grade5']; echo $grade5; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade5=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade5=='A1'){
																		 echo 'Excellent';
																		 } else if($grade5=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade5=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject6']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject6'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca61'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca62'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca63'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade6=$row['Grade6']; echo $grade6;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                   <?php 
																 if($grade6=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade6=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade6=='B2'){
																		 echo 'Very Good';
																		 } else if($grade6=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade6=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade6=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject7']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject7'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca71'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca72'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca73'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade7=$row['Grade7']; echo $grade7; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade7=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade7=='A1'){
																		 echo 'Excellent';
																		 } else if($grade7=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade7=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject8']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject8'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca81'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca82'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca83'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade8=$row['Grade8']; echo $grade8;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade8=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade8=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade8=='B2'){
																		 echo 'Very Good';
																		 } else if($grade8=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade8=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade8=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject9']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub"><?php echo $row['Subject9'];?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca91'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca92'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca93'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Exam9'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Total9'] ;?></td>
                                                              <td align="center" class="sub"><?php $grade9=$row['Grade9']; echo $grade9;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                 <?php 
																 if($grade9=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade9=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade9=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade9=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  <tr width="100%">
                   <?php if($row['Subject10']==''){
																	 echo '';
											
											 					 }else{
																	 ?>
                    <td align="left" class="sub"><?php echo $row['Subject10'];?></td>
                    <td align="center" class="sub"><?php echo $row['Ca101'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Ca102'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Ca103'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Exam10'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Total10'] ;?></td>
                    <td align="center" class="sub"><?php $grade10=$row['Grade10']; echo $grade10;?></td>
                    <td align="left" class="sub"><?php 
																 if($grade10=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade10=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade10=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade10=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?></td>
																  <?php
                                                             }
                                                             
                                                             ?>         
                  </tr>
                  
                     
                   <tr width="100%">
                                                             <?php if($row['Subject11']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject11'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca111'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca112'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca113'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam11'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total11'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade11=$row['Grade11']; echo $grade11;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade11=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade11=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade11=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade11=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade11=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                 
                   <tr width="100%">
                                                             <?php if($row['Subject12']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject12'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca121'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca122'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca123'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam12'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total12'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade12=$row['Grade12']; echo $grade12;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade12=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade12=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade12=='B2'){
																		 echo 'Very Good';
																		 } else if($grade12=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade12=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade12=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                 
                   <tr width="100%">
                                                             <?php if($row['Subject13']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject13'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca131'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca132'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca133'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam13'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total13'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade13=$row['Grade13']; echo $grade13;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade13=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade13=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade13=='B2'){
																		 echo 'Very Good';
																		 } else if($grade13=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade13=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade13=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                          
                   <tr width="100%">
                                                             <?php if($row['Subject14']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject14'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca141'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca142'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca143'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam14'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total14'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade14=$row['Grade14']; echo $grade14;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade14=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade14=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade14=='B2'){
																		 echo 'Very Good';
																		 } else if($grade14=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade14=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade14=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                   
                   
                            
                   <tr width="100%">
                                                             <?php if($row['Subject15']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject15'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca151'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca152'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca153'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam15'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total15'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade15=$row['Grade15']; echo $grade15;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade15=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade15=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade15=='B2'){
																		 echo 'Very Good';
																		 } else if($grade15=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade15=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade15=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                   <tr width="100%">
                                                             <?php if($row['Subject16']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject16'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca161'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca162'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca163'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam16'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total16'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade16=$row['Grade16']; echo $grade16;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade16=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade16=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade16=='B2'){
																		 echo 'Very Good';
																		 } else if($grade16=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade16=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade16=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                   
                  
                  
                  </table>
                  
                                      
                     
</div>
	<div class="detail" id="non-printable">
		 <table width="678"  class="detailpanel">
    <tr valign="">
    <td width="676" height="135">
           <table border="0" cellpadding="3" cellspacing="0" width="100%" class="long">
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card_Pin No:</td>
                      <td width="87%" align="left" style="width: 77%">
                          <input type="text" value="<?php

$pass = $row['CardPin'];
$masked =  str_pad(substr($pass, -4), strlen($cc), '*', STR_PAD_LEFT);
print '********'.$masked;

?>" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card Usage:</td>
                      <td align="left" style="width: 77%">
                          <input type="text" value="You Have logged in <?php echo $count; ?> time(s)" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" width="13%">
                      </td>
                      <td align="left" class="LabelTag" style="width: 77%">
                          * Please note that only the last four (4) characters of the Card PIN is displayed.</td>
                  </tr>
              </table>
     </td>
     </tr>
     </table>

	</div>
	
	<?php }elseif($row['class_category'] == 'SS'){?>
	<div id="printable" style=" background-blend-mode: lighten; background-repeat: no-repeat; background-position: center;background-image: url(img/watermark.jpg)">
<div class="logo"><img src="img/logo.jpg" alt="Logo" /></div>
<div class="result">
<br />
	<p></p>
<div class="title"><strong>Examination Result Details: <?php echo strtoupper($row['Surname']).', '.$row['Firstname'].' '.$row['Othernames'];?></strong></div>
<div class="detail">
    <table class="detailpanel">
    <tr valign="top">
    <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Surname: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Surname']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Othernames: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['Othernames']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>     
         
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Number: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['ExamNumber']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Session: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Session']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Exam_Term : </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Term']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
  
    </table>
    </td>
    <td width="22"></td>
    <td width="309">
      <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <tr>
            <td align="right" class="LabelTag" width="29%">
                <div align="left">Class: </div></td>
            <td align="left" width="71%">
                <input type="text" value="<?php echo $row['Class']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
		   <!--
        <tr>
            <td align="right" class="LabelTag">
                <div align="left">Number_In_Class: </div></td>
            <td align="left">
                <input type="text" value="<?php echo $row['NumberInClass']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        -->
      
     
        <tr>
          <td align="right" class="LabelTag"> <div align="left">TotalMarkObtained: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['TotalMarkObtained']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Overall_Total: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['OverallTotal']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
        <tr>
          <td align="right" class="LabelTag"> <div align="left">Average: </div></td>
          <td align="left"><input type="text" value="<?php echo $row[+'Average']; ?>" readonly="readonly" class="msInput" /></td>
        </tr> 
        <!--
		<tr>
          <td align="right" class="LabelTag"> <div align="left">Grade: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['Position']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
    -->
    <tr>
          <td align="right" class="LabelTag"> <div align="left">Next_Term_Begins: </div></td>
          <td align="left"><input type="text" value="<?php echo $row['NextTermBegins']; ?>" readonly="readonly" class="msInput" /></td>
        </tr>
    </table>
    </td>        
    </td>
    </tr>
    </table>
   </div>
<div class="scores">
                  &nbsp;
                       <table class="resultpanel">
                      <tr valign="middle" class="head">
                        <td width="33%" >SUBJECTS</td>
                        <td width="10%">1ST CA  /10</td>
                        <td width="10%">2ND CA  /10</td>
                        <td width="10%">3RD CA  /10</td>
                        <td width="10%">EXAM  /70</td>
                        <td width="11%">TOTAL</td>
                        <td width="11%">GRADE</td>
                        <td width="25%">REMARK</td></tr>
                  
                  <tr width="100%">
                                                              <?php 
					 
																 if($row['Subject1']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject1'];?>
                                                                  
                                                              </td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca11'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca12'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca13'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade1=$row['Grade1']; echo $grade1; ?>
                                                                 
                                                             </td>
                                                           
                                                           
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade1=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade1=='A1'){
																		 echo 'Excellent';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade1=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>      <?php
                                                             }
                                                             
                                                             ?>               </tr>
                 
                  <tr width="100%">
                                                             <?php if($row['Subject2']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject2'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca21'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca22'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca23'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade2=$row['Grade2']; echo $grade2;?>
                                                                  
                                                              </td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade2=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade2=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade2=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade2=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade2=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject3']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject3'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca31'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca32'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca33'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade3=$row['Grade3']; echo $grade3; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade3=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade3=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade3=='B2'){
																		 echo 'Very Good';
																		 } else if($grade3=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade3=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade3=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject4']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject4'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca41'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca42'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca43'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade4=$row['Grade4']; echo $grade4;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                     <?php 
																 if($grade4=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade4=='A1'){
																		 echo 'Excellent';
																		 } else if($grade4=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade4=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?>  
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject5']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject5'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca51'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca52'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca53'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade5=$row['Grade5']; echo $grade5; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade5=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade5=='A1'){
																		 echo 'Excellent';
																		 } else if($grade5=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade5=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject6']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject6'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca61'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca62'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca63'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade6=$row['Grade6']; echo $grade6;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                   <?php 
																 if($grade6=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade6=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade6=='B2'){
																		 echo 'Very Good';
																		 } else if($grade6=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade6=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade6=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject7']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject7'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca71'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca72'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca73'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade7=$row['Grade7']; echo $grade7; ?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade7=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade7=='A1'){
																		 echo 'Excellent';
																		 } else if($grade7=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade7=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject8']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject8'];?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca81'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca82'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Ca83'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php $grade8=$row['Grade8']; echo $grade8;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade8=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade8=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade8=='B2'){
																		 echo 'Very Good';
																		 } else if($grade8=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade8=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade8=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject9']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub"><?php echo $row['Subject9'];?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca91'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca92'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Ca93'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Exam9'] ;?></td>
                                                              <td align="center" class="sub"><?php echo $row['Total9'] ;?></td>
                                                              <td align="center" class="sub"><?php $grade9=$row['Grade9']; echo $grade9;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                 <?php 
																 if($grade9=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade9=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade9=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade9=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  <tr width="100%">
                   <?php if($row['Subject10']==''){
																	 echo '';
											
											 					 }else{
																	 ?>
                    <td align="left" class="sub"><?php echo $row['Subject10'];?></td>
                    <td align="center" class="sub"><?php echo $row['Ca101'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Ca102'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Ca103'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Exam10'] ;?></td>
                    <td align="center" class="sub"><?php echo $row['Total10'] ;?></td>
                    <td align="center" class="sub"><?php $grade10=$row['Grade10']; echo $grade10;?></td>
                    <td align="left" class="sub"><?php 
																 if($grade10=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade10=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade10=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade10=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?></td>
																  <?php
                                                             }
                                                             
                                                             ?>         
                  </tr>
                  
                  
                  
                  </table>
                  
                                      
                     
</div>
	<div class="detail" id="non-printable">
		 <table width="678"  class="detailpanel">
    <tr valign="">
    <td width="676" height="135">
           <table border="0" cellpadding="3" cellspacing="0" width="100%" class="long">
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card_Pin No:</td>
                      <td width="87%" align="left" style="width: 77%">
                          <input type="text" value="<?php

$pass = $row['CardPin'];
$masked =  str_pad(substr($pass, -4), strlen($cc), '*', STR_PAD_LEFT);
print '********'.$masked;

?>" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card Usage:</td>
                      <td align="left" style="width: 77%">
                          <input type="text" value="You Have logged in <?php echo $count; ?> time(s)" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" width="13%">
                      </td>
                      <td align="left" class="LabelTag" style="width: 77%">
                          * Please note that only the last four (4) characters of the Card PIN is displayed.</td>
                  </tr>
              </table>
     </td>
     </tr>
     </table>

	</div>
	

	<?php }?>
	
<div class="disclaimer">
<table class="resultpanel" width="100%"><tr valign="middle" width="75%">
  <td align="right" class="LabelTag" width="18%">Final Remark:</td>
  <td width="50%"><p><span class="msInput"><?php echo $row['ClassTeacherRemark'] ;?></span></p></td>
  <td align="right" class="LabelTag" width="20%">Promoted To:</td>
  <td width="23%" align=right><?php echo $row['NumberInClass'] ;?></td></tr>
  <tr valign="middle" width="75%">
    <td align="right" class="LabelTag" width="18%">Principal's Remark:</td>
    <td><span class="msInput"><?php echo $row['PrincipalRemark'] ;?></span></td>
    <td align="right" class="LabelTag" width="9%">Sign:</td>
    <td align=right><img src="img/principalsign.jpg" alt="PRINCIPAL SIGNATURE" /></td>
                         
  </tr>
  
</table> * Note: For transfered pupils and students, kindly bring your e-result slip 
                          to the school for the school stamp and signature on the slip to prove the authenticity 
                          of the result in your new school.

	</div>
<div class="foot"><?php 

	$result= mysql_query("select * from site_info")or die(mysql_error());
		if($result){
$display=mysql_fetch_array($result);}	
	echo $display['adminfootername']; ?></div>
</div></div>
</form>
</body>
</html>