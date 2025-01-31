<?php
class Model {
  use Database;
  
  function __construct() {
  }
  
  function logEvent($log_message, $log_type) {
    try {
      if (file_exists(__DIR__ ."/../models/logs.model.php")) {
        require_once(__DIR__ ."/../models/logs.model.php");

        $event_log = new Logs_model($log_message, $log_type);
        $event_log_method = "log".ucfirst($log_type);
        $last_log_message = $event_log->$event_log_method();
        unset($event_log);
        if ($last_log_message[0] === 500) {
          $error_message = $last_log_message;
          return $error_message;
        } else {
          return $last_log_message;
        }
      } else {
        throw new Exception('logs.model.php not found');
      } 
    } catch (Exception $e) {
      require_once(__DIR__ ."/../models/logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $exception->logException();
      return $e->getMessage();
      unset($exception);
    } 
  } 

  function logsArray($logType) {
    try {
      if (file_exists(__DIR__ ."/../models/logs_array.model.php")) {
        require_once(__DIR__ ."/../models/logs_array.model.php");
        $array_creation = new Logs_array_model($logType);
        $array_creation_method = "array".ucfirst($logType);
        $logArray = $array_creation->$array_creation_method();
        unset($array_creation);
        if (is_array($logArray)) {
          return $logArray;
        } else {
          $error_message = $logArray;
          return $error_message;
        }
      } else {
        throw new Exception('logs_array.model.php not found');
      } 
    } catch (Exception $e) {
      require_once(__DIR__ ."/../models/logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $exception->logException();
      return $e->getMessage();
      unset($exception);
    } 
  }

}