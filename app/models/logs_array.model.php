<?php
class Logs_array_model {
  private string $type;
  function __construct($type) {
    $this->type = $type;
  }

  function arrayException() {
    if (file_exists(LOGS."//exceptions//".date('mdy').".log")) {
      $logFile = fopen(LOGS."//exceptions//".date('mdy').".log", "r");
      $error_array[0] = array(
        0 => 'Date',
        1 => 'Type',
        2 => 'Message',
      );
      $row_count = 1;
      while (!feof($logFile)) {
        $error_array[$row_count] = explode(" | ", fgets($logFile));
        $row_count++;
      }
      fclose($logFile);
      unset($error_array[count($error_array)-1]);
      return $error_array;
    } else {
      return "log file not found";
    }
  }

  function arrayError() {
    if (file_exists(LOGS."//errors//".date('mdy').".log")) {
      $logFile = fopen(LOGS."//errors//".date('mdy').".log", "r");
      $error_array[0] = array(
        0 => 'Date',
        1 => 'Type',
        2 => 'Message',
      );
      $row_count = 1;
      while (!feof($logFile)) {
        $error_array[$row_count] = explode(" | ", fgets($logFile));
        $row_count++;
      }
      fclose($logFile);
      unset($error_array[count($error_array)-1]);
      return $error_array;
    } else {
      return "log file not found";
    }
  }

  function arrayAccess() {
    if (file_exists(LOGS."\\access\\".date('mdy').".log")) {
      $logFile = fopen(LOGS."\\access\\".date('mdy').".log", "r");
      $error_array[0] = array(
        0 => 'Date',
        1 => 'Type',
        2 => 'Message',
      );
      $row_count = 1;
      while (!feof($logFile)) {
        $error_array[$row_count] = explode(" | ", fgets($logFile));
        $row_count++;
      }
      fclose($logFile);
      unset($error_array[count($error_array)-1]);
      return $error_array;
    } else {
      return "log file not found";
    }
  }
}