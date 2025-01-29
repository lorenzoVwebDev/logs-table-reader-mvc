<?php
class Logs extends Controller {
  private $error_message = 'hello';

  function exception() {
    try {
      if (isset($_POST['exception-name']) && isset($_POST['type'])) {
        $message = filter_var($_POST['exception-name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type = $_POST['type'];
        $model = new Model($message, $type);
        $last_log_message = $model->logException();
        if (isset($last_log_message) && $last_log_message === $message) {
          $response['status'] = 'completed';
          $response['logType'] = $type;
          $response['log'] = $last_log_message;
          http_response_code(200);
          header('Content-Type: application/json');
          echo json_encode($response);
          unset($model);
        }
      } else {
        http_response_status(401);
        header('Content-Type: text/plain');
        echo 'Bad request: No message has been submitted';
        throw new Exception('exception-name POST variable is empty');
      }
      } catch (Exception $e) {
        require_once(__DIR__ ."\\..\\models\\logs.model.php");
        $exception = new Logs_model($e->getMessage(), 'exception');
        $last_log_message = $exception->logException();
        unset($exception);
      }
    } 

  function error() {
    try {
      if (isset($_POST['error-name']) && isset($_POST['type'])) {
        $message = filter_var($_POST['error-name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type = $_POST['type'];
        $model = new Model($message, $type);
        $last_log_message = $model->logError();
        if (isset($last_log_message) && $last_log_message === $message) {
          $response['status'] = 'completed';
          $response['logType'] = $type;
          $response['log'] = $last_log_message;
          http_response_code(200);
          header('Content-Type: application/json');
          echo json_encode($response);
          unset($model);
        }
      } else {
        http_response_status(401);
        header('Content-Type: text/plain');
        echo 'Bad request: No message has been submitted';
        throw new Exception('error-name POST variable is empty');
      }
    } catch (Exception $e) {
      require_once(__DIR__ ."\\..\\models\\logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $last_log_message = $exception->logException();
      unset($exception);
    }
  }
}