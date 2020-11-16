<html>
    <body>
        <h2>Regular Customer Rent Info</h2>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>SSN</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Name</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Title</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Year</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Rent Date</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Rent days</b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
            <?php
                include "dbConn.php";
                date_default_timezone_set("America/New_York");
                error_reporting(E_ALL ^ E_NOTICE);
                if ($_REQUEST['ssn'] != "" && $_REQUEST['title'] != ""&& $_REQUEST['year'] != "") {
                    if ($_REQUEST['name'] == "") {
                        $Name = "No Name";
		    } 
		    else {
                        $Name = mysql_real_escape_string($_REQUEST['name']);
                    }

		    if ($_REQUEST['date'] == "") {
		        $date = date("Y-m-d");
		    } 
		    else {
		        $RentingDate = htmlentities($_REQUEST['rdate']);
		        $date = date('Y-m-d', strtotime($RentingDate));
		    }
		    
		    if ($_REQUEST['rday'] == "") {
		        $RentingTime = "DEFAULT";
		    } 
		    else {
		        $RentingTime = intval($_REQUEST['rday']);
		    }
		    
		    if ($_REQUEST['telephone'] == "") {
		        $Telephone = "0000000000";
		    } 
		    else {
		        $Telephone = mysql_real_escape_string($_REQUEST['telephone']);
		         }
                    $SSN = intval($_REQUEST['ssn']);
                    $Title = mysql_real_escape_string($_REQUEST['title']);
                    $Year = intval($_REQUEST['year']);
	    
                    mysql_query("INSERT IGNORE INTO CD (title,year) VALUES('$Title', $Year)");
                    mysql_query("INSERT IGNORE INTO Customer (ssn, name, telephone, rdate, rday) VALUES($SSN,'$Name','$Address', '$Telephone', '$date', $RentingTime)");
                    mysql_query("INSERT IGNORE INTO Rent (ssn, title, year) VALUES($SSN, '$Title', $Year)");
                    echo "INSERT IGNORE INTO Rent (ssn, title, year) VALUES($SSN, '$Title', $Year)";
       }

                    $result = mysql_query("SELECT Rent.ssn as ssn, title, year, rdate, rday, Name FROM Rent, Customer Where Rent.ssn = Customer.ssn ORDER BY rdate");
                    $i = 0;
                    if($result === false){
	                    throw new Exception(mysql_error($connection));							                   }
                    while ($row = mysql_fetch_array($result)) {
	                    echo "<tr valign='middle'>";
	                    echo "<td>".$row['ssn']."</td>";
	                    echo "<td>".$row['name']."</td>";
	                    echo "<td>".$row['nitle']."</td>";
	                    echo "<td>".$row['year']."</td>";
	                    echo "<td>".$row['rdate']."</td>";
	                    echo "<td>".$row['rday']."</td>";
	                    echo "</td>";
	                    echo "</tr>";
                          $i++;
                       }
	   ?>
        </table>
        <br>
        <br>
        <h3>Add Regular Customer Rent Info</h3>
        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td>SSN:</td><td><input type="text" size="30" name="ssn"></td></tr>
                <tr><td>Name:</td><td><input type="text" size="30" name="name"></td></tr>
                <tr><td>Telephone:</td><td><input type="text" size="30" name="telephone"></td></tr>
                <tr><td>Title:</td><td><input type="text" size="30" name="title"></td></tr>
                <tr><td>Year of Production:</td><td><input type="text" size="30" name="year"></td></tr>
                <tr><td>Date of Renting:</td><td> <input type="text" size="30" name="rdate"></td></tr>
                <tr><td>Period of Renting:</td><td> <input type="text" size="30" name="rday"></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="Add Regular Customer Info"></td></tr>
            </table>
        </form>
               <button onclick="document.location='menu.php'">Return to Menu</button>
    </body>
</html>
