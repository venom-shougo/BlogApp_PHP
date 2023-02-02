<?php

namespace Blog\Database;

class Database
{
    protected $tableName;

    // function __construct($tableNmae)
    // {
    //     $this->tableNmae = $tableNmae;
    // }

    /**
     * データベース接続
     * @return object
     */
    protected function dbConnect(): object
    {
        try {
            $pdo = new \PDO(
                DSN,
                DB_USER,
                DB_PASS,
                [
                    \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (\PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit();
        }
        return $pdo;
    }

    /**
     * DBからブログ記事取得
     * @return array
     */
    public function getAll(): array
    {
        try {
            $sql = "SELECT * FROM $this->tableName ORDER BY id DESC";
            $pdo = $this->dbConnect();
            $stmt = $pdo->query($sql);
            $result = $stmt->fetchAll();
        } catch (\PDOException $e) {
            exit($e);
        }
        return $result;
    }

    /**
     * ブログ詳細を取得
     * @param integer $id
     * @return array
     */
    public function getById(int $id):array
    {
        try {
            $pdo = $this->dbConnect();
            $stmt = $pdo->prepare("SELECT * FROM $this->tableName WHERE id = :id");
            $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);
            $stmt->execute();
            $blog = $stmt->fetch();
            if (!$blog) {
                exit('ブログがありません');
            }
        } catch (\PDOException $e) {
            exit($e);
        }
        return $blog;
    }

    public function Delete(int $id):void
    {
        try {
            $pdo = $this->dbConnect();
            $stmt = $pdo->prepare("DELETE FROM $this->tableName WHERE id = :id");
            $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);
            $stmt->execute();
            $stmt->fetch();
            echo REGISTRATION_RESULUT_COMMENT['削除'];
        } catch (\PDOException $e) {
            exit($e);
        }
    }
}

?>
