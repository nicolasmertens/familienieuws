<?php
require_once 'facebook/facebook.php';

class FacebookWrapper extends Facebook
{ 
    /**
     * get user data
     * @return array
     */
    public function getUserData() {
        try {
            return $this->api('/me');
        } catch(FacebookApiException $e) {
            return false;
        }
    }
    
    /**
     * get user tagged photos
     * @param $limit max 100
     * @return array 
     */
    public function getUserPhotos($limit = 25) {
        try {
            return $this->api('/me/photos?limit=' . $limit);
        } catch(FacebookApiException $e) {
            return false;
        }
    }
    
    /**
     * get user uploaded photos
     * @param $limit max 100
     * @return array 
     */
    public function getUserUploadedPhotos($limit = 25) {
        try {
            return $this->api('/me/photos/uploaded?limit=' . $limit);
        } catch(FacebookApiException $e) {
            return false;
        }
    }
    
    /**
     * get the info from an App request
     * @param int $id
     * @return array
     */
    public function getRequest($id) {
        try{
            return $this->api('/'.$id);
        }catch(FacebookApiException $e) {
            return false;
        }
    }
    
    /**
     * delete an App request
     * @param int $id
     * @return array
     */
    public function deleteRequest($id) {
        try{
            $this->api(
		    '/'.$id,
		    'DELETE'
	    );
        }catch(FacebookApiException $e){
	    return false;
        }
    }
}