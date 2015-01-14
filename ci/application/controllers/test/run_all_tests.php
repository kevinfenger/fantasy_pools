<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . '/libraries/CIPHPUnit_Controller.php');

class Run_all_tests extends CIPHPUnit_Controller
{
    public function __construct()
    {
        parent::__construct('/controller_dir/','model_dir_prefix/',array('tests_to_exclude_model'));
    }
    function index($database)
    {
        parent::run_test_suite(); 
    }
}
