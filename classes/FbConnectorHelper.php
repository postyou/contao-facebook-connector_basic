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

class FbConnectorHelper
{
    public static function isFacebookSitesSession()
    {
        return ! empty($_SESSION['tl_facebook_sites']);
    }

    public static function addRejectedPostMessage($date, $model, $message)
    {
        $_SESSION['tl_facebook_sites']['rejectedPosts'][] = $date->format(
            $GLOBALS['TL_CONFIG']['datimFormat']) . ' ' .
             ((! empty($model->title)) ? $model->title : $model->headline) . ' - Ursache: ' .
             $message;
    }

    public static function addErrorMessage($exception)
    {
        $_SESSION['tl_facebook_sites']['errorMessages'][] = $exception->getCode() . ' ' .
             $exception->getMessage();
    }

    public static function addErrorMessageText($message)
    {
        $_SESSION['tl_facebook_sites']['errorMessages'][] = $message;
    }

    public static function updateSessionValuesForResponse($countName, $textName, $title, $date,
        $wasUpdated)
    {
        $_SESSION['tl_facebook_sites'][$countName] ++;
        $text = $date->format($GLOBALS['TL_CONFIG']['datimFormat']) . ' ' . $title;

        \System::loadLanguageFile('tl_facebook_messages');

        if ($wasUpdated) {
            $_SESSION['tl_facebook_sites'][$textName][] = $text . '<em>' .
                 $GLOBALS['TL_LANG']['tl_facebook_messages']['updated'] . '</em>';
        } else {
            $_SESSION['tl_facebook_sites'][$textName][] = $text . '<em>' .
                 $GLOBALS['TL_LANG']['tl_facebook_messages']['created'] . '</em>';
        }
    }

    public static function autolink($str, $attributes=array())
    {
        $attrs = '';
        foreach ($attributes as $attribute => $value) {
            $attrs .= " {$attribute}=\"{$value}\"";
        }
        $str = ' ' . $str;
        $str = preg_replace(
        '`([^"=\'>])(((http|https|ftp)://|www.)[^\s<]+[^\s<\.)])`i',
        '$1<a href="$2"'.$attrs.'>$2</a>',
        $str
        );
        $str = substr($str, 1);
        $str = preg_replace('`href=\"www`', 'href="http://www', $str);
        // fügt http:// hinzu, wenn nicht vorhanden
        return $str;
    }

    public static function removeHashTag($str)
    {
        return preg_replace('/(^|\s)#(\w+)/', '', $str);
    }
}
