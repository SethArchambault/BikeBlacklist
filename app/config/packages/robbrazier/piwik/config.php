<?php

return array(

    /*
     *  Server URL
     */

    'piwik_url'     => 'https://detroitbikeblacklist.com',

    /*
     *  Piwik Username and Password
     */

    'username'      => 'seth',
    'password'      => 'fd98fdas98rnjweREWQ345892%#@%',

    /*
     *  Optional API Key (will be used instead of Username and Password) 
     *  The bundle works much faster with the API Key, rather than username and password.
     */

    'api_key'       =>  '',

    /*
     *  Format for API calls to be returned in
     *  
     *  Can be [php, xml, json, html, rss, original]
     *  
     *  The default is 'json'
     */

    'format'        => 'json',

    /*
     *  Period/Date range for results
     *  
     *  Can be [today, yesterday, previous7, previous30, last7, last30, currentweek, currentmonth, currentyear]
     *
     *  The default is 'yesterday'
     */

    'period'        => 'yesterday',

    /*
     *  The Site ID you want to use
     */

    'site_id'       => '1',
);