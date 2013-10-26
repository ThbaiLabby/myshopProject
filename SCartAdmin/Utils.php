<?php

/*
 * Utility functions for program
 */

class Utils{
    /* Show Message using message div */
    public static function showMessage($message){
        echo '<div id="messagebox" class="ui-widget">
            <div class="ui-state-highlight ui-corner-all">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: 2px;"></span>';
        echo $message;
        echo '</p></div></div>';
    }

    public static function showErrorMessage($message){
        echo '<div id="messagebox" class="ui-widget">
            <div class="ui-state-error ui-corner-all" >
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: 2px;"></span>';
        echo $message;
        echo '</p></div></div>';
    }

}