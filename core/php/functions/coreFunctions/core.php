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
		if(file_exists($currentDir."local/".$default))
		{
			return $currentDir."local/".$default;
		}
		if(file_exists($currentDir."core/".$default))
		{
			return $currentDir."core/".$default;
		}
		return $default;
	}

	private function getFileWeb($fileLookFor, $default = false)
	{
		$currentDir = realpath(__DIR__ . '/../../../..')."/";
		if(file_exists($currentDir."local/".$fileLookFor))
		{
			return array(
				"fileName"	=>	"local/".$fileLookFor,
				"time"		=>	filemtime("local/".$fileLookFor)
			);
		}
		if(file_exists($currentDir."core/".$fileLookFor))
		{
			return array(
				"fileName"	=>	"core/".$fileLookFor,
				"time"		=>	filemtime("core/".$fileLookFor)
			);
		}
		if(file_exists($currentDir."local/".$default))
		{
			return array(
				"fileName"	=>	"local/".$default,
				"time"		=>	filemtime("local/".$default)
			);
		}
		if(file_exists($currentDir."core/".$default))
		{
			return array(
				"fileName"	=>	"core/".$default,
				"time"		=>	filemtime("core/".$default)
			);
		}
		return array(
				"fileName"	=>	$default,
				"time"		=>	1
			);
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
					"fileNamePlusPath"	=>	$addedDir."/".$fileOrDir,
					"path"				=>	$addedDir
				);
			}
		}
		return $arrayOfFiles;
	}

	public function getContent($layoutFileGen)
	{
		//js files
		$listOfJsFiles = $this->generateJsLinks($layoutFileGen);
		foreach ($listOfJsFiles as $fileData) {
			echo "<script type=\"text/javascript\" src=\"".$fileData["fileName"]."?v=".$fileData["time"]."\"></script>";
		}
		//css files
		$listOfCssFiles = $this->generateCssLinks($layoutFileGen);
		foreach ($listOfCssFiles as $fileData) {
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/".$fileData["fileName"]."?v=".$fileData["time"]."\">";
		}
		//return main file path
		return $this->getFile("content/".$layoutFileGen->content->group."/".$layoutFileGen->content->file.".".$layoutFileGen->content->type,"content/base/404.html");
	}

	public function generateCssLinks($layoutFileGen)
	{
		$arrayOfCssFiles = array();
		$listOfCssFiles = $layoutFileGen->cssFiles;
		if(count($listOfCssFiles) > 0)
		{
			foreach ($listOfCssFiles[0] as $outer)
			{
				$fileData = $this->getFileWeb("css/".$outer->group.$outer->file);
				array_push($arrayOfCssFiles, $fileData);
			}
		}
		return $arrayOfCssFiles;
	}

	public function generateJsLinks($layoutFileGen)
	{
		$arrayOfJsFiles = array();
		$listOfJsFiles = $layoutFileGen->jsFiles;
		if(count($listOfJsFiles) > 0)
		{
			foreach ($listOfJsFiles[0] as $outer)
			{
				$fileData = $this->getFileWeb("js/".$outer->group.$outer->file);
				array_push($arrayOfJsFiles, $fileData);
			}
		}
		return $arrayOfJsFiles;
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