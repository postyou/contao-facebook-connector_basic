<?php
$GLOBALS['TL_DCA']['tl_facebook_settings'] = array(
    'config' => array(
        'dataContainer' => 'File'
    ),
    // 'switchToEdit' => true,
    // 'enableVersioning' => true,
    // ,'onload_callback' => array (array('tl_new','onLoad'))
    // ,'ondelete_callback' => array(array("tl_new","onDelete"))
    // ,'onversion_callback' => array(array("tl_new","onVersion"))

    'palettes' => array(
        '__selector__' => array(),
        'default' => 'appID, appSecret;'
    ),
    'subpalettes' => array(),
    'fields' => array(

        'appID' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_facebook_settings']['appID'],
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50'
            )
        ),
        'appSecret' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_facebook_settings']['appSecret'],
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50'
            )
        )
    )
);