# Database Config
Set up a MySQL database (InnoDB) with the following configuration.
MariaDB was used as the development MySQL implementation. It was chosen for 
widespread community adoption, documentation, and is open source. 

    CREATE DATABASE cmaps;
    GRANT ALL PRIVILEGES ON cmaps.* TO 'cmapsproject'@'%' IDENTIFIED BY 'somepassword' WITH GRANT OPTION;

Note that the database username and password are configured within the 
cmaps_cfg.ini file included with the codebase.
Once the (still empty) database is configured locally, configure WAN access to 
allow remote webserver connections.

## Configure DB WAN access

 * Set up the database server with a static local IP
 * configure MySQL to use port 3306 (this should be the default setting in MariaDB)
 * do port forwarding on your router to forward 3306 to your database server
 * create a free domain using DuckDNS.org. use the following bash script 
   executed with a cron job to point your domain to your database server

```bash
    #! /bin/bash
    duckdns_domain="NEWDOMAIN.duckdns.org"
    duckdns_token="YOURTOKENHERE"               # view DuckDNS website on how to get your token
    duckdns_msg="Updating IP"
    duckdns_url="https://www.duckdns.org/update?domains=${duckdns_domain}&token=${duckdns_token}&txt=${duckdns_msg}&verbose=true&ip="
    /bin/echo url="${duckdns_url}" | /bin/curl -k -o /home/matt/ddns/duck.log -K -
```

 * the cron entry itself (you will need to update the path to your script accordingly):
```
*/5 * * * * /home/matt/ddns/ddns.sh >/dev/null 2>&1
```
## Upload SQL Data to the database
Once the database server is running and can be accessed from WAN, upload the
SQL data to the database. the importSqlFile php script is included in the 
codebase for this purpose. Ensure all paths in debug.php point to valid
locations, then simply load debug.php in your browser to call importSqlFile and 
populate the database automatically

