<?php
/**
 * 警告信息控制器
 *
 *
 */
 class Email extends Controller
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
		$data['people'] =  "111";
		$this->load->view('computer/email/list', $data);
	}
 }
 
 ?>