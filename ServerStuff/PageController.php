<?php
    require 'phpMyAdminStuff/dbportal.php';
    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class PageController{
        // Constructor will set batabase object for future use
        function __construct(){$this->dbObject = new SharanamDatabase();}

        // Show Main page
        public function dashboard(){
            $result=$this->dbObject->outputQuery(0);
            include "Client/dashboard.php"; 
        }
        // Get data to be inserted for first time in database
        public function create(){
            if (isset($_POST['create'])) 
                {
                    try{   
                        $SessionOrderData = new ServerOrder();
                        //Arrival of data onto server, will be validated once 
                        // $SessionOrderData->orderid = trim($_POST['OrderID']);
                        $SessionOrderData->Item = trim($_POST['Item']);
                        $SessionOrderData->Price = trim($_POST['Price']);
                        
                        $ValidatedData=true; //Init variable

                        //Validating Item
                        if(empty($SessionOrderData->Item)){
                            $SessionOrderData->ErrorMessage("Item Field is empty.");
                            $ValidatedData=false;
                        }
                        elseif(!preg_match("/^[a-zA-Z ]*$/",$SessionOrderData->Item)){
                            $SessionOrderData->ErrorMessage("Invalid entry in item field.");
                            $ValidatedData=false;
                        }
                        else{}

                        //Validating OrderId
                        /*if(empty($SessionOrderData->orderid)){
                            $SessionOrderData->ErrorMessage("OrderID field is empty.");
                            $ValidatedData=false;
                        }
                        elseif(!preg_match("/^[0-9]*$/",$SessionOrderData->orderid) && $SessionOrderData->orderid<=0){
                            $SessionOrderData->ErrorMessage("Invalid entry in orderID field.");
                            $ValidatedData=false;
                        }
                        else{}*/

                        //validating entered Price
                        if(empty($SessionOrderData->Price)){
                            $SessionOrderData->ErrorMessage("Price is not given.");
                            $ValidatedData=false;
                        }
                        elseif(!preg_match("/^[0-9]*$/",$SessionOrderData->Price) && $SessionOrderData->Price<=0){
                            $SessionOrderData->ErrorMessage("Price is inappropriate.");
                            $ValidatedData=false;
                        }
                        else{}

                        if($ValidatedData){
                            //call insert record            
                            $insertedRow = $this->dbObject->newOrder($SessionOrderData);
                            if($insertedRow>0){$this->dashboard();}
                            else{echo "<script>alert('error occured, try again later.');</script>";}
                        }
                        else{    
                            // Session object will send data back to create page
                            $_SESSION['SessionOrderDatalValue']=serialize($SessionOrderData);
                            header('Location:Client/create.php');
                        }
                    }
                    catch (Exception $Error)
                    {
                        $this->dbObject->ShutdownDB();
                        throw $Error;
                    }
                }
            }

        // Update in already existed row
        public function update(){
            try{
                if (isset($_POST['update'])){
                    $SessionOrderData=unserialize($_SESSION['SessionOrderDatalValue']);
                    $SessionOrderData->orderid = trim($_POST['orderid']);
                    $SessionOrderData->Item = trim($_POST['Item']);
                    $SessionOrderData->Price = trim($_POST['Price']);
                    $ValidatedData=true; //Init variable
                    //Validating Item
                    if(empty($SessionOrderData->Item)){
                        $SessionOrderData->ErrorMessage("Item Field is empty.");
                        $ValidatedData=false;
                    }
                    elseif(!preg_match("/^[a-zA-Z ]*$/",$SessionOrderData->Item)){
                        $SessionOrderData->ErrorMessage("Invalid entry in item field.");
                        $ValidatedData=false;
                    }
                    else{}
                    //Validating OrderId
                    if(empty($SessionOrderData->orderid)){
                        $SessionOrderData->ErrorMessage("OrderID field is empty.");
                        $ValidatedData=false;
                    }
                    elseif(!preg_match("/^[0-9]*$/",$SessionOrderData->orderid) && $SessionOrderData->orderid<=0){
                        $SessionOrderData->ErrorMessage("Invalid entry in orderID field.");
                        $ValidatedData=false;
                    }
                    else{}

                    //validating entered Price
                    if(empty($SessionOrderData->Price)){
                        $SessionOrderData->ErrorMessage("Price is not given.");
                        $ValidatedData=false;
                    }
                    elseif(!preg_match("/^[0-9]*$/",$SessionOrderData->Price) && $SessionOrderData->Price<=0){
                        $SessionOrderData->ErrorMessage("Price is inappropriate.");
                        $ValidatedData=false;
                    }
                    else{}
                    if($ValidatedData){
                        $updatedRow = $this->dbObject->updateOrder($SessionOrderData);
                        if($updatedRow){$this->dashboard();}
                        else{echo "Somthing is wrong..., try again.";}
                    }
                    else{
                        $_SESSION['SessionOrderDatalValue']=serialize($SessionOrderData);
                        header('Location:Client/update.php');
                    }
                }
                elseif(isset($_GET["orderid"]) && !empty(trim($_GET["orderid"]))){
                    $orderid=$_GET['orderid'];
                    $output=$this->dbObject->outputQuery($orderid);
                    $row=mysqli_fetch_array($output);  
                    $SessionOrderData=new ServerOrder();                
                    $SessionOrderData->orderid=trim($_GET["orderid"]);
                    $SessionOrderData->Item=$row["Item"];
                    $SessionOrderData->Price=$row["Price"];
                    $_SESSION['SessionOrderDatalValue']=serialize($SessionOrderData);
                    header('Location:Client/update.php');
                }
                else{echo "Operation is Invalid.";}
            }
            catch (Exception $Error){$this->dbObject->ShutdownDB();throw $Error;}
        }

        // remove data from database
        public function remove(){
            try{
                if (isset($_GET['orderid'])){
                    $orderid=$_GET['orderid'];
                    $output=$this->dbObject->removeItem($orderid);
                    if($output){header('Location:.');}
                    else{echo "Somthing is wrong. try again later.";}
                }else{echo "Operation is Invalid.";}
            }
            catch (Exception $Error){$this->dbObject->ShutdownDB();throw $Error;}
        }

        // This function will handle page redirections.
        public function pageWorker()
        {
            switch(isset($_GET['deed'])?$_GET['deed']:NULL){
                case 'create': $this->create(); break;
                case 'update': $this->update(); break;
                case 'remove': $this->remove(); break;
                default: $this->dashboard();
            }
        }
    }
?>