function assetsLoaded()
{
	/* iCheck */
	if ($(':radio, :checkbox').length > 0)
	{
		var checkboxCfg = cfg['checkbox'];
        var radioCfg = cfg['radio'];

		$('input').iCheck({
	        checkboxClass: 'icheckbox_' + checkboxCfg.class,
	        radioClass: 'iradio_' + radioCfg.class
	    });
	}

	/* Select2 */
	if (typeof $.fn.select2 == 'function')
	{
		$('select').css('width', '100%').select2();
	}
}