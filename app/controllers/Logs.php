<?php
class Logs extends Controller {
  private $error_message = 'hello';

  function exception() {
    try {
      if (isset($_POST['exception-name']) && isset($_POST['type'])) {
        $message = filter_var($_POST['exception-name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type = $_POST['type'];
        $model = new Model();
        $last_log_message = $model->logEvent($message, $type);
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
        http_response_code(401);
        header('Content-Type: text/plain');
        echo 'Bad request: No message has been submitted';
        throw new Exception('exception-name POST variable is empty');
      }
      } catch (Exception $e) {
        require_once(__DIR__ ."/../models/logs.model.php");
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
        $model = new Model();
        $last_log_message = $model->logEvent($message, $type);
        if (isset($last_log_message) && $last_log_message === $message) {
          $response['status'] = 'completed';
          $response['logType'] = $type;
          $response['log'] = $last_log_message;
          http_response_code(200);
          header('Content-Type: application/json');
          echo json_encode($response);
          unset($model);
        } else {
          throw new Exception($last_log_message[1], $last_log_message[0]);
        }
      } else {
        http_response_code(401);
        header('Content-Type: text/plain');
        echo 'Bad request: No message has been submitted';
        throw new Exception('error-name POST variable is empty');
      }
    } catch (Exception $e) {
      require_once(__DIR__ ."/../models/logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $last_log_message = $exception->logException();
      unset($exception);
      if ($exceptionCode === 500) {
        http_response_code(500);
        header("Content-Type: text/plain");
        echo "Error 500: We are sorry, we are going to resolve the issue as soon as possible";
      }
    }
  }

  function access() {
    try {
      if (isset($_POST['access-name'])&&isset($_POST['type'])) {
        $message = filter_var($_POST['access-name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type = $_POST['type'];
        $model = new Model();
        $last_log_message = $model->logEvent($message, $type);
        if (isset($last_log_message)&&$last_log_message === $message) {
          $response['status'] = 'completed';
          $response['logType'] = $type;
          $response['log'] = $last_log_message;
          http_response_code(200);
          header('Content-Type: application/json');
          echo json_encode($response);
          unset($model);
        }
      } else {
        http_response_code(401);
        header('Content-Type: text/plain');
        echo 'Bad request: No message has been submitted';
        throw new Exception('access-name POST variable is empty');
      }

    } catch (Exception $e) {
      require_once(__DIR__ ."/../models/logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $last_log_message = $exception->logException();
      unset($exception);
    }
  }

  function table() {
    try {
      if (isset($_GET['type'])) {
        $type = $_GET['type'];
        $model = new Model();
        $event_array = $model->logsArray($type);
        if ($event_array === "log file not found" && $event_array === 'logs_array.model.php not found') {
          throw new Exception($event_array, 500);
        } else {
          if (file_exists(__DIR__."/../views/table.view.php")) {
            require(__DIR__."/../views/table.view.php");
            $tableInstance = new Table_view($event_array, $type);
            $table = $tableInstance->createTable();
            if ($table != strip_tags($table)) {
              http_response_code(200);
              header("Content-Type: text/html");
              echo $table;
            } else {
              throw new Exception("Table not created", 500);
            }
          } else {
            throw new Exception('table.view.php not found', 500);
          }
        }
      }
    } catch (Exception $e) {
      require_once(__DIR__ ."/../models/logs.model.php");
      $exception = new Logs_model($e->getMessage(), 'exception');
      $last_log_message = $exception->logException();
      unset($exception);
      $exceptionCode = $e->getCode();
      if ($exceptionCode === 500) {
        http_response_code(500);
        header("Content-Type: text/plain");
        echo "Error 500: We are sorry, we are going to resolve the issue as soon as possible";
      }
    }
      

  }
}