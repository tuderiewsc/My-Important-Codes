<?php 
    
    $url = 'http://it-ebooks-api.info/v1/search/' . urlencode($search);
    $result = wp_remote_get($url);
    if (wp_remote_retrieve_response_code($result) != 200 ) {
        hmbs_set_404();
    }
    $body = json_decode($result['body']);
    if( $body->Error != '0' || $body->Total == '0' ){
        hmbs_set_404();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BookList</title>
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
        <style type="text/css">
            .item div{
                min-height: 650px;
                border: 1px solid red;
                margin-top: 5px;
                border-radius: 3px;
                text-align: center;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php foreach ( $body->Books as $book ):?>
                    <div class="item col-md-3">
                        <div>
                            <img src="<?php echo $book->Image;?>"/>
                            <h3 title="<?php echo isset($book->SubTitle) ? $book->SubTitle : ''; ?>">
                                <?php echo $book->Title;?>
                            </h3>
                            <p class="description">
                                <?php echo $book->Description;?>
                            </p>
                            <input type="button" class="btn btn-primary" value="Buy"/>
                            <a href="<?php echo home_url('book/' . $book->ID); ?>" class="btn btn-default">Full Information</a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </body>
</html>
