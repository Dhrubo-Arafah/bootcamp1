<?php
include_once '../../libs/Headers.php';
include_once '../../config/Database.php';
include_once '../../models/Post.php';
include_once '../../libs/Result.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$id=(int)isset($_GET['id'])?$_GET['id']:die();

// Instantiate blog post object
$post = new Post($db);

// Blog post query
$result = $post->search($id);

// Get row count
$num = $result->rowCount();

// Check if there is any post
if($num>0) {
    // Post Array
    echo result($result);
}else{
    // No posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}