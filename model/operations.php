<?php
/**
 * @return PDO
 * retourne l'objet pdo que l'on nomme connexion
 */
function getConnexion(){
    $connexion = new PDO("mysql:host=localhost;dbname=blog;charset=UTF8",'root','');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $connexion;
}

function encryptPassword($password){
    return md5($password);
}

function setNewUser($username,$password,$email){
    $connexion = getConnexion();
    $password = encryptPassword($password);
    $query = 'INSERT INTO user SET username=:username, password=:password, email=:email';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array('username'=>$username,'password'=>$password,'email'=>$email));
    return $pdo->rowCount();
}

function getUserByUsername($username)
{
    $connexion = getConnexion();
    $query = 'SELECT id,username FROM user WHERE username=:username';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
       'username'=>$username
    ));
    return $pdo->fetch(PDO::FETCH_ASSOC);
}

function getUserByEmail($email){
    $connexion = getConnexion();
    $query = 'SELECT id,username FROM user WHERE email=:email';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
        'email'=>$email
    ));
    return $pdo->fetch(PDO::FETCH_ASSOC);
}

function getUserLogin($username,$password){
    $connexion = getConnexion();
    $password = encryptPassword($password);
    $query = 'SELECT id,username FROM user WHERE username=:username AND password=:password';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
        'username'=>$username,
        'password'=>$password
    ));
    return $pdo->fetch(PDO::FETCH_ASSOC);
}

function setNewPost($posterid,$title,$description,$category){
    $connexion = getConnexion();
    $query = "INSERT INTO post SET poster_id=:id,date_post=NOW(),title=:title,description=:description,category_id=:category";
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
       'id'=>$posterid,
        'title'=>$title,
        'description'=>$description,
        'category'=>$category
    ));
    return $pdo->rowCount();
}

function getAllPosts(){
    $connexion = getConnexion();
    $query = 'SELECT p.id,p.title,p.description,p.date_post,u.id AS user_id,u.username,COUNT(c.id) AS nb_comment
                FROM USER AS u,post AS p 
                LEFT JOIN COMMENT AS c ON c.post_id=p.id
                WHERE u.id=p.poster_id GROUP BY p.id ORDER BY id DESC';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array());
    return $pdo->fetchAll(PDO::FETCH_ASSOC);
}

function getPostByCateg($categorySelected){
    $connexion = getConnexion();
    $query = 'SELECT p.id,p.title,p.description,p.date_post,u.id AS user_id,u.username,COUNT(c.id) AS nb_comment
                FROM USER AS u,post AS p 
                LEFT JOIN COMMENT AS c ON c.post_id=p.id
                WHERE u.id=p.poster_id AND p.category_id=:category GROUP BY p.id ORDER BY id DESC';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
        'category' =>$categorySelected
    ));
    return $pdo->fetchAll(PDO::FETCH_ASSOC);
}

function getPostById($postId){
    $connexion = getConnexion();
    $query = 'SELECT p.id,p.title,p.description,p.date_post,u.id as user_id,u.username,u.email 
              FROM post AS p,user AS u WHERE u.id=p.poster_id AND p.id=:postid ORDER BY id DESC';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
        'postid'=>$postId
    ));
    return $pdo->fetch(PDO::FETCH_ASSOC);
}

function setNewComment($commentatorId,$postId,$comment){
    $connexion = getConnexion();
    $query = 'INSERT INTO comment SET commentator_id=:commentatorId, post_id=:postId, date_com=NOW(),comment=:comment';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
        'commentatorId'=>$commentatorId,
        'postId'=>$postId,
        'comment'=>$comment
    ));
    return $pdo->rowCount();
}

function getAllCommentsByPostId($postId){
    $connexion = getConnexion();
    $query = 'SELECT c.id,c.date_com,c.comment,u.id as user_id,u.username,u.email 
              FROM comment AS c,user AS u
              WHERE u.id=c.commentator_id AND c.post_id=:postId ORDER BY c.id ASC';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array(
        'postId'=>$postId
    ));
    return $pdo->fetchAll(PDO::FETCH_ASSOC);
}

function getCategories(){
    $connexion = getConnexion();
    $query = 'SELECT c.id,c.category_name FROM categories as c';
    $pdo = $connexion->prepare($query);
    $pdo->execute(array());
    return $pdo->fetchAll(PDO::FETCH_ASSOC);
}