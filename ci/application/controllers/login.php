<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
		//Sets the variable $title to be used in your views
		$this->stencil->title('Login');

		//Sets the layout to be home_layout (/views/layouts/home_layout.php)
		$this->stencil->layout('login_layout');

		//Adds Font-Awesome to the homepage (/assets/css/font-awesome.css)
		$this->stencil->css('font-awesome');

		//Sets the variable $welcome_text to be used in your views
		//You can bind data to the views many different ways -- this is just one of them
		$this->stencil->data('welcome_text', 'Welcome to Stencil!');

		//Mixes everything together and loads the home_view as the $content variable in the layout
		//home_view is located here: /views/pages/home_view.php
		$this->stencil->paint('login_view', array('is_logged_in' => false, 
                                                         'avatar' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash1/t5.0-1/372587_43806233_1380433586_q.jpg', 
                                                         'name'   => 'Kevin'));
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
