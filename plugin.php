<?php

class KokenGoogleAnalytics extends KokenPlugin {

	function __construct()
	{
		$this->require_setup = true;
		$this->register_hook('before_closing_head', 'render');
	}

	function render()
	{
		$gaSrcClassic = "('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'";
		$gaSrcWithDemographics = "('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js'";

		$anonymize = $this->data->anonymize ? 'true' : 'false';
		$gasrc = $this->data->demographics ? $gaSrcWithDemographics : $gaSrcClassic;

		echo <<<OUT
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '{$this->data->tracking_id}']);
 	_gaq.push(['_trackPageview']);
 	_gaq.push(['_anonymizeIP', {$anonymize}]);

 	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = {$gasrc};
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 	})();

	// For themes that use pjax or turbolinks
	$(window).on('page:change pjax:success', function() {
		_gaq.push(['_trackPageview']);
	});
</script>
OUT;

	}
}