<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
   //'suffix' => '.html'
         ],
    ],

    'modules' => [
    'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => true,
        'admins' => ['kcusaac'],
        // you will configure your module inside this file
        // or if need different configuration for frontend and backend you may
        // configure in needed configs
    ],


    'gridview' =>  [
    'class' => '\kartik\grid\Module'
    // enter optional module parameters below - only if you need to
    // use your own export download action or custom translation
    // message source
    // 'downloadAction' => 'gridview/export/download',
    // 'i18n' => []
],
    'datecontrol' =>  [
   'class' => '\kartik\datecontrol\Module'
],
    'rbac' =>[
        'class' => 'dektrium\rbac\RbacWebModule',
    ],
],




];
