const http = require('http');
// using environment variable PORT or default to 3000
const port = process.env.PORT || 9000;
const server = http.createServer((req, res) => {
    // adding port information to the response
    res.writeHead(200, { 'Content-Type': 'text/plain' });
    res.end(`Hello, Geek! Server is running on port ${port}`);
});
server.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});