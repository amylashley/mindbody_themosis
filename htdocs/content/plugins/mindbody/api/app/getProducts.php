<?php
//require_once("../includes/saleService.php");

$sourcename = "OliveBeanStudio";
$password = "p2x8ROobDjL1XLc8V3CI/LUA6oE=";
$siteID = "-99";

// initialize default credentials
$creds = new SourceCredentials($sourcename, $password, array($siteID));

$classService = new MBSaleService(false);
$classService->SetDefaultCredentials($creds);

$result = $classService->GetProducts();

var_dump($result); die();
$cdsHtml = '<table><tr><td>ID</td><td>Name</td></tr>';
$cds = toArray($result->GetClassDescriptionsResult->ClassDescriptions->ClassDescription);
foreach ($cds as $cd) {
	$cdsHtml .= sprintf('<tr><td>%d</td><td>%s</td></tr>', $cd->ID, $cd->Name);
}
$cdsHtml .= '</table>';
	
echo($cdsHtml); 

?>
	</body>
</html>