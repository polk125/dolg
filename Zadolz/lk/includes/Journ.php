
<form method="post" class="journ_month" id="MyForm">
Месяц 
<select name="journ_month" onchange="document.getElementById('MyForm').submit()">
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='9'){echo"selected";}}elseif(date("m")==9){echo 'selected';}?> value="9">Сентябрь</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='10'){echo"selected";}}elseif(date("m")==10){echo 'selected';}?> value="10">Октябрь</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='11'){echo"selected";}}elseif(date("m")==11){echo 'selected';}?> value="11">Ноябрь</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='12'){echo"selected";}}elseif(date("m")==12){echo 'selected';}?> value="12">Декабрь</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='1'){echo"selected";}}elseif(date("m")==1){echo 'selected';}?> value="1">Январь</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='2'){echo"selected class=selected";}}elseif(date("m")==2){echo 'selected';}?> value="2">Февраль</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='3'){echo"selected";}}elseif(date("m")==3){echo 'selected';}?> value="3">Март</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='4'){echo"selected";}}elseif(date("m")==4){echo 'selected';}?> value="4">Апрель</option>
<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='5'){echo"selected";}}elseif(date("m")==5){echo 'selected';}?> value="5">Май</option>
</select>
</form>
<div class="block-table"><div class="divTableCell">ФИО учеников</div>
<div class="divTableCell right"><div>Посещаемость</div>
<?php
if(isset($_POST['journ_month'])){
$howdays=cal_days_in_month(CAL_GREGORIAN, $_POST['journ_month'], date("y"));
}
else{
$howdays=date("t");
}

for($day=1; $day<=$howdays; $day++){
	Echo "<div class=\"number\">";
	echo $day;
	echo "</div>";
}
?>

</div></div>
<div class="block-table">
<?php
							
							include("../db.php");
							$result = mysqli_query($conn, "SELECT * FROM students ORDER BY fio ");
							while($row=mysqli_fetch_array($result))
							{
							
						?>
								<div class="divTableCell"><?php echo $row["fio"]; ?></div>
								<div class="divTableCell right">
								<?php
								for($day=1; $day<=$howdays; $day++){
									$id=$row["id"];
									if(isset($_POST['journ_month'])){
										$month=$_POST['journ_month'];
									}
									else{
										$month=date("m");
									}
									$year=date("y");
									$resultin = mysqli_query($conn, "SELECT id FROM pass WHERE studid=$id AND month=$month AND day=$day AND year=$year");
									if(null ==mysqli_fetch_array($resultin)){
									Echo "<div class=\"number\">&nbsp";
									
									echo "</div>";
									}
									else {
									echo "<div class=\"number red\">";
									echo "Н";
									echo "</div>";
									}
									
								}
								?>
								</div>
								</div>
								
								<div class="block-table">
						<?php
							}
							mysqli_close($conn);
							?>

