<?php

class header
{

	private $core;

	public function __construct()
	{
		$this->core = new Core();
	}

	private function generateFileTier($newKeyArray, $fileTierInfo)
	{
		$newKey = $newKeyArray[0];
		array_shift($newKeyArray);
		if(count($newKeyArray) > 0)
		{
			return array(
				$newKey => array(
					"files"	=> $this->generateFileTier($newKeyArray, $fileTierInfo)
				)
			);
		}
		$newKey = str_replace(".xml", "", $newKey);
		return array(
			$newKey => $fileTierInfo
		);
	}

	private function modifyArrayAgain($newNavArray)
	{
		$evenNewerNavArray = array();
		foreach ($newNavArray as $NNAkey => $NNAvalue)
		{
			if(isset($NNAvalue["files"]))
			{
				$NNAvalue["files"] = $this->modifyArrayAgain($NNAvalue["files"]);
			}
			$position = 50;
			if(isset($NNAvalue["position"]))
			{
				$position = intval($NNAvalue["position"]);
				if($position < 10)
				{
					$position = "0".(string)$position;
				}
			}
			$evenNewerNavArray[$position."-".$NNAkey] = $NNAvalue;
		}
		return $evenNewerNavArray;
	}

	public function generateNavigationArray()
	{
		return $this->generateNavigationArrayWithParams(0);
	}

	public function generateSitemap()
	{
		return $this->generateNavigationArrayWithParams(-1);
	}

	private function generateNavigationArrayWithParams($minCurrent)
	{
		$currentDir = realpath(__DIR__ . '/../../../..')."/";
		$xmlDir = $currentDir."core/xml/content/";
		if(is_dir($currentDir."local/xml/content/"))
		{
			$xmlDir = $currentDir."local/xml/content/";
		}
		$arrayOfFiles = $this->core->loadDirFilesRec($xmlDir);
		foreach ($arrayOfFiles as $currentFileKey => $currentFile)
		{
			$xmlLayout = simplexml_load_file($currentFileKey);
			$arrayOfFiles[$currentFileKey]["position"] = intval($xmlLayout->menu->position);
			$arrayOfFiles[$currentFileKey]["name"] = (string)$xmlLayout->menu->name;
			$arrayOfFiles[$currentFileKey]["key"] = (string)$xmlLayout->menu->key;
			$current = 0;
			$currentURI = "$_SERVER[REQUEST_URI]";
			if("$_SERVER[REQUEST_URI]" === "/")
			{
				$currentURI = "/home";
			}
			if($currentURI === explode(".xml", $arrayOfFiles[$currentFileKey]["fileNamePlusPath"])[0])
			{
				$current = 1;
			}
			$arrayOfFiles[$currentFileKey]["current"] = $current;
		}
		$newNavArray = array();
		foreach ($arrayOfFiles as $AOFvalue)
		{
			if($AOFvalue["position"] <= $minCurrent)
			{
				continue; //skip if position is 0
			}
			$justPath = substr($AOFvalue["fileNamePlusPath"], 0, strrpos($AOFvalue["fileNamePlusPath"], '/'));
			$keys = array($AOFvalue["fileName"]);
			if(strlen($justPath) > 1)
			{
				$keys = explode("/", $justPath);
				array_push($keys, $AOFvalue["fileName"]);
				array_shift($keys);
			}
			$newNavArray = array_merge_recursive($newNavArray, $this->generateFileTier($keys, $AOFvalue));
		}
		$newNavArray = $this->modifyArrayAgain($newNavArray);
		ksort($newNavArray);
		return $newNavArray;
	}

	private function findIfSubCurrent($files)
	{
		foreach ($files as $name => $file)
		{
			if(isset($file["files"]))
			{
				if(!empty($file["files"]) && $this->findIfSubCurrent($file["files"]))
				{
					return true;
				}
			}
			if($file["current"] === 1)
			{
				return true;
			}
		}
		return false;
	}

	public function generateNavUL($navArray, $htmlToReturn = "")
	{
		$htmlToReturn .= "<ul>";
		foreach ($navArray as $key => $value)
		{
			$classText = "";
			$addClassText = false;
			if(isset($value["files"]))
			{
				if(!empty($value["files"]))
				{
					$current = $this->findIfSubCurrent($value["files"]);
					$classToAdd = " class=\"";
					if($current || (isset($value["current"]) && $value["current"] === 1))
					{
						$classToAdd .= " active ";
						$addClassText = true;
					}
					$linkForAtag = "";
					if(isset($value["fileNamePlusPath"]))
					{
						$linkForAtag = " href=\"".explode(".xml", $value["fileNamePlusPath"])[0]."\""; 
					}
					else
					{
						$classToAdd .= " noLink ";
						$addClassText = true;
					}
					$name = "";
					if(isset($value["name"]))
					{
						$name = $value["name"];
					}
					else
					{
						//no name set, grab from folder
						foreach ($value["files"] as $file)
						{
							$name = $file["path"];
							if(strpos($name, "/") === 0)
							{
								$name = ltrim($name, '/');
							}
							$name = ucfirst($name);
							break;
						}
					}
					$classToAdd .= " \"";
					if($addClassText)
					{
						$classText = $classToAdd;
					}
					$htmlToReturn .= "<li><a ".$classText." ".$linkForAtag.">".$name."</a>".$this->generateNavUL($value["files"])."</li>";
				}
			}
			else
			{
				$classToAdd = " class=\"";
				if($value["current"] === 1)
				{
					$classToAdd .= " active ";
					$addClassText = true;
				}
				$classToAdd .= " \"";
				if($addClassText)
				{
					$classText = $classToAdd;
				}
				$htmlToReturn .= "<li><a ".$classText." href=\"".explode(".xml", $value["fileNamePlusPath"])[0]."\" >".$value["name"]."</a></li>";
			}
		}
		$htmlToReturn .= "</ul>";
		return $htmlToReturn;
	}
}