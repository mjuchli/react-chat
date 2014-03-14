Message Board using Ratchet and ZeroMQ
==========

This first part of the readme is just for explaination purposes to show how to send messages directly based on Websockets using React (Ratchet).

Checkout application and create a virtualhost pointing to the /web directory: react.local 

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

---

## Demo message board including React (Ratchet) and ZeroMQ

Now lets push interactions from HTTP to Websocket using ZeroMQ. Therefore checkout the application and create a virtualhost pointing to the `/web` directory: `react.local`

Start server (on port 9090): 

```PHP
php ./bin/push-server.php
```

1. Go to message board and start writing: `http://react.local/app_dev.php/ratchet/`
2. Alternatively, and to show that those are actually POST messages (submitting a form) open a new tab/browser and go to: `http://react.local/app_dev.php/ratchet/yetAnotherForm`. 
3. Then submit a message and you'll find it on the message board as well.



