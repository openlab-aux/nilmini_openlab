<?php

    function openlab_state( $atts ) {

        if( !function_exists( 'http_get' ) ) {
            return( 'you need pecl_http to use this shortcode' );
        }

        $a = shortcode_atts( array(
            'type' => 'icon_large'
        ), $atts );


        $api_response = http_parse_message( http_get( 'http://api.openlab-augsburg.de/data.json', array('timeout'=>1), $info ) )->body;

        if( $info['response_code'] != 200) {
            return 'API-call failed';
        }

        $labstate_open = json_decode( $api_response )->open;

        $icon_baseurl = "/wp-content/themes/nilmini_openlab/labstate_icons/";

        if( $labstate_open ) {

            switch( $a['type'] ) {
                case 'icon_large':  $out = $icon_baseurl."open_large.png"; break;
                case 'icon_small':  $out = $icon_baseurl."open_small.png"; break;
                case 'text':        $out = "Geöffnet!"; break;
                default:            $out = "undefined param"; break;
            }
        }
        else {

            switch( $a['type'] ) {
                case 'icon_large':  $out = $icon_baseurl."closed_large.png"; break;
                case 'icon_small':  $out = $icon_baseurl."closed_small.png"; break;
                case 'text':        $out = "Geschlossen."; break;
                default:            $out = "undefined param"; break;
            }

        }

        return $out;

    }


    add_shortcode('labstate', 'openlab_state');

?>

