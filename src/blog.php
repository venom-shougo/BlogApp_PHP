<?php

namespace Blog\blog;
use Blog\Database\Database;
require_once('env.php');
require_once('constant.php');
class Blog extends Database
{
    /**
     * ブログ登録
     * @param array $blogCreate
     * @return bool|string
     */
    protected $tableName = 'blog';
    public function blogCreate(array $blogCreate):bool|string
    {
        $result = false;
        $sql = "INSERT INTO
                    $this->tableName(title, content, category, publish_status)
                VALUES
                    (:title, :content, :category, :publish_status)";
        $pdo = $this->dbConnect();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':title', (string)$blogCreate['title'], \PDO::PARAM_STR);
            $stmt->bindValue(':content', (string)$blogCreate['content'], \PDO::PARAM_STR);
            $stmt->bindValue(':category', (string)$blogCreate['category'], \PDO::PARAM_INT);
            $stmt->bindValue(':publish_status', (string)$blogCreate['publish_status'], \PDO::PARAM_INT);
            $stmt->execute();
            $pdo->commit();
            return REGISTRATION_RESULUT_COMMENT['登録'];
        } catch(\PDOException $e) {
            $pdo->rollback();
            $e->getMessage();
            return $result;
        }
    }

    public function blogUpdate(array $blogUpdate):bool|string
    {
        $result = false;
        $sql = "UPDATE $this->tableName SET
                    title = :title, content = :content, category = :category, publish_status = :publish_status
                WHERE
                    id = :id";
        $pdo = $this->dbConnect();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':title', (string)$blogUpdate['title'], \PDO::PARAM_STR);
            $stmt->bindValue(':content', (string)$blogUpdate['content'], \PDO::PARAM_STR);
            $stmt->bindValue(':category', (string)$blogUpdate['category'], \PDO::PARAM_INT);
            $stmt->bindValue(':publish_status', (string)$blogUpdate['publish_status'], \PDO::PARAM_INT);
            $stmt->bindValue(':id', (string)$blogUpdate['id'], \PDO::PARAM_INT);
            $stmt->execute();
            $pdo->commit();
            return REGISTRATION_RESULUT_COMMENT['変更'];
        } catch(\PDOException $e) {
            $pdo->rollback();
            $e->getMessage();
            return $result;
        }
    }

    /**
     * カテゴリ番号から判別
     * @param int $category
     * @return string
     */
    public function setCategoryName(int $category): string
    {
        if ($category === IDENTIFY_BLOG_CATEGORY) {
            return 'ブログ';
        } elseif ($category === IDENTIFY_DAILY_CATEGORY) {
            return 'プログラミング';
        } else {
            return 'その他';
        }
    }

    /**
     * バリデーションForm
     * @param array $blogValidate
     * @return void
     */
    public function ValidateForm(array $blogValidate):void
    {
        if (empty($blogValidate['title'])) {
            exit('タイトルを入力してください');
        }
        if (mb_strlen($blogValidate['title']) > MAX_TITLE_RANGE) {
            exit('タイトルの文字数制限を超えてます');
        }
        if (empty($blogValidate['content'])) {
            exit('本文を入力してください');
        }
        if ($blogValidate['category'] === '0') {
            exit('カテゴリを選択してください');
        }
        if (empty($blogValidate['publish_status'])) {
            exit('公開、非公開を選択してください');
        }
    }

    /**
   * XSS対策：エスケープ処理
   * @param string $str
   * @return string
   */
    public static function h($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
