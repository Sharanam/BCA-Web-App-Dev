<?php
    //Confidential data is hidden
    // define('DB_SERVER', 'localhost');
    // define('DB_USERNAME', 'root');
    // define('DB_PASSWORD', '');
    // define('DB_NAME', 'test');
    
    class SharanamDatabase{
        public function __construct(){
            $this->server='localhost';
            $this->username='root';
            $this->password='';
            $this->dbname='test';
        }

        // This functin will open the door of database
        public function ContactDB(){
            /* Attempt to connect to MySQL database */
            $this->link = mysqli_connect($this->server,$this->username, $this->password, $this->dbname);
            // Check connection
            if($this->link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}
        }

        // This function will close the database
        public function ShutdownDB(){$this->link->close();}

        // Insert Query for mysql
        public function newOrder($neworderdata){
            try{
                $this->ContactDB();
                 $sqlrunner=$this->link->prepare("INSERT INTO customerdata (CustomerID, Item, Price) VALUES (1, ?, ?)");
                 $sqlrunner->bind_param("si",$neworderdata->Item,$neworderdata->Price);
                 $sqlrunner->execute();
                 $outcome=$sqlrunner->get_result();
                 $outID=$this->link->insert_id;
                 $sqlrunner->close();
                 $this->ShutdownDB();
                 return $outID;
            }
            catch(Exception $error){$this->ShutdownDB();throw $error;}
        }

        // function to run select sql query
        public function outputQuery($orderid){
            try{
                $this->ContactDB();
                if($orderid>0){
                    $sqlrunner=$this->link->prepare("SELECT * FROM CustomerData WHERE OrderID=?");
                    $sqlrunner->bind_param("i",$orderid);
                }
                else $sqlrunner=$this->link->prepare("SELECT * FROM CustomerData");
                $sqlrunner->execute();
                $outcome=$sqlrunner->get_result();
                $sqlrunner->close();
                $this->ShutdownDB();
                return $outcome;
            }
            catch(Exception $error){$this->ShutdownDB();throw $error;}
        }

        // Function to execute update query in database
        public function updateOrder($updateValue){
            try
			{	
				$this->ContactDB();
				$sqlrunner=$this->link->prepare("UPDATE CustomerData SET Item=?,Price=? WHERE OrderID=?");
                $sqlrunner->bind_param("sii", $updateValue->Item,$updateValue->Price,$updateValue->orderid);
				$sqlrunner->execute();
				$outID=$sqlrunner->get_result();
				$sqlrunner->close();
				$this->ShutdownDB();
				return true;
			}
			catch(Exception $error){$this->ShutdownDB();throw $error;}
        }

        //function to run delete query
        public function removeItem($orderid)
        {
            try{
                $this->ContactDB();
                $sqlrunner=$this->link->prepare("DELETE FROM CustomerData WHERE OrderID=?");
				$sqlrunner->bind_param("i",$orderid);
				$sqlrunner->execute();
				$outID=$sqlrunner->get_result();
				$sqlrunner->close();
                $this->ShutdownDB();
                return true;
            }
            catch (Exception $Error){$this->dbObject->ShutdownDB();throw $Error;}
        }
    }

    // This class is intermediate for storing database values in variables
    class ServerOrder{
        public $orderid;
        public $Item;
        public $Price;
        public $ErrorMessages;
        public function __construct(){
            $this->orderid=$this->Price=0;
            $this->Item=$this->ErrorMessage="";
        }
        public function ErrorMessage($errorPrint){
            $this->ErrorMessages= $this->ErrorMessages."<br>".$errorPrint;
        }
    }
?>