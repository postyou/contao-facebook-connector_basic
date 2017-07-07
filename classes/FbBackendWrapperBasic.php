<?php

/**
 *
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2016-2018 POSTYOU
 *
 * @package
 * @author  Mario Gienapp
 * @link    http://www.postyou.de
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace postyou;

class FbBackendWrapperBasic
{
    public function getPosts()
    {
        if (! \FbConnectorHelper::isFacebookSitesSession()) {
            $_SESSION['tl_facebook_sites'] = array();
        }

        $_SESSION['tl_facebook_sites']['savedPosts'] = array();
        $_SESSION['tl_facebook_sites']['savedPostsCount'] = 0;
        $id = \Input::get('id');
        $fbConnector = \FbConnector::getInstance(
            array(
                'connectionType' => ConnectionType::POST_GET
            ));
        $fbConnector->getPostsFromSiteIdAndSaveInDb($id);
        $url = \Controller::addToUrl('&reportTypePost=true&directionGet=true', true,
            array(
                'key',
                'directionPublish',
                'reportTypeEvent',
                'reportTypeGallery'
            ));

        echo html_entity_decode($url);
        exit();
    }
}
