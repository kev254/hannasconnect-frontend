<?php

class Comments
{
private mysqli $conn;
private string $host="localhost";
private string $userName="hannasconnectco_kevin";
private string $password="8829@Noma";
private string $database="hannasconnectco_main_db";

public function __construct()
{
    $this->conn=new mysqli($this->host,$this->userName,$this->password,$this->database);
    $this->createTable();
}

    private function createTable()
    {
        $sql="CREATE TABLE IF NOT EXISTS Comments (Id INT(14) NOT NULL  AUTO_INCREMENT PRIMARY KEY ,blogId BIGINT NOT NULL ,userId BIGINT NOT NULL ,comments LONGTEXT NOT NULL, createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
        $this->conn->query($sql) or die($this->conn->error);

        $sql="CREATE TABLE IF NOT EXISTS Replies (Id INT(14) NOT NULL  AUTO_INCREMENT PRIMARY KEY ,blogId BIGINT NOT NULL ,userId BIGINT NOT NULL ,commentId BIGINT NOT NULL ,replies LONGTEXT NOT NULL, createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
        $this->conn->query($sql) or die($this->conn->error);
    }

    public function addComment(int $blogId,int $userId,string $comments)
    {
        $sql="INSERT INTO Comments(blogId, userId, comments) VALUES (?,?,?)";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("iis",$blogId,$userId,$comments);
        $stmt->execute();
        $stmt->close();

        $sql="UPDATE Blog_Posts SET commentsCount=(commentsCount+1) WHERE Id=?";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("i",$blogId);
        $stmt->execute();
        $stmt->close();

    }
    public function addReply(int $blogId,int $userId,int $commentId,string $comments)
    {
        $sql="INSERT INTO Replies(blogId, userId,commentId, replies) VALUES (?,?,?,?)";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("iiis",$blogId,$userId,$commentId,$comments);
        $stmt->execute();
        $stmt->close();

    }


}

if (!empty($_POST["mode"]) && $_POST["mode"]=="comments"){
    $userId=$_POST["userId"];
    $comments=$_POST["comments"];
    $blogId=$_POST["blogId"];

    $comm=new Comments();
    $comm->addComment($blogId,$userId,$comments);
    header("Location:https://hannasconnect.co.ke/post.php?blog=".$blogId);
}

if (!empty($_POST["mode"]) && $_POST["mode"]=="reply"){
    $userId=$_POST["userId"];
    $comments=$_POST["comments"];
    $blogId=$_POST["blogId"];
    $commentId=$_POST["commentId"];

    $comm=new Comments();
    $comm->addReply($blogId,$userId,$commentId,$comments);
    header("Location:https://hannasconnect.co.ke/post.php?blog=".$blogId);
}