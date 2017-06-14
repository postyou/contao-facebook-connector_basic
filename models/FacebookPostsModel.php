<?php

namespace postyou;

class FacebookPostsModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_facebook_posts';


    public static function findByPostId($postId)
    {
        return self::findBy('postId', $postId);
    }

    public static function findByPid($pid)
    {
        return self::findBy('pid', $pid);
    }

    public function getFolderPath()
    {
        return \Config::get('uploadPath') . '/facebook/posts/' . $this->postId;
    }

    public function addSpecificData(array $arrData)
    {
        foreach ($arrData as $key => $value) {
            switch ($key) {
                  case 'title':
                          $this->title = $value;
                          break;
                  case 'message':
                          $this->postMessage = $value;
                          break;
                  case 'icon':
                          $this->icon = $value;
                          break;
                  case 'facebookPostType':
                          $this->facebookPostType = $value;
                          break;
                  case 'dateCreated':
                          $this->created_time = $value;
                          break;
                  case 'dateUpdated':
                          $this->updated_time = $value;
                          break;
                  case 'multiSRC':
                          $this->multiSRC = $value;
                          break;
                  case 'orderSRC':
                            $this->orderSRC = $value;
                            break;
                        }
        }
    }
}
