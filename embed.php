<?php
/**
 * Onscribe: Embed code
 *
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */

// set classes
$class = "onscribe";
if ( !empty($style) ){
	$class .= " ". $style;
}
?>

<div class="<?php echo $class; ?>" data-product="<?php echo $product; ?>"<?php if ( !empty($prompt) ){ echo ' data-prompt="'. $prompt .'"'; } ?>><!-- --></div>
<script type="text/javascript">
(function(w,d) { var el = d.getElementById('onscribe-embed'); if( el == null ){
	var o = d.createElement('script'); o.type = 'text/javascript'; o.async = true;
	o.id = 'onscribe-embed'; o.src = '//onscri.be/embed.js';
	var s = d.getElementsByTagName('script')[0]; s.parentNode.insertBefore(o, s);
}})(window, document);
</script>
