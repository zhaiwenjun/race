<?php
$GLOBALS['cfg_plugin_race_public_url'] = '/' . str_replace('\\', '/', str_replace(BASEPATH, '', dirname(__FILE__))) . '/public/';

define('RACEROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

//路由规则引入
Route::set('race', 'race(/<controller>(/<action>(/<params>)))', array('params' => '.*'))
    ->defaults(array(
        'controller' => 'index',
        'action' => 'index',
        'directory' => 'pc/race'
    ));



