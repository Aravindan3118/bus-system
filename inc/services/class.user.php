<?php 
	include "db_config.php";
	class User{
		protected $db;
		public function __construct(){
			$this->db = new DB_con();
			$this->db = $this->db->ret_obj();
		}
		
		
		public function insert($table,$values,$rows = null)
    {
            $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')'; 
            }
 
            for($i = 0; $i < count($values); $i++)
            {
                if(is_string($values[$i]))
                    $values[$i] = '"'.$values[$i].'"';
            }
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';         
           $result = $this->db->query($insert) or die($this->db->error);
    }
	
		
			
	public function select($table, $rows = '*', $where = null, $union = null, $where1 = null, $order = null)
    {
		
        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
		{
            $q .= ' WHERE '.$where;
        }
		if($union != null)
		{
			$q .= $union.' '.'SELECT '.$rows.' FROM '.$table;
		}
		if($where1 !=  null)
		{
		  $q .= ' WHERE '.$where1;
		}
		if($order != null)
        {    
		$q .= ' ORDER BY '.$order;
        }
		
		$result= $this->db->query($q);
		
		while($row= mysqli_fetch_array($result))
		{
			$array[]=$row;
		}
		if(!empty($array))
		{
		return $array;
		}
		else
		{
		return false;
		}
	
    }		
	public function update($table,$rows,$where)
    {
            for($i = 0; $i < count($where); $i++)
            {
                if($i%2 != 0)
                {
                    if(is_string($where[$i]))
                    {
                        if(($i+1) != null)
                            $where[$i] = '"'.$where[$i].'" AND ';
                        else
                            $where[$i] = '"'.$where[$i].'"';
                    }
                }
            }
            $where = implode('=',$where);
             
             
            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows); 
            for($i = 0; $i < count($rows); $i++)
           {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }
                 
            
                if($i != count($rows)-1)
                {
                    $update .= ','; 
                }
            }
            $update .= ' WHERE '.$where;
			
     $result = $this->db->query($update) or die($this->db->error);
       
    }
	
	
	
	
}