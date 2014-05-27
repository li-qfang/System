<?php
/**
 * 框架
 *
 *
 */
class Frameset extends Controller
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

	// --------------------------------------------------------------------

    /**
     * 框架集
     *
     */
    function index()
    {
        $this->load->view('_frameset');
    }

    // --------------------------------------------------------------------
    
    /**
     * 顶部菜单
     *
     */
    function top()
    {
        $this->load->view('_top');
    }

    // --------------------------------------------------------------------
    
    /**
     * 左侧菜单
     *
     */
    function menu($type = 'system')
    {
		switch($type){
			case 'computer' : $this->load->view('computer/menu'); break;
			case 'system' : $this->load->view('system/menu'); break;
		}
    }

}