<?php
try 
{
    require __DIR__ . "/Router.php";
    $router = new Router();
///////////////////////////////////////////////////////////////////////////////////////////
    $router->get('/',                           'MainController@mainpage');
    $router->get('/id{i}',                      'MainController@myprofile');
    $router->get('/{u}',                        'MainController@select_episode');
    $router->get('/{u}?t={i?}',                 'MainController@select_episode');
    $router->get('/{u}/s{i}_e{i}',              'MainController@watch_player');
    $router->get('/{u}/s{i}_e{i}?t={i?}',       'MainController@watch_player');
    $router->get('/frame/{i}/{i}/{i}',          'ApiController@frame_player');
    
    $router->get('/editprofile',                'MainController@editprofile');
    $router->get('/privacy',                    'MainController@privacy');
    $router->get('/subscribe',                  'MainController@subscribe');
    $router->get('/support/{u?}',               'MainController@support');
    $router->get('/social/{u?}',                'MainController@social');
    
    $router->get('/get_hash_social/{i}',        'SocialController@get_hash_social');
    $router->get('/cron',                       'SocialController@cron');
    
    $router->get('/authvk',                     'AuthController@AUTH_VK');
    $router->get('/exit',                       'AuthController@out');
    
    //api
    //admin
    $router->get('/api/getfullcontent/{u}/{u}',         'ApiController@getfullcontent'); 
    $router->post('/api/addanmecontent',                'ApiController@addanmecontent'); 
    $router->post('/api/saveanmecontent',               'ApiController@saveanmecontent'); 
    $router->post('/api/delanmecontent',                'ApiController@delanmecontent'); 
    $router->post('/api/addcontent',                    'ApiController@addcontent'); 
    $router->post('/api/addepisode',                    'ApiController@addepisode'); 
    
    $router->post('/api/addgenre',                      'ApiController@addgenre');
    $router->post('/api/delgenre',                      'ApiController@delgenre');
    $router->post('/api/savegenre',                     'ApiController@savegenre');
    
    //main
    $router->get('/api/getgenre/{u}',                   'ApiController@getgenre'); 
    $router->post('/api/getcontent/',                   'ApiController@getcontent');
    $router->get('/api/getepisodes/{u}/{u}/{i}/{u?}/{i?}',   'ApiController@getepisodes'); 
    $router->get('/api/getinfoanime/{u}/{i}',           'ApiController@getinfoanime');
    $router->get('/api/getepisode/{u}/{u}/{i}/{i}/{i?}',     'ApiController@getepisode'); 
    $router->get('/api/recanime/{u}/',                  'ApiController@recanime');
    
    //chat
    $router->get('/api/loadchat{u}',                    'ApiController@loadchat'); 
    $router->post('/api/sendmsg',                       'ApiController@sendmsg'); 
    $router->post('/api/delchatid',                     'ApiController@delchatid'); 
    
    //api profile
    $router->get('/api/getprofile/{u}/{i}',             'ApiController@getprofile'); 
    $router->get('/api/getborders/{u}/',             'ApiController@getborders'); 
    $router->get('/api/my_favorite/',                   'ApiController@my_favorite');
    $router->get('/api/my_favorite_id/{u}/{i}/{i}',     'ApiController@my_favorite_id'); 
    $router->get('/api/my_view_id/{u}/{i}/{i}',         'ApiController@my_view_id');
    $router->get('/api/act_fav/{u}/{i}/{i}',            'ApiController@act_fav');
    $router->get('/api/act_view/{u}/{i}/{i}',           'ApiController@act_view');
    $router->post('/api/saveprofile/',                  'ApiController@saveprofile'); 
    $router->post('/api/stats/',                        'ApiController@stats'); 
    $router->get('/api/my_list/{u}',                    'ApiController@my_list'); 
    //friends
    $router->get('/api/sendreqtofr/{u}/{i}',            'ApiController@sendreqtofr');
    $router->get('/api/checkfriend/{u}/{i}/{i}',        'ApiController@checkfriend'); 
    $router->get('/api/delfriend/{u}/{i}',              'ApiController@delfriend');
    //notice
    $router->get('/api/getnotice/{i?}',                 'ApiController@getnotice');
    
    //comments
    $router->post('/api/getcomms',                      'ApiController@getcomms');
    $router->post('/api/sendcomm',                      'ApiController@sendcomm');
    $router->post('/api/sendratingcomm',                'ApiController@sendratingcomm');
    
    //Подписка
    $router->post('/api/subscribe',                     'ApiController@subscribe');
    
    // поддержка
    $router->post('/api/support',                       'ApiController@support');
    $router->post('/api/getsupport',                    'ApiController@getsupport'); // пользователь получает список обращений
    
    //social
    $router->post('/api/push_social',                   'ApiController@push_social');
    
    $router->post('/api/search',                        'ApiController@search');
    
    //captcha
    $router->get('/gencaptcha',                         'MainController@gencaptcha');
    $router->post('/checkcaptcha',                      'MainController@checkcaptcha');
    
    // admin
    $router->get('/adminpanel',                         'AdminController@adminpanel');
    $router->get('/adminpanel/getrazdel',               'AdminController@getrazdel');
    $router->get('/adminpanel/getkontent',              'AdminController@getkontent');
    $router->get('/adminpanel/getgenre',                'AdminController@getgenre');
    $router->get('/adminpanel/addanime',                'AdminController@addanime');
    $router->get('/adminpanel/addcont',                 'AdminController@addcont');
    $router->get('/adminpanel/addcont_select_episode/{u}/{u}/{u}',  'AdminController@addcont_select_episode');
    $router->get('/adminpanel/makevideo/{u}/{u}/{u}',   'VideoController@makevideo');
    
    
    
    
    $router->get('/test/',                           'ApiController@test');
    
    
    
    
    //main
    
    

///////////////////////////////////////////////////////////////////////////////////////////
    $router->run();
} catch (Exception $e) {
    echo $e;
    echo "Servr error.";
    header('HTTP/1.0 200 ANIMEGAN');
    exit;
}