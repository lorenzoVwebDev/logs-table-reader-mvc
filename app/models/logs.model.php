<?php

class Logs_model {
  private string $log_message; 
  private string $log_type; 
  
  function __construct(string $log_message,string $log_type) {
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
          return array(
            0 => 500,
            1 => 'The exception has not been logged'
          );
        }
      } else {
        return array(
          0 => 500, 
          1 => date('mdy')."Exception log file not found"
        );
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
          return array(
            0 => 500,
            1 => 'The error has not been logged'
          );
        }
      } else {
        return array(
          0 => 500, 
          1 => date('mdy')."Error log file not found"
        );
      }
    } catch (Exception $e) {
      $e->getMessage();
    }
  }

  function logAccess() {
    try {
      $date = date('m.d.Y h:i:s');
      $access_log = $date . " | access | " . $this->log_message . "\n";
      define('ACCESS_LOG', LOGS . "\\access\\". date('mdy'). ".log");
      $logFile = fopen(ACCESS_LOG, "a");
      if (isset($logFile)) {
        fwrite($logFile, $access_log);
        fclose($logFile);
        unset($logFile);
        $logFile = fopen(ACCESS_LOG, "r");
        if (isset($logFile)) {
          $logsArray = [];
          $row_count = 0;
          while (!feof($logFile)) {
            $logsArray[$row_count] = explode(" | ", fgets($logFile));
            $row_count++;
          }
          $row_count--;
          unset($logsArray[$row_count]);
          fclose($logFile);  
          if (trim($logsArray[count($logsArray)-1][2]) === trim($this->log_message)) {
            $last_log_message = trim($logsArray[count($logsArray)-1][2]);
            unset($logsArray);
            return $last_log_message;
          } else {
            return array(
              0 => 500,
              1 => 'The access has not been logged'
            );
          } 
        }
      } else {
        return array(
          0 => 500, 
          1 => date('mdy')."Access log file not found"
        );
      }
    } catch (Exception $e) {
      $e->getMessage();
    }
  }
}