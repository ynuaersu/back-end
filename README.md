# Back End web application 
For this application, I used PHP and Jquery and AJAX and an sqlite database.
I used PHP (no framework) for the most of the backend and JQuery/Ajax for the like/dislike so it happens without reloading the page, and I chose Sqlite database in the data.db file because it is easier and faster to implement.

## Architecture
- index.php file which manages which view to display depending on the url.
- The views folder in which I created a file for each view (sign in, sign up, nearby and prefered shops), it contains mostly the html code and a little php.
- The classes folder contains the Shop and User class
- The functions folder contains each a php file that manages login, register and likes and dislikes.
- .htaccess file to rewrite the url (for example from /index.php?url=login to /login)

## Functional specs
- Sign up using my email & password
- Sign in using my email & password
- Display the list of shops sorted by distance
- Like a shop, so it can be added to the preferred shops and liked shops aren't displayed on the main page
- Dislike a shop, so it won’t be displayed within “Nearby Shops” list during the next 2 hours
- Display the list of preferred shops
- Remove a shop from the preferred shops list
