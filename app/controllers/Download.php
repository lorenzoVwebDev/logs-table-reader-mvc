<?php
class Download extends Controller {
  function downloadlogs($type) {

    if (isset($_GET)) {
      if (isset($_GET['type']) && $_GET['type'] === $type) {
        switch ($type) {
          case 'exception':
            $log_file = LOGS."\\exceptions\\". date('mdy').".log";
            break;
          case 'error':
            $log_file = LOGS."\\errors\\". date('mdy').".log";
            break;
          case 'access':
            $log_file = LOGS."\\access\\". date('mdy').".log";
            break;
        } 
  
        if (file_exists($log_file)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename='.basename($log_file));
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          header('Content-Length: '.filesize($log_file));
          ob_clean();
          flush();
          readfile($log_file);
          exit;
        }
      } else {
        
      }

    }
  }
}