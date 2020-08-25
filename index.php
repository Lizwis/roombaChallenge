<?php
if(isset($_POST['submit'])) 
{ 

$input_total_tiles=$_POST['total_tiles'];

$input_dirty_tiles=$_POST['dirty_tiles'];



/*we are going to represent dirty tiles by odd numbers 
and clean tiles by even numbers*/


/*this loop generates array of odd numbers equals to the number input of dirty tiles
*/
$dirty_tiles_array=[];
$counter = 0;

while (count($dirty_tiles_array) < $input_dirty_tiles) {
    $counter ++;

    if ($counter % 2 != 0) {
        $dirty_tiles_array[] = $counter;
    }
}


/*this loop generates array of even numbers equals to 
the number input of dirty tiles minus total number of tiles*/
$clean_tiles_array=[];
$counterr = 0;

while (count($clean_tiles_array) < ($input_total_tiles - $input_dirty_tiles)) {
    $counter ++;

    if ($counter % 2 == 0) {
        $clean_tiles_array[] = $counter;
    }
}

/*now we have an array of dirty tiles and array of clean tiles,  we are going to merge both arrays
and sort them randomly*/

$mixed_tiles = array_merge($clean_tiles_array, $dirty_tiles_array);

shuffle($mixed_tiles);


/*now we have a mix of dirty and clean tiles,we will let the roomba detect them and do the maths*/
$maxMoves=1000;
$total_points=0;

for($roomba = 0; $roomba < count($mixed_tiles); $roomba ++)
{
    if($mixed_tiles[ $roomba ] < $maxMoves)
    {
        $total_points-=10;

        if ($mixed_tiles[ $roomba ] % 2 != 0) {
            $total_points+=250;
        }
    }
}

}
?>

<html>

<head>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="total_tiles">Total Number of Tiles</label>
                    <input type="text" class="form-control" name="total_tiles"><br>

                    <label for="dirty_tiles">Total number of dirty Tiles</label>
                    <input type="text" class="form-control" name="dirty_tiles"><br>
                    <input type="submit" name="submit" class="btn btn-success" value="Submit Form"><br><br>

                </form>
                <?php echo "Total points of roomba: ".@$total_points; ?>

            </div>

            <?php if(@$mixed_tiles){?>
            <div class="col-8 text-center">
                <div class="row">
                    <?php
           for($i=0;$i<count($mixed_tiles);$i++)
           { ?>
                    <div
                        <?php if ($mixed_tiles[ $i ] % 2 != 0) {echo 'class="titesDirty"';} else echo 'class="titesClean"'; ?>>
                        <?php echo $mixed_tiles[ $i ] ?>
                    </div>

                    <?php } ?>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</body>

</html>