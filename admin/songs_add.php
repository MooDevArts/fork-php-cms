<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] and $_POST['url'] )
  {
    
    $query = 'INSERT INTO songs (
        name,
        url,
        genre
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['genre'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Song has been added' );
    
  }
  
  header( 'Location: songs.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Song</h2>

<form method="post">
  
  <label for="title">Name:</label>
  <input type="text" name="name" id="name">
    
  <br>
      
  <script>

  ClassicEditor
    .create( document.querySelector( '#content' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">

  
  <br>
  <label for="content">Genre:</label>
  <input type="text" name="genre" id="genre"></input>
  <input type="submit" value="Add Song">
  
</form>

<p><a href="songs.php"><i class="fas fa-arrow-circle-left"></i> Return to Song List</a></p>


<?php

include( 'includes/footer.php' );

?>