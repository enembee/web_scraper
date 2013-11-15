<?php
include("includes/simple_html_dom.php");

$shows = array();
getShows("http://www.soundscapesmusic.com/tickets");

function getShows($page){
	global $shows;

	$html = new simple_html_dom();
	$html->load_file($page);

	$items = $html->find("tr");

	//print_r($items);

	foreach ($items as $post) {
		$shows[] = array($post->children(0)->innertext, $post->children(1)->innertext, $post->children(2)->innertext, $post->children(3)->innertext);
	}
}

?>
<html>
<head>
    <style>
        #main {
            margin: 80px auto;
            width: 600px;
        }
        h1 {
            font: bold20px/30px verdana, sans-serif;
            text-decoration: none;
        }
        p {
            font: 10px/14px verdana, sans-serif;
        }
    </style>
</head>
<body>
    <div id="main">
    	<h1>Some shows</h1>
<?php
    foreach($shows as $item) {
    	echo "<p>";
        echo $item[0];
        echo " ";
        echo $item[1];
        echo " ";
        echo $item[2];
        echo "</p>";
    }
?>
    </div>
</body>
</html>