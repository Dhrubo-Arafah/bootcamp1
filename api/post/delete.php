<?php

include_once '../../libs/Headers.php';
include_once '../../config/Database.php';
include_once '../../models/Post.php';
include_once '../../libs/Result.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$id = (int)isset($_GET['id']) ? $_GET['id'] : die();

// Instantiate blog post object
$post = new Post($db);

// Blog post delete
$result = $post->delete($id);
