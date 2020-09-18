var server = require('http').Server();
var io = require('socket.io')(server)

var Redis = require('ioredis')
var redis = new Redis();

// redis.subscribe('test-channel')
redis.subscribe("LARAVEL_test-channel", (err, count) => {
    console.log('yes')
});
redis.on("message", (channel, message) => {
    // Receive message Hello world! from channel news
    // Receive message Hello again! from channel music
    console.log("Receive message %s from channel %s", message, channel);
});
// redis.on('message', function (ch, m){
//     console.log('msg recevied pico')
//     console.log(m)
// })

server.listen(3021)