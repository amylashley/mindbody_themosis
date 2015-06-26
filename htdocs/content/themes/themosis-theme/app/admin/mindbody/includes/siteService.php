<?php
require_once("mbapi.php");

class MBSiteService extends MBAPIService
{	
	function __construct($debug = false)
	{
		$endpointUrl = "https://" . GetApiHostname() . "/0_5/SiteService.asmx";
		$wsdlUrl = $endpointUrl . "?wsdl";
	
		$this->debug = $debug;
		$option = array();
		if ($debug)
		{
			$option = array('trace'=>1);
		}
		$this->client = new soapclient($wsdlUrl, $option);
		$this->client->__setLocation($endpointUrl);
	}
        
        public function GetSites($searchText = null, $relatedSiteID = null) {
		$additions = array();
		if (isset($searchText))
		{
			$additions['SearchText'] = $searchText;
		}
		if (isset($relatedSiteID))
		{
			$additions['RelatedSiteID'] = $relatedSiteID;
		}
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		$result = $this->client->GetSites($params);
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
        
        public function GetPrograms($scheduleType = "All", $onlineOnly = false) {
           
		$additions = array();
		if (isset($scheduleType))
		{
			$additions['ScheduleType'] = $scheduleType;
		}
		if (isset($onlineOnly))
		{
			$additions['OnlineOnly'] = $onlineOnly;
		}
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		$result = $this->client->GetPrograms($params);
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
        
        
        public function GetLocations() {
		$additions = array();
		/*if (isset($searchText))
		{
			$additions['SearchText'] = $searchText;
		}
		if (isset($relatedSiteID))
		{
			$additions['RelatedSiteID'] = $relatedSiteID;
		}*/
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		$result = $this->client->GetLocations($params);
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
        
        public function GetRelationships() {
		$additions = array();
		/*if (isset($searchText))
		{
			$additions['SearchText'] = $searchText;
		}
		if (isset($relatedSiteID))
		{
			$additions['RelatedSiteID'] = $relatedSiteID;
		}*/
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		$result = $this->client->GetRelationships($params);
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
        
        public function GetResources() {
		$additions = array();
		/*if (isset($searchText))
		{
			$additions['SearchText'] = $searchText;
		}
		if (isset($relatedSiteID))
		{
			$additions['RelatedSiteID'] = $relatedSiteID;
		}*/
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		
		$result = $this->client->GetResources($params);
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
        
        public function GetSessionTypes($programIDs = array(), $onlineOnly = false) {
		$additions = array();
		if (isset($programIDs))
		{
			$additions['ProgramIDs'] = $programIDs;
		}
		if (isset($onlineOnly))
		{
			$additions['OnlineOnly'] = $onlineOnly;
		}
		
		$params = $this->GetMindbodyParams($additions, $this->GetCredentials($credentials), $XMLDetail, $PageSize, $CurrentPage, $Fields);
		$result = $this->client->GetSessionTypes($params);
		
		if ($this->debug)
		{
			DebugRequest($this->client);
			DebugResponse($this->client, $result);
		}
		
		return $result;
	}
	
	
}