<?php 
$realpath = realpath(__DIR__);
$directory = array_diff(scandir($realpath), array('..', '.'));
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
			$subDirName = $realpath."/".$dir."/".$subDir;
			require_once($subDirName);
			$className = explode(".", $subDir)[0];
			$$className = new $className();
		}
	}
}