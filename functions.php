<?php

    function openlab_state() {

        $api_response = http_get( 'http://api.openlab-augsburg.de/data.json', array('timeout'=>1), $info );

        if( $info['response_code'] != 200) {
            return 'API-call failed';
        }

        $labstate_open = json_decode( $api_response, true )['open'];

        return $labstate_open;
    }


    add_shortcode('raumstatus', 'openlab_state');

?>
