react-chat
==========

Demo chat application including React and ZeroMQ

Start server (on port 9090): 

```PHP
php ./bin/ratchet-server.php
```
Open Chat:

`http://react.local/app_dev.php/ratchet/`

Connect with client (for now with JavaScript directly on socket):

```JS
var conn = new WebSocket('ws://localhost:9090');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};
```

Send Message:

```
conn.send(' -type your message here- ');
```
