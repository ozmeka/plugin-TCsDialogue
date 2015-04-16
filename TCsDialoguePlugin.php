<?php

class TCsDialoguePlugin extends Omeka_Plugin_AbstractPlugin
{
	protected $_hooks = array('public_head', 'public_header');

//    protected $_filters = array();

	public function hookPublicHead()
	{
		queue_js_file('jquery.cookie');
	}

	public function hookPublicHeader()
	{
		echo <<<EOB
	<style>
		.no-close .ui-dialog-titlebar-close {
			display: none;
		}
	</style>
	<script>
jQuery(function() {
	
	var tncs = jQuery.cookie('dharmae_tncs');
	if (tncs == null)
	{
		var pageh = jQuery(document).height();
		var pagew = jQuery(window).width();
		var blackout = jQuery('<div class="blackout"></div>');
		jQuery(blackout).appendTo('body');
		jQuery('.blackout').css({
				'position':'absolute',
				'top':'0',
				'left':'0',
				'background-color':'rgba(0,0,0,0.6)',
				'height': pageh,
				'width': pagew,
				'z-index':'0'
			});

		jQuery('#tcs_dialogue').dialog({
			dialogClass: 'no-close',
			height: 'auto',
			width: 350,
			position: { my: "center", at: "center", of: window },
			modal: true,
			buttons:{ "Proceed": function() {
					jQuery.cookie('dharmae_tncs', 'accepted', {expires : 90 });
					jQuery('.blackout').remove();
					jQuery(this).dialog("close").hide();
				}
			},
			draggable: false,
			resizable: false,
		}).show();
	}
});
	</script>
	<div id='tcs_dialogue' style="display:none; z-index: 50; padding: 5; border: 1px solid #000; text-align: center; margin: 0 auto; background-color: #fff;">Please accept our terms to continue.</div>
EOB;
	}
}
