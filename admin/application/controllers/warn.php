<?php
/**
 * 警告信息控制器
 *
 *
 */
 class Warn extends Controller
 {
 
	/**
	 * 构造函数
	 *
	 * 登陆检验
	 */	
	 function __construct()
    {
        parent::Controller(); 
		if (!$this->session->userdata('logged_in')){          		
			redirect('login');
			exit();
		}
    }
	
	function index()
	{
		$warns = $this->get_finalresult();
		$data['warns'] = $warns;
		$this->load->view('computer/warn/list', $data);
		#$this->load->model('warn_model');
		#$this->warn_model->get_info_byid(1);
	}
	
	function get_warning()
	{
		$this->load->model('warn_model');
		$result_id = $this->warn_model->ident_id();
		$result = array();
		for($i=0; $i<count($result_id); $i++)
		{
			var_dump(implode($result_id[$i]));
			$result[$i]['result'] = $this->warn_model->get_info_byid(implode($result_id[$i]));
			$result[$i]['time'] = $this->warn_model-> get_time_byid(implode($result_id[$i]));
		}
		#var_dump($result);
		return $result;
	}
	
	function get_finalresult()
	{
		$this->load->model('warn_model');
		$result_id = $this->warn_model->ident_id();
		$result= array();
		$result = $this->get_warning();
		var_dump($result);
		
		$count = 0;
		$info = array();
		
		for($i=0; $i<count($result_id); $i++)
		{
			if($result[$i]['time']['day'] != null)
			{
				$total = $result[$i]['time']['day'] * 24 + $result[$i]['time']['hour'];
		        for($j=0; $j<($total / 6) + 1; $j++)
				{	
					$info[$count]['end'] = $total; 
					if(($total - 6)<0)
					{
						$total = 6;
					}
					$info[$count]['start'] = $total - 6;
					$total = $total - 6;
					$info[$count]['id'] = $i + 1;
					$info[$count]['desc'] = '';
					#$temp_result = implode($result[$count]['result']);
					var_dump(count($result[$count]['result']));
					$result[$count]['result'][0]['is_cpu_overload'] = $result[$count]['result'][0]['is_cpu_overload'];
					$result[$count]['result'][0]['is_cpu_lowload'] = $result[$count]['result'][1]['is_cpu_lowload'];
					$result[$count]['result'][0]['is_mem_overload'] = $result[$count]['result'][2]['is_mem_overload'];
					$result[$count]['result'][0]['is_mem_lowload'] = $result[$count]['result'][3]['is_mem_lowload'];
					$result[$count]['result'][0]['is_hardware_overload'] = $result[$count]['result'][4]['is_hardware_overload'];
					$result[$count]['result'][0]['is_hardware_lowload'] = $result[$count]['result'][5]['is_hardware_lowload'];
					
					var_dump($result[$count]['result'][0]);
					
					$d = 0;
						if($result[$count]['result'][$d]['is_cpu_lowload'] == 1)
						{
							var_dump(10);
							$info[$count]['desc'] =$info[$count]['desc'] . '您的CPU在80%的时间都处在过低运行状态。 ';
						}
						
						if($result[$count]['result'][$d]['is_cpu_overload'] == 1)
						{
							$info[$count]['desc'] = $info[$count]['desc'] . '<br >';
							$info[$count]['desc'] = $info[$count]['desc'] . '您的CPU在80%的时间都处在过过载状态。 ';
						}
						
						if($result[$count]['result'][$d]['is_mem_overload'] == 1)
						{
							$info[$count]['desc'] = $info[$count]['desc'] . '<br >';
							$info[$count]['desc'] = $info[$count]['desc'] . '您的内存在80%的时间都处在过载状态。 ';
						}
						
						if($result[$count]['result'][$d]['is_mem_lowload'] == 1)
						{
							$info[$count]['desc'] = $info[$count]['desc'] . '<br >';
							$info[$count]['desc'] = $info[$count]['desc'] . '您的内存在80%的时间都处在过低运行状态。 ';
						}
						
						if($result[$count]['result'][$d]['is_hardware_overload'] == 1)
						{
							$info[$count]['desc'] = $info[$count]['desc'] . '<br >';
							$info[$count]['desc'] = $info[$count]['desc'] . '您的硬盘在80%的时间都处在过载运行状态。 ';
						}
						
						if($result[$count]['result'][$d]['is_hardware_lowload'] == 1)
						{
							$info[$count]['desc'] = $info[$count]['desc'] . '<br >';
							$info[$count]['desc'] = $info[$count]['desc'] . '您的硬盘在80%的时间都处在过低运行状态。 ';
						}
					
					
					$count++;
				}
			}	
			else{
				$info[$count]['end'] = 0;
				$info[$count]['start'] = 0;
				$info[$count]['id'] = $i + 1;
				$info[$count]['desc'] = '';
				$info[$count]['desc'] = $info[$count]['desc'] . '服务器没有启动';
				$count++;
			}
			
		}
		
		var_dump($info);
		
		return $info;
	}
 }
?>