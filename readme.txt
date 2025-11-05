Post Author Filter

This is a simple, lightweight WordPress plugin that adds an author filter to the admin dashboard for posts and pages. 

Here's what it does:

Features:
---------
* Adds a dropdown filter showing "All Authors" and a list of all site authors
* Works on both Posts and Pages admin screens
* Filters the list when you select an author from the dropdown
* Only shows users who have author capabilities
* Authors are sorted alphabetically by display name

Installation:
-------------
Save the code as admin-author-filter.php
Create a folder named post-author-filter in your /wp-content/plugins/ directory
Place the PHP file in that folder
Go to WordPress Admin → Plugins and activate "Post Author Filter"

Usage:
------
Once activated, navigate to Posts or Pages in your WordPress admin. You'll see a new "All Authors" dropdown above the list. Select any author to filter the posts/pages by that author.

The plugin uses the following WordPress hooks:
* restrict_manage_posts - adds the filter dropdown
* parse_query - modifies the query to filter by the selected author


Resources:
----------
https://github.com/leetampkins/post-author-filter
https://developer.wordpress.org/plugins/hooks/filters


