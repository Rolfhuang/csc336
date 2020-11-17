<html>
    <body>
        <h2>Producer Info</h2>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Name</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Address</b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
            <?php
                include "dbConn.php";
                error_reporting(E_ALL ^ E_NOTICE);
                if ($_REQUEST['artist'] != "" ) {
                    if ($_REQUEST['address'] == "") {
                        $Address = "NULL";
                    } else {
                        $Address = mysql_real_escape_string($_REQUEST['address']);
                    }
                    $Name = mysql_real_escape_string($_REQUEST['artist']);
                    mysql_query("INSERT IGNORE INTO Producer (artist, address) VALUES('$Name','$Address')");
                    echo "INSERT INTO Producer (artist, address) VALUES('$Name','$Address')";
                }

		$result = mysql_query("SELECT artist, address FROM Producer ORDER BY artist");
		$i = 0;
		if($result === false){
	                    throw new Exception(mysql_error($connection));
                   }
       	        while ($row = mysql_fetch_array($result)) {
		              echo "<tr valign='middle'>";
                              echo "<td>".$row['artist']."</td>";
  		       	      echo "<td>".$row['address']."</td>";
			      echo "</td>";
			      echo "</tr>";
			    $i++;
			  }
	     ?>
        </table>
        <br>
        <br>
        <h3>Add Producer</h3>
        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td>Name:</td><td><input type="text" size="30" name="artist"></td></tr>
                <tr><td>Address:</td><td> <input type="text" size="30" name="address"></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="Add Producer"></td></tr>
            </table>
	</form>
               <button onclick="document.location='menu.php'">Return to Menu</button>
    </body>
</html>
