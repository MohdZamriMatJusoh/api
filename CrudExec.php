<?php
//include_once '../../inc/config_test.php';
//include_once '../../inc/config.php';
//include_once '../util/Connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrudExec
 *
 * @author mohdzamri
 */
class CrudExec 
{
        //put your code here
        function exec($table_name,$input_arr,$operation,$id=null,$value=null)
        {
         
            $c = new CrudExec();
            switch ($operation)
            {
                case "INSERT":  return $c->insertExec($table_name,$input_arr); //insert into
                    break;
                case "SELECT" : return $c->selectExec($table_name,$input_arr); // where    
                    break;
                case "SEARCH" : return $c->searchExec($table_name,$input_arr); // where    
                    break;
                case "UPDATE" : return $c->updateExec($table_name,$input_arr,$id,$value); //set id,value
                    break;
                case "DELETE" : return $c->deleteExec($table_name,$input_arr); // id value
                    break;
                case "DUMP" : return $c->arrayDump($input_arr);
                    break;
                default :
                    return "Unknown Operation";
            }
        }
        
        //create query
        function createSelectQuery($table_name,$input_arr)
        {
            $c = new CrudExec();
            $arr = array();
            //$sql = "SELECT * FROM Orders LIMIT 15, 10";
            $is_set_limit = 0;
            $total_in = 0;
            
            $input = $c->getInput($input_arr);
            $less_than = $c->getLessThan($input_arr);
            $greater_than = $c->getGreaterThan($input_arr);
            $equal        = $c->getEqual($input_arr);
            $between   = $c->getBetween($input_arr);
            $interval = $c->getInterval($input_arr);
            $order_by = $c->getOrderBy($input_arr);
            $group_by = $c->getGroupBy($input_arr);
            $sort     = $c->getSort($input_arr);
            $limit = $c->getLimit($input_arr);
            
            $arr["INPUT"] = $input;     
            $arr["LESS_THAN"] = $less_than;
            $arr["GREATER_THAN"] = $greater_than;
            $arr["EQUAL"] = $equal;
            $arr["BETWEEN"] = $between;
            $arr["INTERVAL"] = $interval;
            $arr["GROUP_BY"] = $group_by;
            $arr["ORDER_BY"] = $order_by;
            $arr["SORT"] = $sort;
            //$arr["LIMIT"] = $limit;
            
            $qry = "SELECT * FROM $table_name ";
            $i = 0 ;
            foreach ($arr as $key => $value) 
            {
                if($value !=="")
                {
                    if($i == 0)
                    {
                        $qry .=" WHERE ".$value." ";
                        $qry .="AND";
                    }
                    else
                    {    
                        if($key ==="ORDER_BY")
                        {
                            $qry = rtrim($qry,"AND");
                            $qry .= $value." ";
                                
                        }
                        else if($key ==="GROUP_BY")
                        {
                            $qry = rtrim($qry,"AND");
                            $qry .= $value." ";
                                
                        }
                        else if($key ==="SORT")
                        {
                            $qry = rtrim($qry,"AND");
                            $qry .= $value." ";
                                
                        }
                        else
                        {
                            $qry .=" ".$value." ";
                            $qry .="AND";     
                        }
                                           
                    }
                }
                else 
                {
                    if($i === 0)
                    {
                        if($key==="INPUT")
                        {
                            if($value ==="")
                            {
                                $qry .=" ";   
                            }
                            else
                            {
                                $qry .=" WHERE ".$value." ";   
                            }
                        }
                                            
                    }
                }
                $i++;
            }
            
            if($limit !=="")
            {
                $qry = rtrim($qry,"AND");            
                return $qry.$limit;
            }
            else
            {
                $qry = rtrim($qry,"AND");            
                return $qry; 
            }
              
        }
        function getInput($input_arr)
        {    
            $in = "";
            $c = new CrudExec();

            foreach ($input_arr as $key => $value)
            {                                   
              
                if($value !== "")
                {
                    $in .=$c->getInputValue($key,$value);             
                }
                else
                {
                    
                }
                
            }
           $new_in = rtrim($in,"AND"); 
           return $new_in;
                  
        }
        
