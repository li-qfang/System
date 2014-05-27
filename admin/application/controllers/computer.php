<?php
/**
 * 机器信息控制器
 *
 *
 */
 class Computer extends Controller
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
		$this->load->model('computer_model');
		
		#$data['result'] = $this->computer_model->category();
		#$this->computer_model->getSingleProperty(1, 'free_mem', 0, 0, 5, 25);
		#$this->load->view('computer/category/list',$data);
		#$temp = $this->computer_model->judge(1, 0, 0, 5, 20);
		$this->computer_model->get_time(1, 0, 0, 5, 25);
		#$this->computer_model->get_computer_id();
	}
	
	function category()
	{
		$this->load->model('computer_model');
		
		$data['result'] = $this->computer_model->category();
		
		$this->load->view('computer/category/list',$data);
	}
	
	function single()
	{
		$data['computer_id'] = ($this->input->post('computer_id'))?($this->input->post('computer_id')):0;
		$data['property'] = ($this->input->post('property'))?($this->input->post('property')):'pro_number';
		$data['day'] = ($this->input->post('day'))?($this->input->post('day')):0;
		$data['hour'] = ($this->input->post('hour'))?($this->input->post('hour')):0;
		$data['minute'] = ($this->input->post('minute'))?($this->input->post('minute')):0;
		$data['number'] = ($this->input->post('number'))?($this->input->post('number')):5;
		
		#var_dump($property);
		
		
	
		$data['computer_selected'] = 0;
		$data['property_selected'] = '';
		$data['day_selected'] = 0;
		$data['hour_selected'] = 0;
		$data['minute_selected'] = 0;
		$data['number_selected'] = 0;
		#$this->load->view('computer/single/list', $data);
		
		$this->load->model('computer_model');
		$data['computer'] = $this->computer_model->get_computer_id();
		$data['result'] = 0;
		$data['time'] = 0;
		// ajax 
		if (!empty($segments['ajax']) || $data['minute'] != 0){
			#var_dump($minute);
			#var_dump("321");
			$data['result'] = $this->computer_model-> getSingleProperty($data['computer_id'],
		$data['property'],$data['day'],$data['hour'],$data['minute'],$data['number']);
		
			#$data['result'] = implode(",", $data['result']);
			$data['time'] = $this->computer_model-> get_time($data['computer_id'],
		$data['day'],$data['hour'],$data['minute'],$data['number']);
		
			#$this->load->view('computer/single/ajax_list',$data);
			//$arr['time'] = $data['time'];
			$arr = $data['result'];
			array_unshift($arr, -1);
			//$myjson = json_encode($arr);
			echo implode(',',$arr);
		// 非 ajax
		}else{
			#var_dump($minute);
			#var_dump("123");
            $this->load->view('computer/single/list',$data);
			#$this->load->view('computer/single/ajax_list',$data);
		}
		
	}
	
	
	
	
	
 }
?>