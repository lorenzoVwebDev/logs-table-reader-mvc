<?php

class Logs_model {
  private string $log_message; 
  private string $log_type; 
  
  function __construct($log_message, $log_type) {
    $this->log_message = $log_message;
    $this->log_type = $log_type;
  }
  
  function logException() {
    try {
      $date = date('m.d.Y h:i:s');
      $error_log = $date." | User Error | ".$this->log_message."\n";
      define('USER_ERROR_LOG', LOGS."\\exceptions\\". date('mdy').".log");
      error_log($error_log, 3, USER_ERROR_LOG);

      $logFile = fopen(LOGS."\\exceptions\\".date('mdy').".log", 'r'); 

      if (isset($logFile)) {
        $logsArray = [];
        $row_count = 0;
        while (!feof($logFile)) {
          $logsArray[$row_count] = explode(' | ', fgets($logFile));
          $row_count++;
        }
        $row_count--;
        unset($logsArray[$row_count]);
        fclose($logFile);
        if (trim($logsArray[count($logsArray) - 1][2]) === trim($this->log_message)) {
          $last_log_message = trim($logsArray[count($logsArray) - 1][2]);
          unset($logsArray);
          return $last_log_message;
        } else {
          http_response_status(500);
          header('Content-Type: text/plain');
          echo 'Error: We are going to fix it as soon as possible';
          throw new Exception('The exception has not been logged');
        }
      } else {
        http_response_status(500);
        header('Content-Type: text/plain');
        echo 'Error: We are going to fix it as soon as possible';
        throw new Exception(date('mdy')."Exception log file not found");
      }


    } catch (Exception $e) {
      $e->getMessage();
    }
  }

  function logError() {
    try {
      $date = date('m.d.Y h:i:s');
      $error_log = $date." | System Error | ".$this->log_message."\n";
      define('SYSTEM_ERROR_LOG', LOGS."\\errors\\". date('mdy').".log");
      error_log($error_log, 3, SYSTEM_ERROR_LOG);

      $logFile = fopen(LOGS."\\errors\\".date('mdy').".log", 'r'); 

      if (isset($logFile)) {
        $logsArray = [];
        $row_count = 0;
        while (!feof($logFile)) {
          $logsArray[$row_count] = explode(' | ', fgets($logFile));
          $row_count++;
        }
        $row_count--;
        unset($logsArray[$row_count]);
        fclose($logFile);
        if (trim($logsArray[count($logsArray) - 1][2]) === trim($this->log_message)) {
          $last_log_message = trim($logsArray[count($logsArray) - 1][2]);
          unset($logsArray);
          return $last_log_message;
        } else {
          http_response_status(500);
          header('Content-Type: text/plain');
          echo 'Error: We are going to fix it as soon as possible';
          throw new Exception('The exception has not been logged');
        }
      } else {
        http_response_status(500);
        header('Content-Type: text/plain');
        echo 'Error: We are going to fix it as soon as possible';
        throw new Exception(date('mdy')."Exception log file not found");
      }
    } catch (Exception $e) {
      $e->getMessage();
    }
  }
}