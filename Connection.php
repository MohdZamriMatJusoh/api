<?php 
include_once 'inc/config.php';
include_once 'models/util/Json.php';
//connection
class Connection
{
	public  $servername ;
	public  $username ;
	private  $password ;
	public  $dbname ;
	public  $conn;
	public  $msg;
	
	public function connect()
	{
		  
	    $username 	= DB_USERNAME;
	    $password 	= DB_PASSWORD;
	    $dbname   	= DB_DATABASE;
	    $servername = DB_SERVERNAME;

		
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
        
     function connectDb($db_name)
     {
        $username 	= DB_USERNAME;
    	$password 	= DB_PASSWORD;
    	$dbname   	= $db_name;
    	$servername    = DB_SERVERNAME;

		
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
     }
	
    function connectionTest()
	{   
	    
		try
		{
		  		    
		    $username 	= DB_USERNAME;
		    $password 	= DB_PASSWORD;
		    $dbname   	= DB_DATABASE;
		    $servername = DB_SERVERNAME;
		    
			
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$curr_conn["status"] = "Success";
			$curr_conn["message"]="Connected";
			return $curr_conn;
		}
		catch(PDOException $e)
		{
		    $json->status = "Failed";
		    $json->message= $e->getMessage();
		    return $json;
		}
	}
	
	public function resetConn($conn,$stmt)
	{
		unset($conn);
		unset($stmt);
	}
        
        function getClientIp()
        {
             $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        
        function getEnvClientIp()
        {
                // Function to get the client IP address
    
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
    
        }
	
}
//$conn = new Connection();
//print json_encode($conn->connectionTest());
?>
