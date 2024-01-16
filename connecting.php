
<?php

require_once("db.php");

class Connect extends db{

    public function getPost($post_id = null, $search = null, $limit= null, $cat_id = null){
        $sql = "SELECT posts.*, categories.category_name as category FROM posts, categories WHERE posts.category_id = categories.id";
        
        if($post_id != null){
        $sql .= " AND posts.id = $post_id";
        }

        if($cat_id != null){
            $sql .= " AND posts.category_id = $cat_id";
            }

        if($search != null){
            $sql .= " AND posts.title LIKE '%$search%' OR posts.description LIKE '%$search%'";
        }

        $sql .= " ORDER BY created_at DESC";

        if($limit != null){
        $sql .= " LIMIT $limit";
        }
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function getCategory(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTags(){
        $sql = "SELECT * FROM tags";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function setComment($post_id, $name, $message){
        $name = $this->cleancode($name);
        $message = $this->cleancode($message);
        $sql = "INSERT INTO comments(post_id, comment_name, comment_message) VALUE($post_id, $name, $message)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function getComment(){
        $sql = "SELECT * FROM comments ORDER BY created_at DESC LIMIT 3";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function commentCode(){
        $sql = "SELECT count(*) as total FROM comments";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        return $result;
    }

    public function getAbout(){
        $sql = "SELECT posts.post_photo, posts.title, posts.description, categories.category_name as category FROM posts, categories WHERE posts.post_id = categories.id ORDER BY created_at DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function cleancode($code){
        if(!empty($code)){
            return strip_tags($this->connect()->quote(trim($code)));
        }
    }
}