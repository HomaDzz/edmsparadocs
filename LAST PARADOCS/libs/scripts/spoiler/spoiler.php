<script type="text/javascript">// <![CDATA[
	jQuery(document).ready(function(){
		jQuery('.spoiler-text').hide()
		jQuery('.spoiler').click(function(){
			jQuery(this).toggleClass("folded").toggleClass("unfolded").next().slideToggle()
		})
	})
// ]]></script> <!-- Скрипт спойлера -->