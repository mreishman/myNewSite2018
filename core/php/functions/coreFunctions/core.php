<?php
class core
{
	private function getFile($fileLookFor, $default = false)
	{
		$currentDir = realpath(__DIR__ . '/../../../..')."/";
		if(file_exists($currentDir."local/".$fileLookFor))
		{
			return $currentDir."local/".$fileLookFor;
		}
		if(file_exists($currentDir."core/".$fileLookFor))
		{
			return $currentDir."core/".$fileLookFor;
		}
		return $default;
	}

	public function loadDirFilesRec($directory, $arrayOfFiles = array(), $addedDir = "")
	{
		$fileList = array_diff(scandir($directory), array('..', '.'));
		foreach ($fileList as $fileOrDir)
		{
			$entireFileOrDir = $directory."/".$fileOrDir;
			if(is_dir($entireFileOrDir))
			{
				$arrayOfFiles = $this->loadDirFilesRec($entireFileOrDir, $arrayOfFiles, $addedDir."/".$fileOrDir);
			}
			elseif(is_file($entireFileOrDir) && strpos($fileOrDir, "._") !== 0)
			{
				$arrayOfFiles[$entireFileOrDir] = array(
					"fileName"			=>	$fileOrDir,
					"fileNamePlusPath"	=>	$addedDir."/".$fileOrDir
				);
			}
		}
		return $arrayOfFiles;
	}

	public function getContent($layoutFileGen)
	{
		return $this->getFile("content/".$layoutFileGen->content->group."/".$layoutFileGen->content->file.".".$layoutFileGen->content->type);
	}

	public function getXml($page, $default = false)
	{
		return simplexml_load_file($this->getFile("xml/".$page.".xml", $default));
	}

	public function getModule($layoutFileGen, $module)
	{
		return $this->getFile("content/".$layoutFileGen->modules->$module->content->group."/".$layoutFileGen->modules->$module->content->file.".".$layoutFileGen->modules->$module->content->type);
	}

	public function getPageXml($page, $default = false)
	{
		return simplexml_load_file($this->getFile("xml/content/".$page.".xml", $default));
	}

	public function getTemplateXml($page, $default = false)
	{
		return simplexml_load_file($this->getFile("xml/templates/".$page.".xml", $default));
	}
}