# LibreAtlas
## What is this?

An Atlas for LibreHealth's active services around the world.

It has a public map showing all enabled markers. There is also a dashboard allowing the control of API-keys and markers for admin.

## Installation

### Requirements:

- Apache
- MySQL
- PHP 7

or

- WAMP


### Installing...

1. `cd /var/www` or `cd C:\wamp64\www` or equivalent (just get into apache's public html foler)
2. `git clone https://github.com/MigDinny/LibreAtlas.git`
3. Open `settings.php` and set the variables according to your needs:

```
$appfolder = 'LibreAtlas'; // the app folder. the default is LibreAtlas
$appname = 'LibreAtlas'; // this is the app's name and it will be shown all across the app
$maps_api_key = ''; // get your maps API Key at https://developers.google.com/maps/documentation/javascript/adding-a-google-map#key
$username = 'root'; // database credentials - mysql for default is root
$password = ''; // mysql for default is root or empty string
$databaseName = 'libreatlas'; // database name for default is libreatlas
$dashboardUsername = 'admin'; // credentials to be used on dashboard. use your own
$dashboardPassword = 'admin'; // it's advisable to change this to your own password

```

4. Access http://localhost/LibreAtlas or http://localhost/libreatlas (depending on Case Sensitive settings of apache) or equivalent
5. Access http://localhost/LibreAtlas/?area=dashboard to get into the dashboard area

Any questions, create an issue or contact me.

## REST-API

Check `API.md` to understand how to use this REST-API.

## Contribution

Create issues if you detect any problem or any error. Create a pull request if you wish to make any change to the project.

Feel free to do it!
