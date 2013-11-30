<?php
var_dump($_SESSION);

$user = $facebookWrapper->getUserData();

if($user)
{
    $fbPhotoFeed = new FbPhotoFeed();
    $fbPhotoFeed->addFeed($facebookWrapper->getUserUploadedPhotos(10));
    $fbPhotoFeed->addFeed($facebookWrapper->getUserPhotos(10));
}