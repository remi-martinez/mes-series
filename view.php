<!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- My custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- jQuery CDN -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<title>Mes séries</title>
</head>
<body>
	<?php include_once "header.php" ?>
	<table class="table table-striped table-dark">
		<thead>
			<tr>
				<th scope="col" id="favorite">Favori</th>
				<th scope="col" id="state">État</th>
				<th scope="col" id="name">Nom</th>
				<th scope="col" id="season">Saison</th>
				<th scope="col" id="genre">Genre</th>
				<th scope="col" id="relevance">Pertinence</th>
			</tr>
		</thead>
		<tbody id="result">
				<?php
				include_once "serie.php";
		if ($rowcount == 0) { echo "Aucun nom ne correspond à <strong>" . strip_tags($_POST["query"]) . "</strong>"; }
				?>
		</tbody>
	</table>
	<!-- Button trigger modal -->
	<div id="foot" class="container" style="text-align: center">
		<i><p style="color:rgb(115,115,115)"><?php echo $rowcount; ?> séries enregistrées.</p></i>
		<button style="margin-bottom:15px" type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Ajouter</button>
		<?php include_once "modal.php"; ?>
	</div>

</div>

<!-- jQuery AJAX Actualisation -->
<script>
	function displayOverlay()
	{
		document.getElementById("overlay").style.display = "block"
		document.getElementById("overlaytext").style.display = "block"
	}
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Recherche jQuery -->
<script>
	$(document).ready(function(){
		function load_data(query)
		{
			$.ajax({
				url:"serie.php",
				method:"post",
				data:{query:query},
				success:function(data)
				{
					$('#result').html(data);
				}
			});
		}

		$('#search_text').keyup(function(){
			var search = $(this).val();
			load_data(search);
		});
	});
</script>

</body>
</html>