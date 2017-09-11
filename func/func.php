<?php

function flashMsg($redirection = false) {

	//$_SESSION['flash'][$class] = $msg;

	if ($redirection != false) { ?>

		<script type="text/javascript">
            window.location.href = "<?= $redirection ?>";
        </script>

	<?php }

	exit();

} ?>