        function getInputValue($key,$value)
        {
            switch ($key) 
                {
                    case "FROM":
                        $lim .="LIMIT ".$value.",";
                        break;
                    
                    case "LIMIT":
                        $lim .=$value.";";                     
                        break;
                    
                    case "EQUAL":                   
                        break;
                    
                    case "LESS_THAN":                   
                        break;
                    
                    case "GREATER_THAN":
                 
                        break;  
                    case "BETWEEN":                
                        break;
                        
                    case "INTERVAL":                 
                        break;   
                    
                    case "ORDER_BY":                 
                        break; 
                    
                    case "GROUP_BY":                 
                        break; 
                    
                    case "SORT":                 
                        break; 
                                
                    default:
                            $in = "";
                            if (strpos($key, '.') !== false && is_numeric($value) === false) 
                                {
                                    $in .= " ".$key."=".$value." ";
                                    $in .="AND";
                                                                   
                                }
                            else
                                {
                                    if(is_numeric($value))
                                    {
                                        $in .= " ".$key."=".$value." ";
                                        $in .="AND";
                                    }
                                    else
                                    {
                                        $in .= " ".$key."='".$value."' ";
                                        $in .="AND";
                                    }
                                   
                                                                     
                                }
                                return $in;
                                //return rtrim($in,"AND");
                        break;
                        }
        }
        
        function getEqual($input_arr)
        {
            $less_than = "";
            $c = new CrudExec();
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                    {
                                               
                        if($key === "EQUAL")
                        {
                            foreach ($value as $sub_key => $sub_value) 
                            { 
                                $new_sub_value = $c->inputValidate($sub_value);
                                $less_than = " ".$sub_key." = ".$new_sub_value." ";
                                                          
                            }
                        }                      
                    }                 
            } 
            
