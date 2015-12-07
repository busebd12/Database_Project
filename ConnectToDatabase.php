<?php
	
	/*
	Authored by: Brendan Busey and Jarrett Horne
	*/
	
	echo "<!-- Latest compiled and minified CSS -->";
	echo "<link rel=stylesheet href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css integrity=sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7 crossorigin=anonymous>";

	echo "<!-- Optional theme -->";
	echo "<link rel=stylesheet href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css integrity=sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r crossorigin=anonymous>";

	echo "<!-- Latest compiled and minified JavaScript -->";
	echo "<script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js integrity=sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS crossorigin=anonymous></script>";


	// database connection parameters
	$dbhost = "10.104.251.10";
	$dbname = "insert_creative_name_here";
	$dbuser = "busebd12";
	$dbpassword = "yourpassword";

	# make the database connection
	$connection=new mysqli($dbhost, $dbuser, $dbpassword, $dbname) or die("Cannot connect to database server.");

	/*
	//connects to the database
	$connect=mysql_connect($host,$username,$password) or die("Cannot Connect to database");
	mysql_select_db($db_name,$connect) or die ("Cannot find database");
	*/

	//checks the connection to the database
	/*
	if($connection==TRUE)
	{
		echo 'Connected to the database';
	}
	*/

	echo "<br>";

	$year=$_POST["year"];

	$totalExports=$_POST["total-exports-checkbox"];

	$goodsExported=$_POST["goods-exported-checkbox"];

	$servicesExported=$_POST["services-exported-checkbox"];

	$totalImports=$_POST["total-imports-checkbox"];

	$goodsImported=$_POST["goods-imported-checkbox"];

	$servicesImported=$_POST["services-imported-checkbox"];

	$totalImportsAndExports=$_POST["total-imports-exports-checkbox"];

	/*
	echo "The requested year is {$year}";

	echo "<br>";

	echo "Total exports: {$totalExports}";

	echo "<br>";
	
	echo "Goods exported: {$goodsExported}";

	echo "<br>";
	
	echo "Services exported: {$servicesExported}";

	echo "<br>";

	echo "Total imports: {$totalImports}";

	echo "<br>";

	echo "Goods imported: {$goodsImported}";

	echo "<br>";

	echo "Services imported: {$servicesImported}";

	echo "<br>";

	echo "Totoal imports and exports: {$totalImportsAndExports}";

	echo "<br>";
	*/

	$query="";

	if($year && $totalImportsAndExports)
	{
		$query="Select sum(Exports_Total+Imports_Total) from Exports, Imports where Exports_Year=$year and Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($result);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Total Imports and Exports</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>", $year, $result);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $totalImports && $totalExports)
	{
		$query="select Imports_Total, Exports_Total from Exports,Imports where Exports_Year=$year and Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($importTotals, $exportTotals);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Total Imports</th>";

			echo "<th>Total Exports</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td> <td>%s</td>", $year, $importTotals, $exportTotals);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}	
	}

	else if($year && $goodsImported && $servicesImported && $totalImports)
	{
		//echo "Inside the first if statement for the imports code";

		//echo "<br>";

		$query="select Imports_Goods, Imports_Services, Imports_Total from Imports where Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($importedGoods, $importedServices, $importsTotal);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Goods Imported</th>";

			echo "<th>Services Imported</th>";			

			echo "<th>Total Imports</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>  <td>%s</td>  <td>%s</td>", $year, $importedGoods, $importedServices, $importsTotal);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $goodsExported && $servicesExported && $totalExports)
	{
		$query="select Exports_Goods, Exports_Services, Exports_Total from Exports where Exports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($exportedGoods, $exportedServices, $exportsTotal);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Goods Exported</th>";

			echo "<th>Services Exported</th>";			

			echo "<th>Total Exports</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>  <td>%s</td>  <td>%s</td>", $year, $exportedGoods, $exportedServices, $exportsTotal);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $totalImports)
	{
		//echo "Inside the first else-if statement for the imports code";

		//echo "<br>";

		$query="Select Imports_Total from Imports where Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($result);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Total Imports</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>", $year, $result);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $totalExports)
	{
		$query="Select Exports_Total from Exports where Exports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($result);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Total Exports</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>", $year, $result);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && ($goodsExported && $servicesExported))
	{
		$query="select Exports_Goods, Exports_Services from Exports,Imports where Exports_Year=$year and Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($exportedGoods, $exportedServices);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Goods Exported</th>";

			echo "<th>Services Exported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td> <td>%s</td>", $year, $exportedGoods, $exportedServices);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $servicesImported && $goodsImported)
	{
		$query="select Imports_Services, Imports_Goods from Imports where Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($importedServices, $importedGoods);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Services Imported</th>";

			echo "<th>Goods Imported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>  <td>%s</td>", $year, $importedServices, $importedGoods);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $servicesImported && $servicesExported)
	{
		$query="select Imports_Services, Exports_Services from Imports, Exports where Exports_Year=$year and Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($importedServices, $exportedServices);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Services Imported</th>";

			echo "<th>Services Exported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>  <td>%s</td>", $year, $importedServices, $exportedServices);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $goodsExported && $goodsImported)
	{
		$query="select Exports_Goods, Imports_Goods from Exports,Imports where Exports_Year=$year and Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($exportedGoods, $importedGoods);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Goods Exported</th>";

			echo "<th>Goods Imported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td> <td>%s</td>", $year, $exportedGoods, $importedGoods);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $goodsImported && $servicesExported)
	{
		$query="Select Imports_Goods, Exports_Services from Exports, Imports where Exports_Year=$year and Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($importedGoods, $exportedServices);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Goods Imported</th>";

			echo "<th>Services Exported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>  <td>%s</td>", $year, $importedGoods, $exportedServices);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $servicesImported && $goodsExported)
	{
		$query="select Imports_Services, Exports_Goods from Imports, Exports where Exports_Year=$year and Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($importedServices, $exportedGoods);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Services Imported</th>";

			echo "<th>Goods Exported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>  <td>%s</td>", $year, $importedServices, $exportedGoods);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $goodsImported)
	{
		$query="Select Imports_Goods from Imports where Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($goodsImported);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Goods Imported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>", $year, $goodsImported);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $servicesImported)
	{
		$query="Select Imports_Services from Imports where Imports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($result);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Services Exported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>", $year, $result);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $goodsExported)
	{
		$query="Select Exports_Goods from Exports where Exports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($result);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Goods Exported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>", $year, $result);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else if($year && $servicesExported)
	{
		$query="Select Exports_Services from Exports where Exports_Year=$year";

		//echo "The query is: {$query}";

		echo "<br>";

		echo "<br>";

		$results=array();

		if($stmt=$connection->prepare($query))
		{
			$stmt->execute();

			$stmt->bind_result($result);

			echo "<table class='table table-bordered' style='width: 30%; margin-left: 60px';>";

			echo "<thead>";

			echo "<tr>";

			echo "<th>Year</th>";

			echo "<th>Services Exported</th>";

			echo "</thead>";

			echo "<tbody>";

			while($stmt->fetch())
			{
				printf("<tr>");

				printf("<td>%s</td>  <td>%s</td>", $year, $result);

				printf("</tr>");
			}

			echo "</tbody>";

			echo "</table>";
		}
	}

	else
	{
		"You did not enter a valid query. Please refer to the list of pre-packeged queries for what is deemed a valid query."
	}
	?>