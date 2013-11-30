<?php

class FbPhotoFeed
{
    private $photoFeed = array();
    
    public function getPhotoFeed()
    {
        if(!empty($this->photoFeed)) return $this->photoFeed;
    }
    
    public function addFeed($feedArray)
    {
        foreach($feedArray['data'] as $photo)
        {
            $this->photoFeed[$photo['id']] = $photo;
        }
    }
    
}