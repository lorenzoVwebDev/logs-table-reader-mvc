<?php
class Model {
  private string $log_message; 
  private string $log_type; 
  use Database;
  
  function __construct($log_message, $log_type) {
    $this->log_message = $log_message;
    $this->log_type = $log_type;
  }
  
  function logException() {
    try {
      if (file_exists(__DIR__ ."\\..\\models\\logs.model.php")) {
        require_once(__DIR__ ."\\..\\models\\logs.model.php");

        $exception_log = new Logs_model($this->log_message, $this->log_type);
        $last_log_message = $exception_log->logException();
        unset($exception_log);
        return $last_log_message;
      
      } else {
        throw new Exception('logs.model.php not found');
      } 
    } catch (Exception $e) {
      require_once(__DIR__ ."\\..\\models\\logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $last_log_message = $exception->logException();
      unset($exception);
    } 
  } 

  function logError() {
    try {
      if (file_exists(__DIR__."\\..\\models\\logs.model.php")) {
        require_once(__DIR__."\\..\\models\\logs.model.php");

        $error_log = new Logs_model($this->log_message, $this->log_type);
        $last_log_message = $error_log->logError();
        unset($error_log);
        return $last_log_message;
      } else {
        throw new Exception('logs.model.php not found');
      }
    } catch (Exception $e) {
      require_once(__DIR__ ."\\..\\models\\logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $last_log_message = $exception->logException();
      unset($exception);
    }
  }
}