<?php defined('BASEPATH') OR exit('No direct script access allowed');

abstract class CIPHPUnit_Controller extends CI_Controller {
    var $model_name; 
    var $test_controller_dir;
    var $test_model_dir; 
    var $class_name;  
     
    function __construct($test_controller_dir='/v1/test/',$test_model_dir='test/',$ignored_models=array()) {
        parent::__construct();
        $this->load->helper('url');
        $this->test_controller_dir = $test_controller_dir; 
        $this->model_name = strtolower(get_class($this)) . '_model';
        $this->test_model_dir = $test_model_dir;
        $this->class_name = strtolower(get_class($this)); 
        $this->ignored_models = $ignored_models;  
    }
    function index() {
        $data['units'] = $this->_run_multiple_test_cases();
        $header_data['home'] = anchor($this->test_controller_dir . 'run_all_tests', 'CIPHPUnit', $this->class_name);
        $header_data['header_title'] = $this->class_name;
        $header_data['failed_tests'] = $data['units'][0]['failed_tests'];

        $this->load->view('test/header', $header_data);
        $this->load->view('test/unit_test_results', $data); 
        $this->load->view('test/footer'); 
    }
    function single_test_case($method) { 
        $data['units'] = $this->_run_single_test_case($method); 
        $header_data['header_title'] = $this->class_name . ':' . $method;
        $header_data['failed_tests'] = $data['units'][0]['failed_tests'];
        $header_data['home'] = anchor($this->test_controller_dir . 'run_all_tests', 'CIPHPUnit', $this->class_name);

        $this->load->view('test/header', $header_data);
        $this->load->view('test/unit_test_results', $data); 
        $this->load->view('test/footer'); 
    }
    function run_test_suite() { 
        $successful_tests = $failed_tests = 0;
         
        $data['units'] = $this->_run_multiple_units($successful_tests, $failed_tests); 
        $header_data['header_title'] = 'All Tests';
        $header_data['failed_tests'] = $failed_tests;
        $header_data['home'] = anchor($this->test_controller_dir . 'run_all_tests', 'CIPHPUnit', $this->class_name);
         
        $footer_data['failed_tests'] = $failed_tests; 
        $footer_data['successful_tests'] = $successful_tests; 
        $footer_data['total_tests'] = $failed_tests + $successful_tests; 
        $this->load->view('test/header', $header_data);
        $this->load->view('test/unit_test_results', $data); 
        $this->load->view('test/footer', $footer_data); 
    }

    private 
    function _run_multiple_units(&$total_successful_tests, &$total_failed_tests) { 
        // We need to run all the tests that live in the model directory
        $total_failed_tests = 0; 
        $total_successful_tests = 0; 
        $this->load->helper('file');
        $test_models = get_filenames(APPPATH .'models/'.$this->test_model_dir);
        $units = array(); 
         
        foreach($test_models as $tm) 
        { 
            $class_name = str_replace('.php', "", $tm);
            $this->_set_model_name($class_name);
            
            // as long as the test_model isn't in ignored_models list 
            // run all the test cases in it.  
            if (!(in_array($this->_get_model_name(), $this->ignored_models))) { 
                $this->_set_class_name(str_replace('_model', "", $class_name));  
                $model_test_results = $this->_run_multiple_test_cases(); 
                $total_failed_tests += $model_test_results[0]['failed_tests']; 
                $total_successful_tests += $model_test_results[0]['successful_tests'];
                $units[] = $model_test_results[0];  
            }
        }
        return $units;  
    }

    private 
    function _run_multiple_test_cases() { 
        $failed_tests = 0; 
        $successful_tests = 0; 
        $this->load->model($this->_get_model_path(), '', TRUE);

        if (method_exists($this->{$this->model_name}, 'pre'))
           $this->{$this->model_name}->pre();
            
        $methods = get_class_methods($this->{$this->model_name});
        $data['unit_name'] = anchor($this->test_controller_dir . $this->class_name, $this->class_name);
         
        foreach ($methods as $method) {
           $test_cases = $this->_populate_test_case($method, $successful_tests, $failed_tests);
           if ($test_cases) 
               $data['test_cases'][] = $test_cases; 
        }

        if (method_exists($this->{$this->model_name}, 'post'))
            $this->{$this->model_name}->post();
        
        $data['failed_tests']     = $failed_tests; 
        $data['successful_tests'] = $successful_tests; 
        $data['total_tests']      = $failed_tests + $successful_tests;
        
        return array($data); 
    }

    private 
    function _run_single_test_case($method) { 
        $successful_tests = 0; 
        $failed_tests = 0;
        
        $this->load->model($this->_get_model_path(), '', TRUE);

        if (method_exists($this->{$this->model_name}, 'pre'))
           $this->{$this->model_name}->pre();

        $data['unit_name']        = anchor($this->test_controller_dir . $this->class_name, $this->class_name);
        $data['test_cases'][]     = $this->_populate_test_case($method, $successful_tests, $failed_tests);
        $data['failed_tests']     = $failed_tests; 
        $data['successful_tests'] = $successful_tests; 
        $data['total_tests']      = $failed_tests + $successful_tests;
        
        if (method_exists($this->{$this->model_name}, 'post'))
            $this->{$this->model_name}->post();

        return array($data); 
    }
    
    private 
    function _populate_test_case($method, &$successful_tests, &$failed_tests) 
    {
        $test_case_array = array();  
        if (strpos($method,'test__') === 0) { 
            // if it has a prefix of test__ run it
            if (method_exists($this->{$this->model_name}, 'pre_test_case'))
               $this->{$this->model_name}->pre_test_case();

            $test_case_array['test_case_name'] = anchor($this->test_controller_dir . $this->class_name . '/' . $method, $method); 
            @$this->{$this->model_name}->{$method}();
            foreach ($this->_get_assert_results() as $result) {
                $test_case_array['asserts'][] = $result; 
            }
            if($this->_get_failed_assertion_status()) {  
                $test_case_array['test_failed'] = true; 
                $failed_tests++; 
            } 
            else { 
                $test_case_array['test_failed'] = false; 
                $successful_tests++; 
            }
            
            if (method_exists($this->{$this->model_name}, 'post_test_case'))
               $this->{$this->model_name}->post_test_case();

            $this->_clear_assert_results(); 
        }
        return $test_case_array; 
    }
    
    private 
    function _set_class_name($class_name) { 
        $this->class_name = $class_name; 
    }
    private 
    function _set_model_name($model_name) { 
        $this->model_name = $model_name; 
    }
    private 
    function _get_model_name() { 
        return $this->model_name; 
    }
    private 
    function _get_model_path() { 
        return $this->test_model_dir . $this->model_name;
    }
    private 
    function _get_assert_results() {
         if (!empty($this->{$this->model_name}->assert_results)) 
             return $this->{$this->model_name}->assert_results; 
         else 
             return array(); 
    }
    private 
    function _clear_assert_results() { 
         $this->{$this->model_name}->assert_results = null;
         $this->{$this->model_name}->failed_assertion = false; 
    }
    private 
    function _get_failed_assertion_status() { 
         return $this->{$this->model_name}->failed_assertion; 
    }
}
