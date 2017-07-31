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
    public function executePreActions($strAction)
    {
        switch ($strAction) {
            case 'loadPosts':
                if (! \FbConnectorHelper::isFacebookSitesSession()) {
                    $_SESSION['tl_facebook_sites'] = array();
                }

                $_SESSION['tl_facebook_sites']['savedPosts'] = array();
                $_SESSION['tl_facebook_sites']['savedPostsCount'] = 0;
                $id = \Input::get('id');
                try {
                    $fbConnector = \FbConnector::getInstance(
                        array(
                            'connectionType' => ConnectionType::POST_GET
                        ));

                    $fbConnector->getPostsFromSiteIdAndSaveInDb($id);
                } catch (\Throwable $e) {
                    \System::loadLanguagefile('tl_facebook_sites');
                    http_response_code(500);
                    echo json_encode(array('exception' => $e->getMessage(), 'title' => $GLOBALS['TL_LANG']['tl_facebook_sites']['authenticationExceptionTitle']));
                    exit();
                    break;
                } catch (\Exception $e) {
                    \System::loadLanguagefile('tl_facebook_sites');
                    http_response_code(500);
                    echo json_encode(array('exception' => $e->getMessage(), 'title' => $GLOBALS['TL_LANG']['tl_facebook_sites']['authenticationExceptionTitle']));
                    exit();
                    break;
                } catch (\Error $e) {
                    \System::loadLanguagefile('tl_facebook_sites');
                    http_response_code(500);
                    echo json_encode(array('exception' => $e->getMessage(), 'title' => $GLOBALS['TL_LANG']['tl_facebook_sites']['authenticationExceptionTitle']));
                    exit();
                    break;
                }

                $url = \Controller::addToUrl('&reportTypePost=true&directionGet=true', true,
                    array(
                        'key',
                        'directionPublish',
                        'reportTypeEvent',
                        'reportTypeGallery'
                    ));

                 echo json_encode(html_entity_decode($url));
                 exit();

                break;

            default:
                break;
        }
    }
}
