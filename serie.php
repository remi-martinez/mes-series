<?php 

include "db.php";

$query = "SELECT favorite,state,name,season,genre,relevance FROM series	";

if (isset($_POST["query"]))
{
	if(strlen($_POST["query"]) > 0)
	{
		$query .= "WHERE name LIKE '%" . addslashes($_POST["query"]) . "%' ";
	}
}

$query .= "ORDER BY ";

if(isset($_GET["orderby"]))
{
	switch($_GET["orderby"])
	{
		case "favorite":
		$query .= "favorite DESC";		
		break;
		case "state":
		$query .=  "state DESC";
		break;
		case "name":
		$query .= "name";
		break;
		case "season":
		$query .= "SUBSTR(season, -1, 1) DESC";
		break;
		case "genre":
		$query .= "genre";
		break;
		case "relevance":
		$query .= "relevance DESC";
		break;
		default:
		header('Location: ../series');
		break;
	}
} else
{
	$query .= "name";
}
$query .= ",name";

$sth = $db->prepare($query);
if(!$sth->execute()) {
	die('<b>Ereur de requête SQL</b>:');
}
$rowcount = $sth->rowCount();

while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	echo "<tr>";
	foreach($row as $key => $value)
	{
		echo "<td>";
		$output = "";
		if ($key == "favorite" && $value == "1")
		{
			$output = "<span class=\"stateicon\" title=\"Série favorite\">⭐</span>";
		}
		if ($key == "state")
		{
			switch($value)
			{
				case "done":
				$output .= "<span class=\"stateicon\" title=\"Fin de la série - dernière saison\">✔</span>";
				break;
				case "watching":
				echo "<span class=\"stateicon\" title=\"En cours de visionnage\">👁</span>";
				break;
				case "waiting":
				$output .= "<span class=\"stateicon\" title=\"En attente de la prochaine saison\">⌛</span>";
				break;
				case "abandon":
				$output .= "<span class=\"stateicon\" title=\"Série abandonnée\">❌</span>";
			}
		}
		if ($key == "genre")
		{
			switch ($value)
			{
				case "SF / Fantasy":
				$output .= "🤖 ";
				break;
				case "Drame":
				$output .= "🎭 ";
				break;
				case "Policier":
				$output .= "👮 ";
				break;
				case "Comédie":
				$output .= "😜 ";
				break;
				case "Historique":
				$output .= "📜 ";
				break;
				case "Horreur":
				$output .= "😱 ";
				break;
			}
		}
		if ($key == "relevance")
		{
			switch($value)
			{
				case "0":
				$output .= "<font color=\"#f00\">";
				break;
				case $value < 20 || $value == "0%":
				$output .= "<font color=\"#f00\">";
				break;
				case $value < 40;
				$output .= "<font color=\"#E75236\">";
				break;
				case $value < 60;
				$output .= "<font color=\"#FEE99B\">";
				break;
				case $value < 70;
				$output .= "<font color=\"#CAE99D\">";
				break;
				case $value < 80;
				$output .= "<font color=\"#7CC665\">";
				break;
				case $value < 90;
				$output .= "<font color=\"#3FAA59\">";
				break;
				case $value <= 100;
				$output .= "<font color=\"#00AA29\">";
				break;
			}
		}

		if ($key != "favorite" && $key != "state")
			$output .= $value;
		if ($key == "relevance")
			$output .= "%";
		if ($row["favorite"] == "1")
		{
			$output = "<b>" . $output . "</b>";
		}
		echo $output . "</td>";
	}
	echo "</tr>";
}

if ($rowcount == 0)
{
	echo "Aucun nom ne correspond à <strong>" . strip_tags($_POST["query"]) . "</strong>";
}