<html>
    <head>
        <?php require_once('filesDb/filesDb.php');?>
        <?php include_once('script/templates.html');?>
        <?php require_once('filesStructure/Structure.php');?>
        <link rel="stylesheet" href="css/app.css" />
        <script type="text/javascript" src="script/jQuery.js"></script>
        <script type="text/javascript" src="script/underscore.js"></script>
        <script type="text/javascript" src="script/backbone.js"></script>
        <link rel="stylesheet" href="css/animate-custom.css" />
        <script type="text/javascript" src="script/app.js"></script>
    </head>
    <body>
        <div id="addnew">
            <a href="#" id="add_new_file" class="add_new_file">Click here to add a new file</a>
        </div>
        <div id="directory_structure">
            <?php 
                require_once 'filesStructure/partial.php';
            ?>
        </div>
        <div id="fly-box"></div>
    </body>
</html>
<?php
?>