<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: index.php");
	}
	include('nav.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>OUSL Library</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm">
				<h2>Hi...! Welcome <?php echo $_SESSION['username'] ;?></h2>
			</div>
		</div>
		<br>

		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		      <img class="d-block w-100" src="../images/carousel/lib1.jpg" alt="First slide" height="400px">
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="../images/carousel/lib2.jpg" alt="Second slide" height="400px">
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="../images/carousel/lib3.jpg" alt="Third slide" height="400px">
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="../images/carousel/lib4.jpg" alt="Third slide" height="400px">
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="../images/carousel/lib5.jpg" alt="Third slide" height="400px">
		    </div>
		  </div>
		</div>
		<br><br>

		<div class="container">
		  <div class="row">
		  	<div class="col-sm">

			    <div class="card" style="width: 18rem;">
					<img class="card-img-top" src="../images/cards/books.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Books</h5>
					   	<p class="card-text" align="justify">The main reference collection contains Tertiary Sources such as general and subject Encyclopedias, Dictionaries of English Language, other languages, Bilingual Dictionaries and Subject Dictionaries, Composite and Subject Glossaries, Year Books, Almanacs, Directories, International, National and Subject Biographies, Maps, Atlases, Gazetteers, Guide Books, Hand Books, Manuals and Thesaurus, CD ROMs including Encyclopedia Britannica, Encarta, etc.</p>
					   	<br><br><br>
					   	<a href="../Resources/home.php" class="btn btn-primary">Go Books Collection</a>
					</div>
				</div>

		    </div>

		    <div class="col-sm">
		    	<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="../images/cards/Journals.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Journals</h5>
					   	<p class="card-text" align="justify">Current information can be obtained from the articles of periodicals. Therefore periodicals are of great importance where research is concerned. All periodicals published in Sinhala, Tamil and English in Sri Lanka, are acquired by the National Library, according to its acquisitions policy. Foreign Periodicals too acquire in the fields of Social Science, humanities, Science and Technology and Library and Information Science. Periodicals are acquired through purchases, exchange and donations. Holdings of the periodicals comprise of a large number of periodical titles.</p>
					   	<a href="../Resources/home.php" class="btn btn-primary">Go Journals Collection</a>
					</div>
				</div>
		    </div>

		    <div class="col-sm">
		      <div class="card" style="width: 18rem;">
					<img class="card-img-top" src="../images/cards/CMs.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Course Materials and Book Shop</h5>
					   	<p class="card-text" align="justify">The OUSL Library bookshop is maintained with the objective of providing books and library stationaries on concessionary rate. Range of fiction, non-fiction and children’s literature titles, stationaries and stationaries specially required for libraries are available for sale in the National Library bookshop.</p>
					   	<br><br><br><br><br><br><br>
					   	<a href="../Resources/home.php" class="btn btn-primary">Go Course Materials Collection</a>
					</div>
				</div>
		    </div>

		  </div>
		</div>
		<br><br><br>

	</div>

</body>
</html>
