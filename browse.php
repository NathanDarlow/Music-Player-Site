
<head>
        <title>

        </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
    </head>

<?php 
include("includes/includedFiles.php"); 
?>

<div class="container">
                <nav>
                    <ul>
                        <li class="current"><a href="#">All Jobs</a></li>
                        <li><a href="#">Rock</a></li>
                        <li><a href="#">Pop</a></li>
                        <li><a href="#">Cinematic</a></li>
                        <li><a href="#">Folk</a></li>
                    </ul>
                </nav>
                <div id="projects">
                    <h1 class="heading">All Albums</h1>
                    <ul id="gallery">

	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 50");

		while($row = mysqli_fetch_array($albumQuery)) {
			



			echo "<li class='". $row['genre'] ."'>
			<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                              <img src='". $row['artworkPath'] ."'>

                              <div class='gridViewInfo'>"
                                . $row['title'] .
                                "</div></span>";




		}
	?>
	
	</div>
                    </ul>
                    </nav>
                </div>
            </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
<script>
          $(document).ready(function(){
    // filter
    $('nav a').on('click', function(event){
        event.preventDefault();
        // current class
        $('nav li.current').removeClass('current');
        $(this).parent().addClass('current');

        // set new heading
        $('h1.heading').text($(this).text());

        // filter link text
        var category = $(this).text().toLowerCase().replace(' ', '-');

        // remove hidden class if "all" is selected
        if(category == 'all-jobs'){
            $('ul#gallery li:hidden').fadeIn('slow').removeClass('hidden');
        } else {
            $('ul#gallery li').each(function(){
               if(!$(this).hasClass(category)){
                   $(this).hide().addClass('hidden');
               } else {
                   $(this).fadeIn('slow').removeClass('hidden');
               }
            });
        }
        return false;
    });

});
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Dosis');


* {
    margin: 0;
    padding: 0;
}

::selection {
	text-shadow: 1px 1px 3px blue;
	background: none;
}

body {
    color: #333;
    font-size: 13px;
    background: #f4f4f4;
    font-family: "Dosis", sans-serif;
    overflow:auto;
}

.container {
    width: 90%;
    max-width: 960px;
    margin: 10vh auto;
    position: relative;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    text-transform: uppercase;
		margin-bottom: 20px;
    text-transform: uppercase;
    font-size: 2.5rem;
		font-family: "Dosis", sans-serif;
		font-weight: 800;
		letter-spacing: 5px;
    color: #79bd9a;
}

nav {
    display: block;
    width: 100%;
}

ul {
   list-style: none;
   margin-bottom: 20px;
}

nav > ul > li {
    display: inline-block;
}
nav > ul > li > a {
    text-transform: uppercase;
    padding: 4px 10px;
    margin-right: 2px;
    margin-left: 2px;
    text-decoration: none;
    color: #79bd9a;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 1px solid #000;
    -webkit-transition: all 300ms ease-in-out;
    -moz-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
		letter-spacing: 2px;
}

.hidden {
    display: none;
}

nav > ul > li > a:hover, .current a {
    color: #fff;
    background-color: #79bd9a;
}

/**
Index Page
**/

#projects > ul > li {
    display: inline-block;
    float: left;
    margin-right: 10px;
    margin-bottom: 5px;
    width: 23%;
    height: auto;
    cursor: pointer;
    border-radius: 5px;
    /* Padding stays within the width */
    box-sizing: border-box;
    position: relative;
    opacity: 0.8;
    -webkit-transition: all 300ms ease-in-out;
    -moz-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
}

#projects > ul > li:hover {
    opacity: 1;
}

#projects a {
	text-decoration: none;
}

li > span > img {
    max-width: 100%;
    border-radius: 5px;
}

.gallery {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    padding: 40px 10px;
    display: none;
    box-sizing: border-box;
}

.gallery > img {
    max-height: 100%;
    width: auto;
}

.close i {
    position: fixed;
    top: 10px;
    right: 10px;
    height: 30px;
    width: 30px;
}

.bar {
    display: block;
    position: absolute;
    top: 13px;
    float: left;
    width: 30px;
    border-bottom: 4px solid #fff;
    transform: rotate(45deg);
}

.bar:first-child {
    transform: rotate(-45deg);
}

@media (max-width: 768px){
    #projects > ul > li {
        width: 48%;
    }
}

@media (max-width: 568px) {
    #projects > ul > li {
        width: 100%;
    }
}

.gridViewInfo {
	font-family: "Dosis", sans-serif;
	font-size: 18px;
	color: #000000;
	font-weight: 600;
	padding: 5px 0px;
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;
}

</style>