<?php 
    if(!isset($page_title)) {
        $page_title = 'TableEase: No place for Allergy trouble';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tableease - <?php echo h($page_title); ?></title>
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/site.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/bootstrap.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Chivo|Marvel" rel="stylesheet">
</head>

<body>

<nav>
    <ul>
        <li>
            <a href="<?php echo url_for('/index.php'); ?>">Home</a>
        </li>
    </ul>
</nav>
    
