<?php
//echo DB_NAME;
// require_once APPROOT . '../config/config.php';
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    // private $no = NO;

    private $pdo;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false // For General Error
        );

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            // print_r($this->pdo);
            // echo "Success";
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // public function create($table, $data)
    // {
    //     try {
    //         $column = array_keys($data);
    //         $columnSql = implode(', ', $column);
    //         $bindingSql = ':' . implode(',:', $column);
    //         $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
    //         $stm = $this->pdo->prepare($sql);
    //         foreach ($data as $key => $value) {
    //             $stm->bindValue(':' . $key, $value);
    //         }
    //         $status = $stm->execute();
    //         if (!$status) {
    //             $errorInfo = $stm->errorInfo();
    //             throw new PDOException($errorInfo[2], $errorInfo[1]);
    //         }
    //         return $this->pdo->lastInsertId();
    //     } catch (PDOException $e) {
    //         // log the error or display a user-friendly message
    //         // echo $e->getMessage();
    //         // exit;
    //         throw new PDOException('Error inserting data into table: ' . $e->getMessage(), $e->getCode(), $e);
    //     }
    // }


    public function create($table, $data)
    {
        try {
            // print_r($data);
            // exit;
            $column = array_keys($data);
            // print_r($column);
            // exit;
            $columnSql = implode(', ', $column);
            $bindingSql = ':' . implode(',:', $column);
            // echo $bindingSql;
            $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
            // print_r($sql);
            // exit;
            $stm = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }
            // print_r($stm);
            $status = $stm->execute();
            // echo $status;
            return ($status) ? $this->pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // public function create($table, $data)
    // {
    //     try {
    //         $column = array_keys($data);
    //         $columnSql = implode(', ', $column);
    //         $bindingSql = ':' . implode(',:', $column);
    //         // echo $bindingSql;
    //             // $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
    //         $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
    //         $stm = $this->pdo->prepare($sql);
    //         foreach ($data as $key => $value) {
    //             $stm->bindValue(':' . $key, $value);
    //         }
    //         // print_r($stm);
    //         for($i=0;$i < 1000; $i++){
    //             $status = $stm->execute();
    //         }
    //         return ($status) ? $this->pdo->lastInsertId() : false;

    //         // $query = "INSERT INTO isec_test(sms_id,status,msgid) values ('1','OK','123-123')";
    //         // $query = mysql_query($sql);
    //         //echo $sql;

    //         // echo $status;
    //     } catch (PODException $e) {
    //         echo $e;
    //     }
    // }

    // Update Query
    public function update($table, $id, $data)
    {
        // First, we don't want id from category table
        if (isset($data['id'])) {
            unset($data['id']);
        }

        try {
            $columns = array_keys($data);
            function map($item)
            {
                return $item . '=:' . $item;
            }
            $columns = array_map('map', $columns);
            $bindingSql = implode(',', $columns);
            // echo $bindingSql;
            // exit;
            $sql = 'UPDATE ' .  $table . ' SET ' . $bindingSql . ' WHERE `id` =:id';
            $stm = $this->pdo->prepare($sql);

            // Now, we assign id to bind
            $data['id'] = $id;

            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }
            $status = $stm->execute();
            // print_r($status);
            return $status;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function delete($table, $id)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE `id` = :id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        return ($success);
    }

    public function columnFilter($table, $column, $value)
    {
        // $sql = 'SELECT * FROM ' . $table . ' WHERE `' . $column . '` = :value';
        $sql = 'SELECT * FROM ' . $table . ' WHERE `' . str_replace('`', '', $column) . '` = :value';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value', $value);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function loginCheck($email, $password)
    {
        // echo $email, $password;
        // die();
        $sql = 'SELECT * FROM users WHERE `email` = :email AND `password` = :password';
        // echo $sql;
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':password', $password);
        $success = $stm->execute();
        // echo $success;
        // die();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        // print_r('hello');
        // die();
        return ($success) ? $row : [];
    }

    public function setLogin($id)
    {
        $sql = 'UPDATE users SET `is_login` = :value WHERE `id` = :id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value', 1);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $stm->closeCursor();    // to solve PHP Unbuffered Queries
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function unsetLogin($id)
    {
        try {
            $sql        = "UPDATE users SET is_login = :false WHERE id = :id";
            $stm        = $this->pdo->prepare($sql);
            $stm->bindValue(':false', '0');
            $stm->bindValue(':id', $id);
            $success = $stm->execute();
            $row     = $stm->fetch(PDO::FETCH_ASSOC);
            return ($success) ? $row : [];
        } catch (Exception $e) {
            echo ($e);
        }
    }

    public function readAll($table)
    {
        $sql = 'SELECT * FROM ' . $table;
        // print_r($sql);
        $stm = $this->pdo->prepare($sql);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        // print_r($row);
        // exit;
        return ($success) ? $row : [];
    }

    // public function categoryView()
    // {
    //     $sql = 'SELECT * FROM vw_categories_type';
    //     $sql = 'SELECT categories.id, categories.name, categories.description, types.name AS type_name FROM categories LEFT JOIN types ON categories.type_id = types.id';
    //     $stm = $this->pdo->prepare($sql);
    //     $success = $stm->execute();
    //     $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    //     return ($success) ? $row : [];
    // }



    public function getById($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `id` =:id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByUserAddress($table, $address)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `user_address` =:id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $address);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByIdViewTable($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `delivery_ID` =:id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getViewByID($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `order_ID` =:id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getViewByDeliveryID($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `deliveryPrice_ID` =:id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByIdAll($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `user_ID` =:id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getBySessionEmail($table, $email)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `email` =:email';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':email', $email);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getBySessionEmailAll($table, $email)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `email` =:email';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':email', $email);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByEmail($table, $email)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `email` =:email';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':email', $email);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        // print_r($row);
        // exit;
        return ($success) ? $row : [];
    }

    public function getByAddressId($table, $key, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $key . ' =:' . $key;
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':' . $key, $id);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByAddress($table, $key, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $key . ' =:' . $key;
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':' . $key, $id);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByCompanyName($table, $key, $companyName)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $key . ' =:' . $key;
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':' . $key, $companyName);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }


    public function getPriceByAddressNameAndCompanyName($table, $key1, $value1, $key2, $value2)
    {
        // echo $value1;
        // echo $value2;
        // exit;

        $sql = "SELECT * FROM $table WHERE $key1 = :value1 AND $key2 = :value2";
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value1', $value1);
        $stm->bindValue(':value2', $value2);
        $success = $stm->execute();
        // print_r($success);
        // exit;
        $rows = $stm->fetch(PDO::FETCH_ASSOC);
        // print_r($rows);
        // exit;

        return ($success) ? $rows : [];
    }


    public function getByAddressName($table, $key, $addressname)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $key . ' =:' . $key;
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':' . $key, $addressname);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getAddressId($table, $street_id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE  street_id =:street_id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':street_id', $street_id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return $success ? $row : [];
    }

    public function getAddressByUserId($table, $userid)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE  user_id =:user_id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':user_id', $userid);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return $success ? $row : [];
    }

    public function getAddressByUserIdAll($table, $userid)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE  user_id =:user_id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':user_id', $userid);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $success ? $row : [];
    }


    public function getByCategoryId($table, $column)
    {
        $stm = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE name =:column');
        $stm->bindValue(':column', $column);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        //  print_r($row);
        return ($success) ? $row : [];
    }

    // For Dashboard
    public function incomeTransition()
    {
        try {

            $sql        = "SELECT *,SUM(amount) AS amount FROM incomes WHERE
           (date = { fn CURDATE() }) ";
            $stm = $this->pdo->prepare($sql);
            $success = $stm->execute();

            $row     = $stm->fetch(PDO::FETCH_ASSOC);
            return ($success) ? $row : [];
        } catch (Exception $e) {
            echo ($e);
        }
    }

    public function expenseTransition()
    {
        try {

            $sql        = "SELECT * ,SUM(amount*qty) AS amount FROM expenses WHERE
           (date = { fn CURDATE() }) ";
            $stm = $this->pdo->prepare($sql);
            $success = $stm->execute();

            $row     = $stm->fetch(PDO::FETCH_ASSOC);
            return ($success) ? $row : [];
        } catch (Exception $e) {
            echo ($e);
        }
    }
}
