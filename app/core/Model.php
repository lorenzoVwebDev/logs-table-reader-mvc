<?php
class Model {
  use Database;
  
  function __construct() {
  }
  
  function logEvent($log_message, $log_type) {
    try {
      if (file_exists(__DIR__ ."\\..\\models\\logs.model.php")) {
        require_once(__DIR__ ."\\..\\models\\logs.model.php");

        $event_log = new Logs_model($log_message, $log_type);
        $event_log_method = "log".ucfirst($log_type);
        $last_log_message = $event_log->$event_log_method();
        unset($exception_log);
        return $last_log_message;
      
      } else {
        throw new Exception('logs.model.php not found');
      } 
    } catch (Exception $e) {
      require_once(__DIR__ ."\\..\\models\\logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $exception->logException();
      unset($exception);
    } 
  } 

}