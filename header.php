	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="../series">Mes séries</a>
		<div class="divider"></div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href=".">Grande liste <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Trier par
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="?orderby=favorite">Favori</a>
						<a class="dropdown-item" href="?orderby=state">État</a>
						<a class="dropdown-item" href="?orderby=name">Nom</a>
						<a class="dropdown-item" href="?orderby=season">Saison</a>
						<a class="dropdown-item" href="?orderby=genre">Genre</a>
						<a class="dropdown-item" href="?orderby=relevance">Pertinence</a>
					</div>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0" method="post">
				<input class="form-control mr-sm-2" type="search" placeholder="Rechercher nom..." name="search_text" id="search_text" aria-label="Search">
			</form>
		</div>
	</nav>