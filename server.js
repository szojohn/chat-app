const express = require('express');
const { createServer } = require('http');
const { Server } = require('socket.io');
const siofu = require('socketio-file-upload');
const fs = require('fs');

const app = express();
app.use(siofu.router);
const httpServer = createServer(app);
const serverIO = new Server(httpServer, {
    cors:{ origin: "*" }, //CORS=Cross-Origin Resource Sharing
    methods:["GET", "POST"]
})
app.use(express.static(__dirname + '/uploads'));

// app.get('/', (req, res) => {
//     res.sendFile(__dirname + "/public/index.php")
// })

serverIO.on('connection', (socket)=> {
    const users = [];
    console.log("Connected: " + socket.id);
    users.splice(0, users.length);
    
    // socket.on('login', (data) => {
    //     users.push(data);
    //     socket.broadcast.emit('getUsers', this.users);
    // });

    // upload file
    var uploader = new siofu();
    uploader.dir = "uploads";
    uploader.listen(socket);
    uploader.on("saved", (data) => {
        data.file.clientDetail.nameOfImage = data.file.name; 
        data.file.clientDetail.pathName = '/uploads/' + data.file.name;
    });

    uploader.on("error", function (event) {
        console.log("Error from uploader", event);
      });

    socket.on('message', (message) => {
        console.log(message);
        socket.broadcast.emit('message:received', message);
    });

    socket.on('disconnect', (socket) => {
        console.log('Disconnected: ' + socket.id);
    });
});

// check if server is running
httpServer.listen(3000, () => {
    console.log('Server is running');
})

    