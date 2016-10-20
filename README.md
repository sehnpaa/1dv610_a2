# Login_1DV608
Interface repository for 1DV608 assignment 2 and 4

## Development

### Sync files to server
Alternative 1: scp -r . root@188.166.62.163:/var/www/html/1dv610_a2/  
Alternative 2: rsync --delete --chown=www-data:www-data -av -e ssh /home/peter/1dv610_a2/ root@188.166.62.163:/var/www/html/1dv610_a2/

## Testing
Browse to and Run the use case tests from http://csquiz.lnu.se:82/.

## Installing
git clone this repository and give it to your web server with PHP-support.

## Run application

### A2 assignment
Browse to http://188.166.62.163/1dv610_a2/.

### A4 assignment
Browse to http://188.166.62.163/1dv610_a4/.
