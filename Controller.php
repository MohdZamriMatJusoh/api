<?php
session_start();
if(isset($_SERVER['HTTP_ORIGIN']))
{
	header("Access-Control-Allow-Origin:{$_SERVER['HTTP_ORIGIN']}");
	header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Credentials:true');
	header('Access-Control-Max-Age:86400');
}
if($_SERVER['REQUEST_METHOD']=='OPTIONS')
{
	if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
	{
		header("Access-Control-Allow-Methods:GET,POST,OPTIONS");
	}
	if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
	{
		header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	}
	exit(0);
}
//controller wis
function __autoload($className)
{
	include("$className.php");
}

//mail
//$mail = new Mail();

//Crud Execute
$ce  = new CrudExec();


if(isset($_POST['action'])) 
{
	switch($_POST['action']) 
	{
			                    
                case 'crud':
                        $table_name = $_POST["table_name"];
                        $params     = json_decode($_POST["params"]);
                        $operation  = $_POST["operation"];
                        $id         = $_POST["id"];
                        $value      = $_POST["value"];
			print json_encode($ce->exec($table_name, $params, $operation,$id,$value));                      
			break;    
                    
                 //MAIL
		 case 'send_mail':
		 	$current_mail = json_decode($_POST["mail"]);
		 	print $mail->sendMail($current_mail);
		 	break;
	     
		 case 'send_mail_attachment':                  
		 	print $mail->sendAttachments();
		 	break;    

                
		default:
			print "undefined action";

	}
}
else
{
	print json_encode(0);
	return;
}

exit();
