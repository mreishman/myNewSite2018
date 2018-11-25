<?php 
$realpath = realpath(__DIR__);
$directory = array_diff(scandir($realpath), array('..', '.'));
if(is_dir("../../local/"))
{
	if(is_dir("../../local/php/"))
	{
		$addLocalDir = array_diff(scandir("../../local/php/"), array('..','.'));
		$director = array_merge($directory, $addLocalDir);
	}
}
foreach($directory as $dir)
{
	$dirname = $realpath."/".$dir;
	if(is_dir($dirname))
	{
		$subDirectory = array_diff(scandir($dirname), array('..', '.'));
		if(count($subDirectory) <= 0)
		{
			continue;
		}
		foreach ($subDirectory as $subDir)
		{
			if(strpos($subDir, "._") === 0)
			{
				continue;
			}
			$className = explode(".", $subDir)[0];
			if(isset($$className))
			{
				//class already loaded
				continue;
			}
			$subDirName = $realpath."/".$dir."/".$subDir;
			$subDirNameLocal = str_replace("core", "local", $subDirName);
			if(file_exists($subDirNameLocal))
			{
				//override core file with local file
				$subDirName = $subDirNameLocal;
			}
			require_once($subDirName);
			$$className = new $className();
		}
	}
}