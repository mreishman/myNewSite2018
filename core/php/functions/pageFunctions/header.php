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
		}
		$newNavArray = array();
		foreach ($arrayOfFiles as $AOFvalue)
		{
			if($AOFvalue["position"] === 0)
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

	public function generateNavUL($navArray, $htmlToReturn = "")
	{
		$htmlToReturn .= "<ul>";
		foreach ($navArray as $key => $value)
		{
			if(isset($value["files"]))
			{
				if(!empty($value["files"]))
				{
					$htmlToReturn .= "<li><a href=\"".explode(".xml", $value["fileNamePlusPath"])[0]."\" >".$value["name"]."</a>".$this->generateNavUl($value["files"])."</li>";
				}
			}
			else
			{
				$htmlToReturn .= "<li><a href=\"".explode(".xml", $value["fileNamePlusPath"])[0]."\" >".$value["name"]."</a></li>";
			}
		}
		$htmlToReturn .= "</ul>";
		return $htmlToReturn;
	}
}