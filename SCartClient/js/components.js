/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
		$( "#btnLogin" ).button();
                $( "#btnLogout" ).button();
                $( "#btnRegister" ).button();
                $( "#btnSearch" ).button();
                $('.buyButton').each(function(){
                    $(this).button();
                });
		
		$( "#tabs" ).tabs();
                
                $( "#accordion" ).accordion({
                    heightStyle: "content"
                });
                
                $( "#categorymenu" ).menu();
		
		$( "#datepicker" ).datepicker({
			inline: true
		});
                
                $(function() {
                    $( "#checkoutDialog" ).dialog({
                        modal: true
                    });
                });
                
                $(function() {
                    $( "#registration" ).dialog({
                        modal: true,
                    });
                });
                
                var availableTags = [
			"Dell",
			"Apple",
			"Samsung"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
                
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
        