<?php

class KokenGoogleAnalytics extends KokenPlugin {

	function __construct()
	{
		$this->require_setup = true;
		$this->register_hook('before_closing_head', 'render');
	}

	function render()
	{
		$anonymize = $this->data->anonymize ? 'true' : 'false';

		echo <<<OUT
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '{$this->data->tracking_id}']);
 	_gaq.push(['_trackPageview']);
 	_gaq.push(['_anonymizeIP', {$anonymize}]);

 	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 	})();

</script>
OUT;

	}
}