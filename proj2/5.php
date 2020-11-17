<html>
    <body>
        <h2>Find Customer</h2>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Name</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Tele#</b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
            <?php
                include "dbConn.php";
                date_default_timezone_set("America/New_York");
                error_reporting(E_ALL ^ E_NOTICE);
                if ($_REQUEST['title'] != "" && $_REQUEST['year'] != "" && $_REQUEST['returnDate'] != "" ) {
                        $Title = mysql_real_escape_string($_REQUEST['title']);
                        $Year = mysql_real_escape_string($_REQUEST['year']);
                        $ReturningDate = htmlentities($_REQUEST['returnDate']);
                        $date = date('Y-m-d',strtotime($ReturningDate));
			$result = mysql_query("SELECT name, telephone FROM (SELECT name, telephone, title,year, DATE_ADD(rdate, INTERVAL rday DAY) AS returnDate From Customer Natural JOIN Rent) A WHERE title = '$Title' AND year = $Year AND returnDate = '$date'");
			$i = 0;
	                if($result === false){
		                   throw new Exception(mysql_error($connection));
		            }
		        while ($row = mysql_fetch_array($result)) {
		                   echo "<tr valign='middle'>";
		                   echo "<td>".$row['name']."</td>";
			      	   echo "<td>".$row['telephone']."</td>";
				   echo "</td>";
                                   echo "</tr>";
		                   $i++;
		            }
		  }
	   ?>
        </table>
        <br>
        <br>
        <h3>Find Customer</h3>
        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
            <table border="0" cellpadding="0" cellspacing="0">
		<tr><td>Title:</td><td><input type="text" size="30" name="title"></td></tr>
		<tr><td>Year of Production:</td><td><input type="text" size="30" name="year"></td></tr>
                <tr><td>Return Date:</td><td> <input type="text" size="30" name="returnDate"></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="Find Customer"></td></tr>
            </table>
        </form>
                <button onclick="document.location='menu.php'">Return to Menu</button>

    </body>
</html>
