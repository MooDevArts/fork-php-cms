<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM songs
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Song has been deleted' );
  
  header( 'Location: songs.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM songs
  ORDER BY name DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Songs</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Name</th>
    <th align="center">url</th>
    <th align="center">genre</th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=skill&id=<?php echo $record['id']; ?>&width=150&height=150&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['name'] ); ?>
        <br>
        <small><?php echo $record['url']; ?></small>
      </td>
      <td align="center"><?php echo $record['genre']; ?></td>
      <td align="center"><a href="songs_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="songs_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="songs.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this song?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="songs_add.php"><i class="fas fa-plus-square"></i> Add Song</a></p>


<?php

include( 'includes/footer.php' );

?>