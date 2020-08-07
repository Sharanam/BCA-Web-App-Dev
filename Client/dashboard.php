<?php session_unset();?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage | Assignment 2</title>
    <link rel="stylesheet" href="Client/dashboard.css">
</head>
<!-- Head Part Ends Here -->
<body>

<div class="header">
  <h1>Sharanam Chotai</h1>
  <p>Student of TYBCA</p>
</div>

<!--<div class="topnav">
  <a href="Homepage.html" style="background-color: burlywood; color: black;">Home</a>
  <a href="login.php">Login</a>
  <a href="SignUp.php">Sign Up</a>
  <a href="dashboard.php" style="float:right">Dashboard</a>
</div>-->

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>Cart of Customer</h2>
      <h5>Assignment completion date 02/08/2020</h5>
      <div class="ImageClass" style="height:200px;"></div>
      <h3 style="text-align: left;">3 tier Application, as 2nd assignment of WAD.</h3>

        <!-- whiteboard.php starts -->
                <style>.AnchorButton{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:white;background-color:black;text-align:center;cursor:pointer;white-space:nowrap}.AnchorButton:hover{box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)}body{margin: auto; text-align: center;}table {    border-collapse: collapse;    width: 50%;    margin: auto;    border: 1px solid cyan;  }    th, td {    text-align: left;    padding: 8px;  }    tr:nth-child(even) {background-color: #f2f2f2;}</style></head>
            <div>
                <h2>Items List</h2>
                <a href="Client/create.php" class="AnchorButton">Add New Item</a>
                <?php
                            if($result->num_rows > 0){
                                echo "<table>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>OrderID</th>";
                                            echo "<th>Item</th>";
                                            echo "<th>Price</th>";
                                            echo "<th>Actions</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr id=".$row['OrderID'] .">";
                                            echo "<td>" . $row['OrderID'] . "</td>";
                                            echo "<td>" . $row['Item'] . "</td>";
                                            echo "<td>" . $row['Price'] . "</td>";
                                            echo "<td>";
                                                echo "<a style='color:blue;' onclick='Read(".Trim($row['OrderID']).")'><i class='fa fa-google'></i></a> ";
                                                echo "<a href='index.php?deed=update&orderid=". $row['OrderID'] ."'><i class='fa fa-edit'></i></a> ";
                                                echo "<a href='index.php?deed=remove&orderid=". $row['OrderID'] ."');><i class='fa fa-remove'></i></a>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "<p><em>No records were found.</em></p>";
                            }
                        ?>
            </div>
            <!-- whiteboard.php ends -->
    </div>
  </div>
  <script>
      function Read(id){alert("Cost of "+document.getElementById(id).childNodes[1].innerText+" is "+document.getElementById(id).childNodes[2].innerText+" INR.")}
  </script>
  <div class="rightcolumn">
    <div class="card">
      <h2>About Me</h2>
      <div class="ProfileImage" style="height:408px;"><img src="https://pbs.twimg.com/profile_images/1048445435264811008/g2OQR9YD.jpg" alt=""></div>
      <p>Photoshop puppeteer,<br>Memer,<br>rabble-rouser</p>
    </div>
  </div>
</div>

<div class="footer">
  <h2>A room without books is like a body without a soul.</h2>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
  <h3>Follow me: <a href="https://www.instagram.com/sharanamchotai/" style="color: black;"><i class="fa fa-instagram" aria-hidden="true"></i></a> <a href="https://www.youtube.com/channel/UC-r1O57sIDto3GdpqoV-9jg" style="color: black;"><i class="fa fa-youtube" aria-hidden="true"></i></a></h3>
  <p style="color: grey;">Use desktop to view this page. If you don't have PC, buy new one.</p>
</div>

</body>
</html>
