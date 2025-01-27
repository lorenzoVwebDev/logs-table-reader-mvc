<?php
class Model {
  use Database;
  
  protected $table = 'third_table';
  protected $limit = 3;
  protected $offset = 0;
  //$data and $data_not are two arrays that will be used to make the query where $data is used for the positive evaluation (ex: id = :id) and $data_not for the negative evaluation (ex: id != :id)
  public function where($data, $data_not = []) {
    //SECOND WAY OF HANDLING THE SELECT QUERY
    //We are now going to create the query by using the method's arguments $data an $data_not to retrive the conditions of the query 
    //We create two arrays from both the $data and the $data_not; array_keys() creates and array containing the keys of the given array as values
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "select * from $this->table where ";

    foreach ($keys as $key) {
      $query .= $key ." = :". $key ." && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :". $key ." && ";
    } 
    //trim() cuts the string given in its second arguments from the hard left and hard right of the string given in the first argument
    $query = trim($query, " && ");
    //The "limit" clause specifies the number off rows to be returned from a table, The "offset" clause specifies the row that the extraction must start from
    $query .= " limit $this->limit offset $this->offset";

    //echo $query;

    //echo $this->query($query);
    //FIRST WAY OF HANDLING THE QUERY

    //the :id placeholder represents a variable in a query
    //$query = "select * from $this->table where id = :id";
    //in the second parameter of the query() method we have to pass the $data argument that will be used by $check = $stm->execute($data); to convert the placeholder :id in the data specified within the associative array below
    return $this->query($query, $data);
  }
  
  public function first($data) {

  }

  public function insert($data) {

  }

  public function update($id, $data, $id_column = 'id') {

  }

  public function delete($id, $id_column = 'id') {

  }
}