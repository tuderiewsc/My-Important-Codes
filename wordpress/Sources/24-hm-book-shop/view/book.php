<?php
    
    $url = 'http://it-ebooks-api.info/v1/book/' . urlencode($book_id);
    $result = wp_remote_get($url);
    if (wp_remote_retrieve_response_code($result) != 200 ) {
        hmbs_set_404();
    }
    $book = json_decode($result['body']);
    if( $book->Error != '0' ){
        hmbs_set_404();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $book->Title;?></title>
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
        <style type="text/css">
            img{
                float: left;
                margin: 10px;
            }
            p{
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1><?php echo $book->Title;?></h1>
            <img src="<?php echo $book->Image;?>"/>
            <p class="description"><?php echo $book->Description;?></p>
            <p>
                Page Number: <?php echo $book->Page;?><br>
                Year: <?php echo $book->Year;?><br>
                Publisher: <?php echo $book->Publisher;?><br>
                <a class="btn btn-info" href="<?php echo $book->Download;?>" target="_blank">Download</a>
            </p>
        </div>
    </body>
</html>