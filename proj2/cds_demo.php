<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <body>
        <h2>My CDs</h2>
        <?php

            if(!@mysql_connect("134.74.112.19", "hur20f", "ruixiang")) {
                echo "<h2>Connection Error.</h2>";
                die();
            }
            mysql_select_db("d207");
        ?>
	<table border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Title</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Year</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Type</b></td>
		
		<td><img src="img/blank.gif" alt="" width="10" height="25"></td>
	    </tr>
            <?php
            	error_reporting(E_ALL ^ E_NOTICE);
                if ($_REQUEST['artist'] != "") {
                    if ($_REQUEST['year'] == "") {
                        $year = "NULL";
                    } else {
                        $year = intval($_REQUEST['year']);
		    }
		    $title = mysql_real_escape_string($_REQUEST['title']);
		    $type = mysql_real_escape_string($_REQUEST['type']);
                    mysql_query("INSERT INTO CD (title,year,type) VALUES('$title',$year,'$type')");
                    echo "INSERT INTO CD (title,year,type) VALUES('$title',$year,'$type')";
                }

		$result = mysql_query("SELECT title, year, type FROM CD ORDER BY title");
		$i = 0;
		if($result === false){
		     throw new Exception(mysql_error($connection));
		}
                while ($row = mysql_fetch_array($result)) {
                    echo "<tr valign='middle'>";
                    echo "<td>".$row['title']."</td>";
	                echo "<td>".$row['year']."</td>";
                    echo "<td>".$row['type']."</td>";
                    echo "<td><a onclick=\"return confirm('Are you sure?');\" href='cds_demo.php?action=del&amp;id="."'><span class='red'>Delete</span></a></td>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }
            ?>
	</table>
	<table border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Producer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="300" height="6"><br><b>Producer's Address</b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
	    </tr>
	    <?php
		error_reporting(E_ALL ^ E_NOTICE);
		//$title = mysql_real_escape_string($_REQUEST['title']);
                $artist = mysql_real_escape_string($_REQUEST['artist']);
		$pro_address = mysql_real_escape_string($_REQUEST['pro_address']);
                mysql_query("INSERT INTO Producer (title,artist,pro_address) VALUES('$title','$artist','$pro_address')");
                echo "INSERT INTO Producer (title,artist,pro_address) VALUES('$title','$artist','$pro_address')";
               
	        $result = mysql_query("SELECT artist, pro_address FROM Producer ORDER BY artist");
                $i = 0;
                if($result === false){
		       	throw new Exception(mysql_error($connection));
		  }
		while ($row = mysql_fetch_array($result)) {
			echo "<tr valign='middle'>";
			echo "<td>".$row['artist']."</td>";
			echo "<td>".$row['pro_address']."</td>";
			echo "<td><a onclick=\"return confirm('Are you sure?');\" href='cds_demo.php?action=del&amp;id="."'><span class='red'>Delete</span></a></td>";
			echo "</td>";
		        echo "</tr>";
		   $i++;
		                }
            ?>				
	</table>
        <table border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#f87820">	
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Producer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Supplier</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="300" height="6"><br><b>Producer's Address</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="300" height="6"><br><b>Supplier's Address</b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
	    </tr>
	    <?php
		error_reporting(E_ALL ^ E_NOTICE);
		$title = mysql_real_escape_string($_REQUEST['title']);
               // $artist = mysql_real_escape_string($_REQUEST['artist']);
		// $pro_address = mysql_real_escape_string($_REQUEST['pro_address']);
		$supplier = mysql_real_escape_string($_REQUEST['supplier']);
		$sup_address = mysql_real_escape_string($_REQUEST['sup_address']);
                mysql_query("INSERT INTO Supplier (title,supplier,sup_address) VALUES('$title','$supplier','$sup_address')");
                echo "INSERT INTO Supplier(title,supplier,sup_address) VALUES('$title','$supplier','$sup_address')";

                $result = mysql_query("SELECT Producer.artist, Supplier.supplier, Producer.pro_address, Supplier.sup_address FROM Producer INNER JOIN Supplier ON Producer.title = Supplier.title AND Producer.title = 'Greece Is The Songs'");
                $i = 0;
                if($result === false){
                        throw new Exception(mysql_error($connection));
                  }
                while ($row = mysql_fetch_array($result)) {
                        echo "<tr valign='middle'>";
                        //echo "<td>".$row['title']."</td>";
			echo "<td>".$row['artist']."</td>";
			echo "<td>".$row['supplier']."</td>";
			echo "<td>".$row['pro_address']."</td>";
			echo "<td>".$row['sup_address']."</td>";
                       // echo "<td><a onclick=\"return confirm('Are you sure?');\" href='cds_demo.php?action=del&amp;id="."'><span class='red'>Delete</span></a></td>";
                        echo "</td>";
                        echo "</tr>";
                   $i++;
                                }
            ?>
	</table>
	<table border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Customer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>SSN</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Telephone</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Date</b></td>
		<td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Rent Days</b></td>
		<td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>VIP</b></td>
               
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
	    </tr>
	    <?php
                error_reporting(E_ALL ^ E_NOTICE);
                $title = mysql_real_escape_string($_REQUEST['title']);
		$customer = mysql_real_escape_string($_REQUEST['customer']);
		$ssn = mysql_real_escape_string($_REQUEST['ssn']);
		$telephone = mysql_escape_string($_REQUEST['telephone']);
		$date = mysql_escape_string($_REQUEST['date']);
		$rday = mysql_escape_string($_REQUEST['rday']);
		$vip = mysql_escape_string($_REQUEST['vip']);
                mysql_query("INSERT INTO Customer (title,customer,ssn,telephone,date,rday,vip) VALUES('$title','$customer','$ssn','$telephone','$date','$rday','$vip')");
		echo "INSERT INTO Customer (title,customer,ssn,telephone,date,rday,vip) VALUES('$title','$customer','$ssn','$telephone','$date','$rday','$vip')"
                }

                $result = mysql_query("SELECT customer,ssn,telephone,date,rday,vip FROM Customer");
                $i = 0;
                if($result === false){
                     throw new Exception(mysql_error($connection));
                }
                while ($row = mysql_fetch_array($result)) {
                    echo "<tr valign='middle'>";
                    echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['year']."</td>";
                    echo "<td>".$row['type']."</td>";
                    echo "<td><a onclick=\"return confirm('Are you sure?');\" href='cds_demo.php?action=del&amp;id="."'><span class='red'>Delete</span></a></td>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }
            ?>
	</table>
	<table border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Customer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>SSN</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Telephone</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Date</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Rent Days</b></td>
		<td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>VIP</b></td>
		<td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>VIP Start Date</b></td>
		<td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Discount</b></td>
                
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Customer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Telephone</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Title</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b>Rent Days</b></td>
                
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
	</table>
	 <table border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#f87820">
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Title</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Producer</b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b>Year</b></td>
                
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>
        </table>
        <h2>Add CD</h2>

        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td>Artist:</td><td><input type="text" size="30" name="artist"></td></tr>
		<tr><td>Title:</td><td> <input type="text" size="30" name="title"></td></tr>
		<tr><td>Year:</td><td> <input type="text" size="30" name="year"></td></tr>
		<tr><td>Supplier:</td><td> <input type="text" size="30" name="supplier"></td></tr>
		<tr><td>Producer's Address:</td><td> <input type="text" size="30" name="pro_address"></td></tr>
		<tr><td>Supplier's Address:</td><td> <input type="text" size="30" name="sup_address"></td></tr>
		<tr><td>Type:</td><td> <input type="text" size="30" name="type"></td></tr>	
                <tr><td>&nbsp;</td><td><input type="submit" value="Add CD"></td></tr>
            </table>
        </form>
    </body>
</html>
