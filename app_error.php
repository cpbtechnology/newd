<?php
	class AppError extends ErrorHandler {
		var $helpers = array('Html','Form','Javascript');
		function error404() {
			$this->_outputMessage('error404');
		}
	}
?>
