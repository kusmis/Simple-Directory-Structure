Simple-Directory-Structure
==========================
Description =================

Project is a virtual, database based hierarchical directory listing build on php and mysql. 
I had a requirement for this is one of my projects, I googled it a lot but all i got was a more complex application everytime.
So i brainstormed a little and created one of my own. 
Maybe this helps somebody who is having the same problem. 

Files and locations ================

1). First things first starting with the javascript and css.
 
This application is built on backbone.js and animate.css so its very necessary to follow the order in which the files are included.
For javascript the order for the files followed is ------ 
jQuery.js
underscore.js
backbone.js
which are in the script folder 

Then for css files link the animate-custom.css after jquery files.

For other custom javascripts i am using app.js 
and for stylesheets app.css

2). Switching to php files

The main index.php file is at the root of the application directory which includes another php file partial.php located in /filesStructure/ folder.
The complete database connection and working is inside filesDb/filesDb.php.
Then the whole directory structure creation logic is inside /filesStructure/Structure.php

Sql file for the database is also include within the root directory naming files.sql 
