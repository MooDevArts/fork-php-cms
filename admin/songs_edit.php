<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: songs.php' );
  die();
  
}

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] and $_POST['url'] )
  {
    
    $query = 'UPDATE songs SET
      name = "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
      url = "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
      genre = "'.mysqli_real_escape_string( $connect, $_POST['genre'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Song has been updated' );
    
  }

  header( 'Location: songs.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM songs
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: songs.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Skill</h2>

<form method="post">
  
  <label for="title">Name:</label>
  <input type="text" name="name" id="name" value="<?php echo htmlentities( $record['name'] ); ?>">
    
  <br>
  <label for="url">URL:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>">
  
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
  
  <label for="content">Genre:</label>
  <input type="text" name="genre" id="genre" value="<?php echo htmlentities( $record['genre'] ); ?>"></input>
  
  <br>
  
  <input type="submit" value="Edit Song">
  
</form>

<p><a href="songs.php"><i class="fas fa-arrow-circle-left"></i> Return to Song List</a></p>


<?php

include( 'includes/footer.php' );

?>