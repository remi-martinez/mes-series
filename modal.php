<!-- Alert -->
<div style="display:none; margin-top:5px" id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
	<b>Attention !</b> La clé de vérification est incorrecte.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>	


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter une série</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Form -->
				<form name="modalform" id="modalform" method='post' action='.'>
					<div class="form-group row">
						<label for="inputName" class="col-sm-2 col-form-label">Nom</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nom">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputSeason" class="col-sm-2 col-form-label">Saison</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputSeason" name="inputSeason" placeholder="Saison">
						</div>
					</div>
					<div class="form-group row">
						<label for="selectGenre" class="col-sm-2 col-form-label">Genre</label>
						<div class="col-sm-10">									
							<select class="custom-select" id="selectGenre" name="selectGenre">
								<option selected style="font-style: italic">Choisir un genre...</option>
								<option value="Drame">🎭 Drame</option>
								<option value="SF / Fantasy">🤖 SF / Fantasy</option>
								<option value="Comédie">😜 Comédie</option>
								<option value="Policier">👮 Policier</option>
								<option value="Historique">📜 Historique</option>
								<option value="Horreur">😱 Horreur</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="selectState" class="col-sm-2 col-form-label">État</label>
						<div class="col-sm-10">									
							<select class="custom-select" id="selectState" name="selectState">
								<option selected style="font-style: italic">Choisir un état...</option>
								<option value="watching">👁 En cours de visionnage</option>
								<option value="done">✔ Fin de la série</option>
								<option value="waiting">⌛ En attente de la prochaine saison</option>
								<option value="abandon">❌ Série abandonnée</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputRelevance" class="col-sm-2 col-form-label">Pertinence</label>
						<div class="col-sm-10">
							<input type="number" min="0" max="100" class="form-control" id="inputRelevance" name="inputRelevance" placeholder="0-100">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputKey" class="col-sm-2 col-form-label"><b>Clé</b></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputKey" name="inputKey" placeholder="Clé de vérification admin" value=<?php if (isset($_POST["inputKey"])) echo $_POST["inputKey"];?>>
						</div>
					</div>
					<div class="form-group row">
						<div class="custom-control custom-checkbox" style="margin-left: 3%">
							<input type="checkbox" class="custom-control-input" name="chkFavorite" id="customCheck1">
							<label class="custom-control-label" for="customCheck1">Favori ⭐</label>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
						<button type="submit"  class="btn btn-primary">Ajouter</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<script>
	function submit()
	{
		document.getElementById('modalform').submit();
	}
</script>

<?php
if (!empty($_POST))
{
	if (strlen($_POST["inputName"]) > 0 && strlen($_POST["inputSeason"]) > 0)
	{
		if ($_POST["inputKey"] == "choucroute")
		{
			include "db.php";
			// gérer formulaire soumis => insert into.
			$name = strip_tags(addslashes($_POST["inputName"]));
			$season = strip_tags(addslashes($_POST["inputSeason"]));
			$state = strip_tags(addslashes($_POST["selectState"]));
			$genre = strip_tags(addslashes($_POST["selectGenre"]));
			$relevance = strip_tags(addslashes($_POST["inputRelevance"]));
			$favorite = "0";
			if (isset($_POST["chkFavorite"]))
				$favorite = "1";

			$query = "INSERT INTO series(favorite,name,season,state,genre,relevance) VALUES (:favorite, :name, :season, :state, :genre, :relevance)";
			$req = $db->prepare($query);
			$req->execute(array(
				"favorite" => $favorite, 
				"name" => $name,
				"season" => $season,
				"state" => $state,
				"genre" => $genre,
				"relevance" => $relevance
			));
			// inséré avec succès ! on retire les $_POST au cas où réactualisation.
			unset($_POST["inputName"]);
			unset($_POST["inputSeason"]);
			unset($_POST["selectState"]);
			unset($_POST["selectGenre"]);
			unset($_POST["inputRelevance"]);
			unset($_POST["inputKey"]);
		}
		else
		{
			?>
			<script>document.getElementById('alert').style.display = "block"</script>
			 <?php
		}
	}
}