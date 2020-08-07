
<?php
require '../phpMyAdminStuff/dbportal.php';
session_start();
$SessionOrderData=isset($_SESSION['SessionOrderDatalValue'])?unserialize($_SESSION['SessionOrderDatalValue']):new ServerOrder();
?>
<html>
    <head>
        <title>Create new record</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    </head>

<body>
<div class="container">
    <h1>Fill the details</h1>
    <form action="../index.php?deed=create" method="POST">
        <input type="text" placeholder="Item must be string" pattern="[A-Za-z]{3,}" name="Item" value="<?php echo $SessionOrderData->Item; ?>">
        <input type="text" placeholder="Price of Item" pattern="[0-9]{1,5}" name="Price" value="<?php echo $SessionOrderData->Price!=0?$SessionOrderData->Price:''; ?>">
      <input type="submit" value="Add Item" name="create"/>
      <a href="../index.php" style="color: blue;">Cancel</a>
      <p class="ErrorList"><?php echo $SessionOrderData->ErrorMessages; ?></P>
    </form>
</div>


<style>
    body {
        font-family: Arial;
    }

    input[type=text], select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    input[type=submit] {
      width: 100%;
      background-color: darkblue;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      opacity: 0.7;
    }
    div.container {
        text-align: center;
        border-radius: 5px;
        background-color: linen;
        padding: 20px;
        border: 1px solid azure;
        border-radius: 1vw;
        margin: auto;
        width: 25%;
        border: 1px solid #BFBFBF;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
    body{background-color: lightgreen;}
    @media only screen and (max-width: 900px) {
        div.container{background-color: lightsalmon; width:80%; border: 0px;}
        body{background-color: lightseagreen;}
    }
</style>
</body>
</html>