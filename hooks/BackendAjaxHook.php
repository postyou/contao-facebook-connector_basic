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

class BackendAjaxHook extends \Backend
{

    protected function loadData($connectionType, $functionName) {
        try {
            $id = \Input::get('id');
            $fbConnector = \FbConnector::getInstance(
                array(
                    'connectionType' => $connectionType
                ));

            $fbConnector->$functionName($id);

        } catch (\Throwable $e) {
            \System::loadLanguagefile('tl_facebook_sites');
            http_response_code(500);
            echo json_encode(array('exception' => $e->getMessage(), 'title' => $GLOBALS['TL_LANG']['tl_facebook_sites']['authenticationExceptionTitle']));
            exit();
        } catch (\Exception $e) {
            \System::loadLanguagefile('tl_facebook_sites');
            http_response_code(500);
            echo json_encode(array('exception' => $e->getMessage(), 'title' => $GLOBALS['TL_LANG']['tl_facebook_sites']['authenticationExceptionTitle']));
            exit();
        } catch (\Error $e) {
            \System::loadLanguagefile('tl_facebook_sites');
            http_response_code(500);
            echo json_encode(array('exception' => $e->getMessage(), 'title' => $GLOBALS['TL_LANG']['tl_facebook_sites']['authenticationExceptionTitle']));
            exit();
        }
    }


    public function executePreActions($strAction)
    {
        switch ($strAction) {
            case 'loadPosts':

                $session = \Session::getInstance();

                if (! \FbConnectorHelper::isFacebookSitesSession()) {
                    $session->set('tl_facebook_sites', array());
                }

                $sites = $session->get('tl_facebook_sites');
                $sites['savedPosts'] = array();
                $sites['savedPostsCount'] = 0;
                $session->set('tl_facebook_sites', $sites);

                $this->loadData(ConnectionType::POST_GET, "getPostsFromSiteIdAndSaveInDb");

                $url = \Controller::addToUrl('&reportTypePost=true&directionGet=true', true,
                    array(
                        'key',
                        'directionPublish',
                        'reportTypeEvent',
                        'reportTypeGallery'
                    ));

                 echo json_encode('/'.html_entity_decode($url));
                 exit();

                break;

            default:
                break;
        }
    }
}
