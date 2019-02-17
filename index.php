<?php
require_once(dirname(__file__)."/core/php/functions/loader.php");
$page = "home";
if (!empty($_GET['page']))
{
	$page = $_GET["page"];
}
$testPage = rtrim($page, '/');
if($testPage !== $page)
{
	header("Location: ".$data->getValue("baseUrl")."/".$testPage); /* Redirect browser */
	exit();
}
$page = $testPage;
/* make sure page isn't bad*/

$baseXmlGen = $core->getPageXml($page, $core->getValue("defaultBaseXml"));

$layoutFileGen = $core->getTemplateXml($baseXmlGen->layout);

require_once($core->getContent($layoutFileGen));