            return $less_than;
        }
        
        
        function getLessThan($input_arr)
        {
            $less_than = "";
            $c = new CrudExec();
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                    {
                                               
                        if($key === "LESS_THAN")
                        {
                            foreach ($value as $sub_key => $sub_value) 
                            { 
                                $new_sub_value = $c->inputValidate($sub_value);
                                $less_than = " ".$sub_key." < ".$new_sub_value." ";
                                                          
                            }
                        }                      
                    }                 
            } 
            
            return $less_than;
        }
        
        function getGreaterThan($input_arr)
        {
            $greater_than = "";
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                    {
                                               
                        if($key === "GREATER_THAN")
                        {
                            foreach ($value as $sub_key => $sub_value) 
                            {
                                $greater_than = " ".$sub_key." > ".$sub_value;
                            }
                        }                      
                    }
                    else
                    {

                    }
            } 
            
            return $greater_than;
        }
        
        function getInterval($input_arr)
        {
            // MY_DATE_FIELD >= NOW() - INTERVAL 1 DAY
            //WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= date_col;
            $interval = "";
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                    {
                                               
                        if($key === "INTERVAL")
                        {
                            foreach ($value as $sub_key => $sub_value) 
                            {                        
                                //$interval .= $sub_key ." >= ".$next_key." - INTERVAL  " .$next_value." DAY";
                                $interval .= "WHERE DATE_SUB(CURDATE(),INTERVAL ".$sub_value." DAY) <= $sub_key";                                 
                                
                            }
                        }                      
                    }
                    else
                    {

                    }
            } 
            
            return $interval;
        }
        
        function getBetween($input_arr)
        {
            //date_field BETWEEN '2010-01-30 14:15:55' AND '2010-09-29 10:15:55'
            $b = "";
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                    {
                                               
                        if($key === "BETWEEN")
                        {
                            foreach ($value as $sub_key => $sub_value) 
                            {
                                //return json_encode($sub_key);
                                foreach ($sub_value as $next_key => $next_value) 
                                {
                                    $b .= $sub_key ." BETWEEN '".$next_key."' AND '" .$next_value."'";
                                    //return $b;
                                }
                            }
                        }                      
                    }
                    else
                    {

                    }
            } 
            
            return $b;
        }
        
        function getLimit($input_arr)
        {
            $lim = "";
                foreach ($input_arr as $key => $value)
                {
                    if($value !== null)
                    {
                                               
                        if($key === "FROM")
                        {
                            $lim .="LIMIT ".$value.",";
                        }
                        else if($key === "LIMIT")
                        {
                            $lim .=$value.";";
                        }
                    }
                    else
                    {

                    }

                }
                
                return $lim;
        }
        
        function createSearchQuery($table_name,$input_arr)
        {
            //$sql = "SELECT * FROM Orders LIMIT 15, 10";
            $qry = "SELECT * FROM $table_name WHERE ";       
           
                foreach ($input_arr as $key => $value)
                {
                    if($value !== null)
                    {
                     
                                $qry .=" ".$key." LIKE '%".$value."%' ";
                                $qry .="AND";
                    }
                    else
                    {

                    }

                }
               
               return rtrim($qry,"AND");
            
        }
                
     
        
        function createInsertQuery($table_name,$input_arr)
        {
            //$sql = "INSERT INTO table_name (column1, column2, column3,...)VALUES (value1, value2, value3,...)";
            $c = new CrudExec();
            $cols = "";
            $vals = "";
            foreach ($input_arr as $key => $value)
            {
                if($value !== null)
                {
                   
                    $vals .= $c->inputValidate($value);
                    $vals .=",";
                    $cols .=$key;
                    $cols .=",";                                     
                }
                else
                {
                    
                }
                    
            }
            
           $new_cols = rtrim($cols,",");
           $new_vals = rtrim($vals,",");
           
           $query = "INSERT INTO $table_name ($new_cols) VALUES ($new_vals)";
           return $query;
              
        }
        
        function createUpdateQuery($table_name,$input_arr,$id,$value)
        {
            //$sql = "INSERT INTO table_name (column1, column2, column3,...)VALUES (value1, value2, value3,...)";
          
            $sets = "";
            foreach ($input_arr as $key => $val)
            {
                if($value !== null)
                {
                   $sets .= " ".$key."='".$val."' ";
                   $sets .= ",";
                                                   
                }
                else
                {
                    
                }
                    
            }
            
           $new_sets = rtrim($sets,",");   
           
           if(is_numeric($value))
           {
                $query = "UPDATE $table_name SET $new_sets WHERE $id = $value";
           }
           else 
           {
                $query = "UPDATE $table_name SET $new_sets WHERE $id = '$value'";
           }
           
           return $query;
              
        }
        
        function createDeleteQuery($table_name,$input_arr)
        {
            //$sql = "DELETE FROM table_name WHERE some_column = some_value";
          
            $cols = "";
            foreach ($input_arr as $key => $value)
            {
                if($value !== null)
                {
                   $cols .= " ".$key."='".$value."' ";
                   $cols .= "AND";
                                                   
                }
                else
                {
                    
                }
                    
            }
                           
           $query ="DELETE FROM $table_name WHERE $cols";
           $new_query = rtrim($query,"AND");
           return $new_query;
              
        }
        
        
        //Exec
         function searchExec($table_name,$input_arr)
        {
            $c = new CrudExec();
            $query = $c->createSearchQuery($table_name, $input_arr);
            return $c->execQuery($query);       
        }
        
        function selectExec($table_name,$input_arr)
        {
            $c = new CrudExec();
            $query = $c->createSelectQuery($table_name, $input_arr);
            return $c->execQuery($query); 
            //return $query;
        }
        
        function  insertExec($table_name,$input_arr)
        {
            $c = new CrudExec();
            $query = $c->createInsertQuery($table_name, $input_arr);
            return $c ->execQuery($query);
            
        }
        
        function updateExec($table_name,$input_arr,$id,$value)
        {
            $c = new CrudExec();
            $query = $c->createUpdateQuery($table_name, $input_arr,$id,$value);      
            return $c->execQuery($query);    
            //return $query;
        }
        
        function deleteExec($table_name,$input_arr)
        {
            $c = new CrudExec();
            $query = $c->createDeleteQuery($table_name, $input_arr);
            return $c->execQuery($query);    
        }
        
        //execute query
        function execQuery($query)
        {
            $operation  = strtok($query, " ");
            //echo $query;
            $db = new Connection();
            try
            {
                $conn = $db->connect();          
                $stmt = $conn->prepare($query);
                $stmt->execute();
                if($operation === "SELECT")
                {
                    return $stmt->fetchAll(pdo::FETCH_ASSOC);
                }
                else if($operation ==="UPDATE")
                {
                    return $stmt->rowCount();
                }
                else if($operation ==="SEARCH")
                {
                    return $stmt->fetchAll(pdo::FETCH_ASSOC);
                }
                else if($operation ==="DELETE")
                {
                    return $stmt->rowCount();
                }
                else if($operation ==="INSERT")
                {
                    return $conn->lastInsertId();
                }
                else
                {
                    echo "UNKNOWN OPERATION";
                }
                
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }
            $db->resetConn($conn,$stmt);             
        }
        
        function inputValidate($in)
        {
            $a = array("NULL"=>"'NULL'","CURDATE()"=>"CURDATE()","CURTIME()"=>"CURTIME()","NOW()"=>"NOW()");
            if(in_array($a,$in, TRUE))
            {
                return $a[$in];
            }
            else
            {
                return "'".$in."'";
            }
            
        }
        
        function test()
        {
            $table_name = "user";
            $c = new CrudExec();
            $delete_user = array("user_id"=>3);
            $search_user = array("username"=>"LER");
            $select_user_1 = array("user_id"=>"1","FROM"=>0,"LIMIT"=>50);
            $select_user_2 = array("FROM"=>0,"LIMIT"=>50);
            $select_user_3 = array("user_id"=>"1");
            $select_all_user = array("FROM"=>0,"LIMIT"=>20);
            $update_user = array("username"=>"AHMAD ALI BIN HAZIZAN");//SAW LER PWEL MOO , AHMAD MUSA BIN HAZIZAN
            $insert_user = array("username"=>"ALI BIN ABU","password"=>"678439sa2a","photo"=>"455545.png","emp_id"=>"278978912","role_id"=>2,"dept_id"=>2,"master_user"=>true);
                   
            $user_1 = $c->exec($table_name, $select_user_1, "SELECT");
            echo "<h2>1. ".json_encode($user_1)."</h2>";
             
            $user_2 = $c->exec($table_name, $select_user_2, "SELECT");
            echo "<h2>2. ".json_encode($user_2)."</h2>";
             
            $user_3 = $c->exec($table_name, $select_user_3, "SELECT");
            echo "<h2>3. ".json_encode($user_3)."</h2>";
         
            
        }
        
        function join()
        {
            $list = array('u.dept_id'=>'d.dept_id','u.user_id'=>1);

            foreach ($list as $key => $value) 
            {
                if (strpos($key, '.') !== false && is_numeric($value) === false) 
                {
                      echo $key."=".$value;  
                }
            }
            
        }
        
        function getGroupBy($input_arr)
        {
            $group_by = "";
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                {
                                               
                        if($key === "GROUP_BY")
                        {                        
                          $group_by = " GROUP BY ".$value ." " ;                           
                        }                      
                }
               else
                {

                }
            } 
            
            return $group_by;
        }
        
        function getOrderBy($input_arr)
        {
            $order_by = "";
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                {
                                               
                        if($key === "ORDER_BY")
                        {                        
                          $order_by = " ORDER BY ".$value ." " ;                           
                        }                      
                }
               else
                {

                }
            } 
            
            return $order_by;
        }
        
        function getSort($input_arr)
        {
            $sort = "";
            foreach ($input_arr as $key => $value) 
            {
                if($value !== null)
                {
                                               
                        if($key === "SORT")
                        {                        
                          $sort = " ".$value ." " ;                           
                        }                      
                }
               else
                {

                }
            } 
            
            return $sort;
        }
        
        function arrayDump($input)
        {
            $arr =  array();
            $arr["INPUT"] = "input";     
            $arr["LESS_THAN"] = "less_than";
            $arr["GREATER_THAN"] = "greater_than";
            $arr["BETWEEN"] = "between";
            $arr["INTERVAL"] = "interval";
            $arr["ORDER_BY"] = "order_by";
            foreach ($arr as $key => $value) 
            {
                if($key === "ORDER_BY")
                {
                    return $value;
                };
            }
           
        }
        
        
}



