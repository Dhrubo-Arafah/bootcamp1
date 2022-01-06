<?php
include_once '../../libs/Headers.php';
include_once '../../config/Database.php';
include_once '../../models/Post.php';
include_once '../../libs/Result.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Blog post query
$data = json_decode(file_get_contents("php://input"));

var_dump($data);

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Create Post
if ($post->create()) {
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode(
        array('message' => 'Post was not created')
    );
}