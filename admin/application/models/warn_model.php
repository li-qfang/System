<?php
/**
 * 警告信息属性
 * 只显示过去运行48小时内的警告信息
 *
 */
 class Warn_model extends Model
 {
	
	function __construct()
    {
        parent::Model();
		$this -> load -> database();
    }
	
	function ident_id()
	{
		$this->db->select('id');
		$this->db->distinct();
		$temp_number = $this->db->get('warning');
		
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
	
	function get_info_byid($id)
	{
		$this->db->where('id', $id);
		$this->db->select('day, hour, minute');
		$query = $this -> db -> get('warning');
		$result = ((array)($query -> row(count($query->result()) - 1)));
		#var_dump($result);
		
		$number = count($query->result());
		#var_dump($number);
		
		$temp_day = $result['day'];
		$temp_hour = $result['hour'];
		$temp_minute = $result['minute'];
		$lost = 0;
		
		$judge_result = array();
		$judge = array();
		$result_day = $result['day'];
		$result_hour = $result['hour'] - 6;
		#考虑hour是负数的情况
		$result_minute = $result['minute'];
		
		for($i=0; $i<$number; $i++)
		{
			if($temp_minute - 1 < 0)
			{
				if(($temp_hour - 1) < 0)
				{
					$temp_hour = $temp_hour + 24;
					$temp_day = $temp_day - 1;
				}
				
				$temp_minute = $temp_minute + 60;
				$temp_hour = $temp_hour - 1;
			}
			
			if($temp_day >= 0)
			{
				$temp_minute = $temp_minute - 1;
				#var_dump($temp_day);
				#var_dump($temp_hour);
				#var_dump($temp_minute);
				#var_dump($i);
				$this->db->where('day', $temp_day);
				$this->db->where('hour', $temp_hour);
				$this->db->where('minute', $temp_minute);
				$this->db->select('is_cpu_overload, is_cpu_lowload, is_mem_overload, is_mem_lowload, is_hardware_overload, is_hardware_lowload');
				$jquery = $this -> db -> get('warning');
				#var_dump($jquery->result());
				if($jquery->result() != null)
				{
					$judge_result[$i] = ((array)($jquery -> row(count(0))));
				}else
				{
						#var_dump($i);
						$judge_result[$i]['is_cpu_overload'] = -1;
						$judge_result[$i]['is_cpu_lowload'] = -1;
						$judge_result[$i]['is_mem_overload'] = -1;
						$judge_result[$i]['is_mem_lowload'] = -1;
						$judge_result[$i]['is_hardware_overload'] = -1;
						$judge_result[$i]['is_hardware_lowload'] = -1;
				}
			}
		}
		
		#var_dump($judge);
		#$temp_result = array();
		
		
		#取出中间的数据 就是360的倍数 因为是每隔6个小时测试一下数据
		for($i=0; $i<count($judge_result); $i++)
		{
			#$temp_result[$i] = $judge_result[$i] ;
			if(($i!=0)&&((($i+1) % 360) == 0))
			{
				$temp_id = $i - 360;
				$is_cpu_overload = 0;
				$is_cpu_lowload = 0;
				$is_mem_overload = 0;
				$is_mem_lowload = 0;
				$is_hardware_overload = 0;
				$is_hardware_lowload = 0;
				for($j=$temp_id; $j<$i; $j++)
				{				
					if($judge_result[$i]['is_cpu_overload'] == 1)
						$is_cpu_overload++;
					
					if($judge_result[$i]['is_cpu_lowload'] == 1)
						$is_cpu_lowload++;
						
					if($judge_result[$i]['is_mem_overload'] == 1)
						$is_mem_overload++;
					
					if($judge_result[$i]['is_mem_lowload'] == 1)
						$is_mem_lowload++;
						
					if($judge_result[$i]['is_hardware_overload'] == 1)
						$is_hardware_overload++;
					
					if($judge_result[$i]['is_hardware_lowload'] == 1)
						$is_hardware_lowload++;
				}
				
				if(((double)($is_cpu_overload)/360.0) > 0.8)
					$judge[($i+1) % 360 - 1]['is_cpu_overload'] = 1;
				else
					$judge[count($judge)]['is_cpu_overload'] = -1;
					
				if(((double)($is_cpu_lowload)/360.0) > 0.8)
					$judge[($i+1) % 360 - 1]['is_cpu_lowload'] = 1;
				else
					$judge[($i+1) % 360 - 1]['is_cpu_lowload'] = -1;
				
				if(((double)($is_mem_overload)/360.0) > 0.8)
					$judge[($i+1) % 360 - 1]['is_mem_overload'] = 1;
				else
					$judge[($i+1) % 360 - 1]['is_mem_overload'] = -1;
					
				if(((double)($is_mem_lowload)/360.0) > 0.8)
					$judge[($i+1) % 360 - 1]['is_mem_lowload'] = 1;
				else
					$judge[($i+1) % 360 - 1]['is_mem_lowload'] = -1;
				
				if(((double)($is_hardware_overload)/360.0) > 0.8)
					$judge[($i+1) % 360 - 1]['is_hardware_overload'] = 1;
				else
					$judge[($i+1) % 360 - 1]['is_hardware_overload'] = -1;
					
				if(((double)($is_hardware_lowload)/360.0) > 0.8)
					$judge[($i+1) % 360 - 1]['is_hardware_lowload'] = 1;
				else
					$judge[($i+1) % 360 - 1]['is_hardware_lowload'] = -1;
			}
		}
		
		
		#取出最后面的数据 就是剩下不是360的倍数 
		
			$is_cpu_overload = 0;
				$is_cpu_lowload = 0;
				$is_mem_overload = 0;
				$is_mem_lowload = 0;
				$is_hardware_overload = 0;
				$is_hardware_lowload = 0;
				
				#var_dump(count($judge_result));
				for($j=count($judge) * 360; $j<count($judge_result); $j++)
				{
					#var_dump($j);
					#var_dump($judge_result[$i]['is_cpu_lowload']);
					if($judge_result[$j] != null)
					{
						if($judge_result[$j]['is_cpu_overload'] == 1)
							$is_cpu_overload++;
						
						if($judge_result[$j]['is_cpu_lowload'] == 1)
							$is_cpu_lowload++;
						
							
						if($judge_result[$j]['is_mem_overload'] == 1)
							$is_mem_overload++;
						
						if($judge_result[$j]['is_mem_lowload'] == 1)
							$is_mem_lowload++;
							
						if($judge_result[$j]['is_hardware_overload'] == 1)
							$is_hardware_overload++;
						
						if($judge_result[$j]['is_hardware_lowload'] == 1)
							$is_hardware_lowload++;
					}
				}
				
				#var_dump($is_hardware_lowload);
				#var_dump($is_hardware_overload);
				#var_dump($is_mem_overload);
				#var_dump($is_mem_lowload);
				#var_dump($is_cpu_overload);
				#var_dump($is_cpu_lowload);
				
				$total = count($judge_result) - count($judge) * 360;
				
				if($total != 0)
				{
					if(((double)($is_cpu_overload)/(double)($total)) > 0.8)
						$judge[count($judge)]['is_cpu_overload'] = 1;
					else
						$judge[count($judge)]['is_cpu_overload'] = -1;
						
					if(((double)($is_cpu_lowload)/(double)($total)) > 0.8)
						$judge[count($judge)]['is_cpu_lowload'] = 1;
					else
						$judge[count($judge)]['is_cpu_lowload'] = -1;
					
					if(((double)($is_mem_overload)/(double)($total)) > 0.8)
						$judge[count($judge)]['is_mem_overload'] = 1;
					else
						$judge[count($judge)]['is_mem_overload'] = -1;
						
					if(((double)($is_mem_lowload)/(double)($total)) > 0.8)
						$judge[count($judge)]['is_mem_lowload'] = 1;
					else
						$judge[count($judge)]['is_mem_lowload'] = -1;
					
					if(((double)($is_hardware_overload)/(double)($total)) > 0.8)
						$judge[count($judge)]['is_hardware_overload'] = 1;
					else
						$judge[count($judge)]['is_hardware_overload'] = -1;
						
					if(((double)($is_hardware_lowload)/(double)($total)) > 0.8)
						$judge[count($judge)]['is_hardware_lowload'] = 1;
					else
						$judge[count($judge)]['is_hardware_lowload'] = -1;
				}
		
		#var_dump($judge);
		return $judge;
	
	}
	
	function get_time_byid($id)
	{
		$this->db->where('id', $id);
		$this->db->select('day, hour, minute');
		$query = $this -> db -> get('warning');
		$result = ((array)($query -> row(count($query->result()) - 1)));
		
		return $result;
	}
 }
?>