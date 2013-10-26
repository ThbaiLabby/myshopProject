/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
        $( "#btnLogin" ).button();
        $( "#btnLogout" ).button();
        $( "#adminmenu" ).menu();

        // Hover states on the static widgets
        $( "#dialog-link, #icons li" ).hover(
                function() {
                        $( this ).addClass( "ui-state-hover" );
                },
                function() {
                        $( this ).removeClass( "ui-state-hover" );
                }
        );
});
        