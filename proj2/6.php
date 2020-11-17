<html>
    <body>
        <h2>List Producer</h2>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Producer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Address</b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
            <?php
                include "dbConn.php";
                error_reporting(E_ALL ^ E_NOTICE);
                if ($_REQUEST['title'] != "" && $_REQUEST['year'] != "" && $_REQUEST['artist'] != "" ) {
                    $Title = mysql_real_escape_string($_REQUEST['title']);
                    $Year = mysql_real_escape_string($_REQUEST['year']);
                    $Artist = mysql_real_escape_string($_REQUEST['artist']);

                    //$result = mysql_query("SELECT DISTINCT artist, address FROM (Produced NATURAL JOIN Producer) NATURAL JOIN (SELECT title, year FROM Song NATURAL JOIN CD WHERE artist = '$Artist' AND title = '$Title' AND year = $Year)");
		    $result = mysql_query("SELECT DISTINCT artist, address FROM (Produced NATURAL JOIN Producer) NATURAL JOIN (SELECT title, year FROM Produced NATURAL JOIN CD WHERE artist = '$Artist' AND title = '$Title' AND year = $Year) B");
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
            }
            ?>
        </table>
        <br>
        <br>
        <h3>Find Producer</h3>
        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td>CD Title:</td><td><input type="text" size="30" name="title"></td></tr>
                <tr><td>Year of Production:</td><td> <input type="text" size="30" name="year"></td></tr>
                <tr><td>Artist:</td><td> <input type="text" size="30" name="artist"></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="List Producer"></td></tr>
            </table>
        </form>
            <button onclick="document.location='menu.php'">Return to Menu</button>

    </body>
</html>
