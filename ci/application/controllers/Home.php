<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head');

		//Sets the variable $header to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header');
	}

	public function index()
	{
		$this->stencil->title('Fantasy Games');
		$this->stencil->layout('home_layout');
		$this->stencil->css('font-awesome');
                if ($this->session->userdata('id'))  
                    $this->stencil->slice(array('content' => 'my_teams'));
                else 
		    $this->stencil->css('welcome-body');
                    $this->stencil->slice(array('content' => 'welcome'));
		$this->stencil->paint('home_view');
	}

	//Example of using a different Layout
	public function subpage()
	{
		$this->stencil->title('Subpage Example');
		$this->stencil->layout('subpage_layout');

		//Slices are view snippets that can be reused over and over again.
		//They can either be simple and basic or very robust and powerful.
		//For full explanation of what they can do, please visit the docs.
		$this->stencil->slice('sidebar');

		$data['subpage_text'] = 'A Subpage Example!';
		$this->stencil->paint('example_view', $data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
