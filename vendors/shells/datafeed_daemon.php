<?php

//if (!include(CORE_PATH . 'cake' . DS . 'bootstrap.php')) {
//    trigger_error("Can't find CakePHP core.  Check the value of CAKE_CORE_INCLUDE_PATH in app/webroot/index.php.  It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
// }

class DatafeedDaemonShell extends Shell {
	var $uses = array('Datafeed', 'Datarow');
	function main() {
		//var_dump($this);
		if (count($this->args) != 1) {
			echo "No feed specified\n";
			exit();
		}
		$this->log("Running " . $this->args[0]);
		
		set_include_path(get_include_path().PATH_SEPARATOR.ROOT . DS . APP_DIR);
		ini_set("memory_limit","32M");	
		App::import('Core', 'Controller'); 
		App::import('Controller', 'Datafeeds');
		App::import('Model', 'Datafeed');
	
		$feedcontroller = new DatafeedsController();
		$feedcontroller->constructClasses();
		
		while (true) {	
			//$this->log("val = " . $this->args[0]);
			$mem_usage = memory_get_usage();
			$this->log("Current memory usage: $mem_usage");
			if($mem_usage > Configure::read('maximum_crawler_memory')) {sleep(60);}
			$feedcontroller->searchfeed($this->args[0]);
			//sleep(60);
		}
	}

	function log($str) {
		echo date("Y-m-d H:i:s") . " - [LOG]:" . $str . "\n";
	}

}


?>
