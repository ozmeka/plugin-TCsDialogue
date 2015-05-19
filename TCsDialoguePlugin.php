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
jQuery(window).load(function()
{
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
			width: 550,
			position: { my: "center", at: "center", of: window },
			modal: true,
			buttons:{ "Continue": function() {
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
	<div id='tcs_dialogue' style="display:none; z-index: 50; padding: 10px; border: 1px solid #000; text-align: left; margin: 0 auto; background-color: #fff;"><h1>Important Notices</h1>

<h2>Aboriginal and Torres Strait Islander people:</h2>

<p>Please be aware that this website may contain voices, images and/or names of deceased persons. If you wish to discuss the inclusion of material in this archive, please email <a href="mailto:atsida@lib.uts.edu.au">atsida@lib.uts.edu.au</a>.</p>

<h2>All users:</h2>

<p>Please note that, as far as possible, research materials on this site are provided ‘as is’. Where views are provided, these may not necessarily reflect the views of UTS and may reflect views from a period which would not be considered appropriate today.</p>

<p>Although many materials on this website are licensed CC-BY, please note that some materials have restricted licenses, and some cannot be licensed for reuse other than by the copyright holders. Before copying or reusing materials on this site, please ensure that you check the Access rights and License (if any).</p>

<p>By clicking continue, you agree that you will comply with these conditions.</p>

<p></p>
</div>
EOB;
	}
}
