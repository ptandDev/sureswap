<?php

if (! function_exists('xprint')) {
    function xprint( $param, $title = 'Debugging'){
        ini_set( 'xdebug.var_display_max_depth', 50 );
        ini_set( 'xdebug.var_display_max_children', 25600 );
        ini_set( 'xdebug.var_display_max_data', 9999999999 );
        if ( PHP_SAPI == 'cli' )
        {
            echo "\n---------------[ $title ]---------------\n";
            echo print_r( $param, true );
            echo "\n-------------------------------------------\n";
        }
        else
        {
            ?>
            <style>
                .xprint-wrapper {
                    padding: 10px;
                    margin-bottom: 25px;
                    color: black;
                    background: #fbfbfb;
                    position: relative;
                    top: 18px;
                    border: 1px solid #dfdfdf;
                    font-size: 12px;
                    font-family: InputMono, Monospace;
                    width: 98.8%;
                }
                .xprint-title {
                    padding: 2px 5px;
                    color: #000;
                    background: #dfdfdf;
                    position: relative;
                    top: -18px;
                    width: 170px;
                    font-size: 14px;
                    text-align: center;
                    font-family: InputMono, Monospace;
                }
            </style>
            <div class="xprint-wrapper">
            <div class="xprint-title"><?= $title ?></div>
            <pre style="color:#000;"><?= htmlspecialchars( print_r( $param, true ) ) ?></pre>
            </div><?php
        }
    }
}