<?php
/**
 * 机器属性
 *
 *
 */
class Computer_model extends Model
{
	
	
	function __construct()
    {
        parent::Model();
		$this -> load -> database();
    }
	
	// --------------------------------------------------------------------

    /**
	 * 得到不同id机器的基本属性
	 *
	 *
	 */	
	 function category()
	 {
		$this->db->select('id');
		$this->db->distinct();
		$temp_number = $this->db->get('servers');
		
		#var_dump(count($temp_number->result()));
		
		$result1 = array();
		
		for ($i=1; $i<=count($temp_number->result()); $i++)
		{
			$this->db->where('id', $i);
			$this->db->select('id, hostname, ip, pro_number, cpu_type, total_mem, total_disk, system_bit, day, hour, minute, second');
			$query = $this -> db -> get('servers');
			#var_dump((array)($query -> row(count($query->result()) - 1)));
			$result1[$i] = ((array)($query -> row(count($query->result()) - 1)));
			#var_dump($result1);
		}
		
		return $result1;
	 }
	 
	 
	 /**
	 * 得到单个机器的某个属性($property, $day, $hour, $minute)
	 * $day, $hour, $minute 是时间间隔 $id机器的id号
	 * $number 一次会显示$number行数据
	 */	
	 
	 function getSingleProperty($id, $property, $day, $hour, $minute, $number)
	 {
		$this->load->model('computer_model');
		$judge_temp = $this->computer_model->judge($id, $day, $hour, $minute, $number);
		if(!$judge_temp)
		{
			return show_message2('你选择的时间段超过我们收集的数据的时间段!', 'computer');
		}
	 
		$this->db->where('id', $id);
		$this->db->select('day, hour, minute');
		$query = $this -> db -> get('servers');
		#var_dump((array)($query -> row(count($query->result()) - 1)));
		$result1 = ((array)($query -> row(count($query->result()) - 1)));
		var_dump($result1);
		
		$property_result = array();
		
		var_dump((string)((int)($result1['minute']) - ($minute * 2)));
		
		$temp_day = (int)($result1['day']);
		$temp_hour = (int)($result1['hour']);
		$temp_minute = (int)($result1['minute']);
		
		for($i=0; $i<$number; $i++)
		{	
			if($temp_minute - $minute < 0)
			{
				$temp_hour = $temp_hour - 1;
				$temp_minute = $temp_minute + 60;
			}
			$this->db->where('minute', (string)($temp_minute - $minute));
			$temp_minute = $temp_minute - $minute;
			
			#var_dump($temp_minute);
			
			if($temp_hour - $hour < 0)
			{
				$temp_day = $temp_day - 1;
				$temp_hour = $temp_hour + 24;
			}
			$this->db->where('hour', (string)($temp_hour - $hour));
			$temp_hour = $temp_hour - $hour;
			
			#var_dump($temp_hour);
			
			$this->db->where('day', (string)($temp_day - $day));
			$temp_day = $temp_day - $day;
			
			#var_dump($temp_day);
			
			
			$this->db->select($property);
			$query = $this -> db -> get('servers');
			$property_result[$i] = ((array)($query -> row(0)));
			#var_dump($property_result[$number - 1]);
		}
		
		$result = Array();
		
		#var_dump($property_result);
		for($i=0; $i<count($property_result); $i++)
		{
			$result[$i] = $property_result[$number - $i -1][$property];
		}
		#var_dump($result);
		return $result;
	 }
	 
	 
	 /**
	 * 获得总共记录了多少时间($id)
	 * $id 机器编号
	 * 
	 */	
	 
	function totalMinute($id)
	{
		$this->db->where('id', $id);
		#$this->db->select(*);
		$query = $this -> db -> get('servers');
		
		#var_dump(count($query->result()));
		
		return count($query->result());
	}
	
	
	 /**
	 * 判断用户选择的时间段和显示个数是不是在收集范围之内($id, $day, $hour, $minute, $number)
	 * $id 机器编号
	 * $number 一次会显示$number行数据
	 * $day, $hour, $minute 是时间间隔
	 */
	 
	 function judge($id, $day, $hour, $minute, $number)
	 {
		$this->load->model('computer_model');
		
		$total_minute = $this->computer_model->totalMinute($id);
		
		$select_time = ($day * 1440 + $hour * 60 + $minute) * ($number - 1);
		
		#var_dump($select_time);
		
		if($total_minute > $select_time)
		{
			#var_dump('true');
			return true;
		}
		else
		{
			#var_dump('false');
			return false;
		}
	 }
	 
	 function get_computer_id()
	 {
		$this->db->select('id');
		$this->db->distinct();
		$temp_number = $this->db->get('servers');
		
		$result1 = array();
		for ($i=0; $i<=count($temp_number->result()) - 1; $i++)
		{
			#var_dump((array)($query -> row(count($query->result()) - 1)));
			$result1[$i] = array('id'=>($i + 1));
			#var_dump($result1);
		}
		
		
		#var_dump($result1);
		return $result1;
	 }
	 
	 function get_time($id, $day, $hour, $minute, $number)
	{
		$this->load->model('computer_model');
		$judge_temp = $this->computer_model->judge($id, $day, $hour, $minute, $number);
		if(!$judge_temp)
		{
			return show_message2('你选择的时间段超过我们收集的数据的时间段!', 'computer');
		}
	 
		$this->db->where('id', $id);
		$this->db->select('day, hour, minute');
		$query = $this -> db -> get('servers');
		#var_dump((array)($query -> row(count($query->result()) - 1)));
		$result1 = ((array)($query -> row(count($query->result()) - 1)));
		var_dump($result1);
		
		$property_result = array();
		
		var_dump((string)((int)($result1['minute']) - ($minute * 2)));
		
		$temp_day = (int)($result1['day']);
		$temp_hour = (int)($result1['hour']);
		$temp_minute = (int)($result1['minute']);
		
		$result = Array();
		for($i=0; $i<$number; $i++)
		{	
			$temp_time = Array();
			if($temp_minute - $minute < 0)
			{
				$temp_hour = $temp_hour - 1;
				$temp_minute = $temp_minute + 60;
			}
			#$this->db->where('minute', (string)($temp_minute - $minute));
			$temp_minute = $temp_minute - $minute;
			
			
			#var_dump($temp_minute);
			
			if($temp_hour - $hour < 0)
			{
				$temp_day = $temp_day - 1;
				$temp_hour = $temp_hour + 24;
			}
			#$this->db->where('hour', (string)($temp_hour - $hour));
			$temp_hour = $temp_hour - $hour;
			
			
			#var_dump($temp_hour);
			
			#$this->db->where('day', (string)($temp_day - $day));
			$temp_day = $temp_day - $day;
			$temp_time[0] = $temp_day;
			$temp_time[1] = $temp_hour;
			$temp_time[2] = $temp_minute;
			
			#var_dump($temp_day);
			
			$reuslt[$i] = implode(",", $temp_time);
			#var_dump($reuslt[$i]);
		}
		
		#var_dump($reuslt);
		
		return $reuslt;
	}
	 
}
?>