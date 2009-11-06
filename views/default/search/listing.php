<?php
/**
 * Elgg search listing
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */
?>

<div class="search_listing">

<?php
$entities = $vars['entities'];
$count = $vars['count'];

if (!is_array($vars['entities']) || !count($vars['entities'])) {
	return FALSE;
}

$title_str = elgg_echo("item:{$vars['params']['type']}:{$vars['params']['subtype']}");
$body = elgg_view_title($title_str);

echo elgg_view('page_elements/contentwrapper', array('body' => $body));

foreach ($entities as $entity) {
	if ($owner = $entity->getOwnerEntity()) {
		$owner_icon = $owner->getIcon('tiny');
		$icon = "<img src=\"$owner_icon\" />";
	} else {
		$icon = '';
	}
	$title = $entity->getVolatileData('search_matched_title');
	$description = $entity->getVolatileData('search_matched_description');
	$url = $entity->getURL();
	$title = "<a href=\"$url\">$title</a>";
	$tc = $entity->time_created;
	$tu = $entity->time_updated;
	$time = friendly_time(($tu > $tc) ? $tu : $tc);

	echo <<<___END
<span class="searchListing">
	<h3 class="searchTitle">$title</h3>
	<span class="searchDetails">
		<span class="searchDescription">$description</span><br />
		$icon - $time - <a href="">More $title_str</a> -
	</span>
</span>
___END;
}

?>
</div>