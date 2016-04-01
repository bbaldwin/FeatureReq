<!--
@Author: Billy R Baldwin <bbaldwin>
@Date:   03-31-2016
@Email:  billyraybaldwin@gmail.com
@Project: FeatureREQ
@Last modified by:   bbaldwin
@Last modified time: 04-01-2016
-->
<?php
// Include database class
  include 'db.Creds.php';
class DB {

    private $dbh;
    private $stmt;
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
    private $error;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
        return $this;
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function resultset() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    public function single() {
        $this->execute();
        return $this->stmt->fetch();
    }

    public function bind($param, $value, $type = null) {
      if (is_null($type)) {
          switch (true) {
            case is_int($value):
              $type = PDO::PARAM_INT;
              break;
            case is_bool($value):
              $type = PDO::PARAM_BOOL;
              break;
            case is_null($value):
              $type = PDO::PARAM_NULL;
              break;
            default:
              $type = PDO::PARAM_STR;
        }
      }
    $this->stmt->bindValue($param, $value, $type);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

    // Get the last inserted ID from the DB
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    // Transaction options for our processes.
    public function beginTransaction(){
    return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
    return $this->dbh->commit();
    }

    public function cancelTransaction(){
    return $this->dbh->rollBack();
    }

    public function debugDumpParams(){
    return $this->stmt->debugDumpParams();
    }


}



?>
