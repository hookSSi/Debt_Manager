<?php
class DB_Manager{

  private $db_host; // DB 주소
  private $db_user; // DB 관리자 아이디
  private $db_password; // DB 관리자 비밀번호
  private $db_dbname; // DB 이름
  public $pdo; // PDO 클래스

  // 생성자
  function __construct($isFile = true, $db_host = '127.0.0.1', $db_user = 'root', $db_password = '123123', $db_dbname = 'test')
  {
    $settingfile = "localhost\Debt_Manager\setting.dat";

    if(file_exists($settingfile) && $isFile)
    {
      $fp = fopen($settingfile, 'r');
      $buffer = fread($fp, filesize($settingfile));
      fclose($fp);
      $setting = ['host', 'user', 'password', 'dbname'];
      $list = strtok($buffer, ';');

      for($i = 0; $i < count($setting); $i++)
      {
        $param = explode('=',$list);

        $setting[$i] = ltrim($param[1]);

        $list = strtok(';');
      }

      $this->db_host = $setting[0];
      $this->db_user = $setting[1];
      $this->db_password = $setting[2];
      $this->db_dbname = $setting[3];
    }
    else
    {
      $this->db_host = $db_host;
      $this->db_user = $db_user;
      $this->db_password = $db_password;
      $this->db_dbname = $db_dbname;
    }

    $this->pdo = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_dbname.';charset=utf8', $this->db_user, $this->db_password);

    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  // 퀴리 실행 함수
  function execQuery($query)
  {
    try{
      $sql = $query;

      $this->pdo->exec($sql);

      echo "success";
      return true;
    }
    catch(Exception $e){
      echo $e->getMessage();
      return false;
    }
  }

  function execQueryfile($filename, $token = '')
  {
    try{
      $fp = fopen($filename,"r");
      $queryList = fread($fp, filesize($filename));
      fclose($fp);

      $query = strtok($queryList, $token);

      while($query)
      {
        // MySQL 테이블 생성
        $sql = $query;

        $this->pdo->exec($sql);

        $query = strtok($token);
      }

      echo "success";
      return true;
    }
    catch(Exception $e){
      echo $e->getMessage();
      return false;
    }
  }
}
?>
