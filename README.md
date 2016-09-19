# Login_1DV608
Interface repository for 1DV608 assignment 2 and 4

## Development

### Sync files to server
Alternative 1: scp -r . root@188.166.62.163:/var/www/html/1dv610_a2/  
Alternative 2: rsync --delete --chown=root:root -av -e ssh /home/peter/1dv610_a2/ root@188.166.62.163:/var/www/html/1dv610_a2/
