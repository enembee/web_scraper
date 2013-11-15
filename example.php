<?php
include("includes/simple_html_dom.php");

$articles = array();
getArticles("http://net.tutsplus.com/page/76");

function getArticles($page){
	global $articles;

	$html = new simple_html_dom();
	$html->load_file($page);

	$items = $html->find("div[class=preview]");

	foreach ($items as $post) {
		$articles[] = array($post->children(3)->outertext, $post->children(6)->first_child()->outertext);
	}

	if ($next = $html->find("a[class=nextpostslink]",0)) {
		$url = $next->href;

		$html->clear();
		unset($html);

		getArticles($url);
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
<?php
    foreach($articles as $item) {
        echo $item[0];
        echo $item[1];
    }
?>
    </div>
</body>
</html>
