<?php
class database
{
  private $db_host = "localhost";
  private $db_user = "root";
  private $db_pass = "";
  private $db_nm = "test";
  private $conn = false;
  private $mysqli = "";
  private $result = array();

  public function __construct()
  {
    if (!$this->conn) {
      $this->conn = true;
      $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_nm);
      if ($this->mysqli->connect_error) {
        array_push($this->result, $this->mysqli->connect_error);
        
      }
    } 
  }
  public function insert($table, $param = array())
  {
    if ($this->tableExist($table)) {
      $columns = implode(', ', array_keys($param));
      $ans = implode("', '", $param);
      $sql = "insert into $table ($columns) values('$ans') ";
      if ($this->mysqli->query($sql)) {
        array_push($this->result, $this->mysqli->insert_id);
        return true;
      } else {
        array_push($this->result, $this->mysqli->error);
        return false;
      }
    }
  }
  public function update($table, $param = array(), $uid)
  {
    if ($this->tableExist($table)) {
      $args = array();
      foreach ($param as $key => $value) {
        $args[] = "$key = '$value'";
      }
      
      $sql = "UPDATE `$table` SET " . implode(', ', $args) . " WHERE id ='$uid'";
      if ($this->mysqli->query($sql)) {
        $this->mysqli->affected_rows;
      } else {
        $this->mysqli->error;
      }
  
    }
  }
  public function delete($table, $uid)
  {
    if ($this->tableExist($table)) {
      $sql = "DELETE FROM `$table` WHERE id='$uid'";
      if ($this->mysqli->query($sql)) {
        array_push($this->result, $this->mysqli->insert_id);
        return true;
      } else {
        array_push($this->result, $this->mysqli->error);
        return false;
      }
    }
  }
  public function select($table,$rows="*",$join="null",$where="null",$order="null",$limit="null"){
    if ($this->tableExist($table)) {
       $sql = "SELECT $rows FROM  $table";
       if($join !=null){
        $sql .=" JOIN $join";
       }
       if($where !=null){
        $sql .=" WHERE $where";
       }
       if($order !=null){
        $sql .=" ORDER BY $order";
       }
       if($limit !=null){
        if (isset($_GET['page'])) {
          $page = $_GET['page']; 
        }else{
          $page= 1;
        }
        $start = ($page -1) * $limit;
        $sql .= " LIMIT $start,$limit";
       }
      //  echo $sql;
       $query = $this->mysqli->query($sql);
        if($query){
          $this->result =$query->fetch_all(MYSQLI_ASSOC);
          return true;
        }else{
          array_push($this->result,$this->mysqli->error);
          return false;
        }
    }
  }
  public function pagination($table,$join,$where,$limit) {
      if ($this->tableExist($table)) {
          if ($limit != null) {
            $sql ="SELECT COUNT(*) FROM  $table";
            if($join !=null){
              $sql .=" JOIN $join";
             }
            if($where !=null){
              $sql .=" WHERE $where";
             }

              $query = $this->mysqli->query($sql);
              $total_record = $query->fetch_array();
                 $total_record = $total_record[0];
                 $total_pages = ceil($total_record /$limit);
                 $url =basename($_SERVER['PHP_SELF']);
                 if (isset($_GET['page'])) {
                  $page = $_GET['page']; 
                }else{
                  $page= 1;
                }
                $output = "<ul class='pagination'>";
                if ($page>1) {
                  $output.="<li><a href='$url?page=".($page-1)."'>prev</a></li>";
                }
                if ($total_record>$limit) {
                  for ($i=1; $i<=$total_pages; $i++) { 
                    if ($i==$page) {
                     $cls="class='active'";
                    }else{
                      $cls="";
                    }
                    $output.="<li><a $cls href='$url?page=$i'>$i</a></li>";
                  }
                } 
                if ($total_pages>$page) {
                  $output.="<li><a href='$url?page=".($page+1)."'>next</a></li>";
                }
                $output.="</ul>";
                echo $output;

          }else{
            return false;
          }
      }else{
        return false;
      }
      }
  public function sql($sql){
    $query = $this->mysqli->query($sql);
    if ($query) {
     $this->result =$query->fetch_all(MYSQLI_ASSOC);
     return true;
    }else{
      array_push($this->result,$this->mysqli->error);
      return false;
    }
  }
  private function tableExist($table)
  {
    $sql = "SHOW TABLES FROM $this->db_nm  LIKE '$table'";
    $tableInDb = $this->mysqli->query($sql);
    if ($tableInDb) {
      if ($tableInDb->num_rows == 1) {
        return true;
      } else {
        echo "record not found";
        return false;
      }
    }
  }
  public function getResult()
  {
    $val = $this->result;
    $this->result = array();
    return $val;
  }
  public function __destruct()
  {
    if ($this->conn) {
      if ($this->mysqli->close()) {
        $this->conn = false;
        //  return true;
      }
    } else {
      //  return false;
    }
  }
}
