<html>
    <body>
        <h2>CD Info</h2>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Title</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Year of Production</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Producer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Supplier</b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
            <?php
                include "dbConn.php";
                error_reporting(E_ALL ^ E_NOTICE);
                if ($_REQUEST['title'] != "" && $_REQUEST['year'] != "" && $_REQUEST['artist'] != "" && $_REQUEST['name'] != "") {
	                    $Title = mysql_real_escape_string($_REQUEST['title']);
			    $Year = mysql_real_escape_string($_REQUEST['year']);
                            $Producer = mysql_real_escape_string($_REQUEST['artist']);
	                    $Supplier = mysql_real_escape_string($_REQUEST['name']);
	                    mysql_query("INSERT IGNORE INTO CD (title, year) VALUES('$Title','$Year')");
	                    mysql_query("INSERT IGNORE INTO Producer (name) VALUES('$Producer')");
	                    mysql_query("INSERT IGNORE INTO Supplier (name) VALUES('$Supplier')");
	                    mysql_query("INSERT IGNORE INTO Supply (name, title, year) VALUES('$Supplier','$Title','$Year')");
	                    mysql_query("INSERT IGNORE INTO Produce (artist, title, year) VALUES('$Producer','$Title','$Year')");
                            echo "INSERT INTO Supplied (name, title, year) VALUES('$Supplier','$Title','$Year')";
                            echo "INSERT INTO Produced (artist, title, year) VALUES('$Producer','$Title','$Year')";
	                }

                $result = mysql_query("SELECT Supplied.title as title, Supplied.year as year, Supplied.name as sup_name, Produced.artist as pro_name FROM Supplied JOIN Produced ON Supplied.title = Produced.title AND Supplied.year = Produced.year");
		$i = 0;
		if($result === false){
 			    throw new Exception(mysql_error($connection));
		}
                while ($row = mysql_fetch_array($result)) {
	                    echo "<tr valign='middle'>";
                            echo "<td>".$row['title']."</td>";
 	   		    echo "<td>".$row['year']."</td>";
			    echo "<td>".$row['pro_name']."</td>";
			    echo "<td>".$row['sup_name']."</td>";
			    echo "</td>";
			    echo "</tr>";
			   $i++;
			 }
	     ?>
        </table>
        <br>
        <br>
        <h3>Add CD</h3>
        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td>Title:</td><td><input type="text" size="30" name="title"></td></tr>
                <tr><td>Year of Production:</td><td> <input type="text" size="30" name="year"></td></tr>
                <tr><td>Producer:</td><td> <input type="text" size="30" name="artist"></td></tr>
                <tr><td>Supplier:</td><td> <input type="text" size="30" name="name"></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="Add CD"></td></tr>
            </table>
        </form>
            <button onclick="document.location='menu.php'">Return to Menu</button>
    </body>
</html>
