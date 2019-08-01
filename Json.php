<?php 
class Json
{
	public $status;
	public $message;
	public function setJson($status,$message)
	{
		$this->status = $status;
		$this->message  = $message;
	}
	public function getResponse()
	{
		$j = new Json();
		$j->status=$this->status;
		$j->message=$this->message;
		$js = new Json();
		return $js->encodeObject($j);
	}
	public function encodeObject($obj)
	{
		return json_encode($obj);
	}
	// Output JSON
	public function outputJSON($msg, $status = 'error')
	{
		header('Content-Type: application/json');
		die(json_encode(array(
				'data' => $msg,
				'status' => $status
		)));
	}
	/*
	 example
	 =======
	 class User
	 {
	 public name;
	 public age;
	 public city;
	 }
	 
	 $myObj = new User;
	 
	 $myObj->name = "John";
	 $myObj->age = 30;
	 $myObj->city = "New York";
	 
	 $myJSON = json_encode($myObj);
	 
	 echo $myJSON;
	 */
	
}

?>