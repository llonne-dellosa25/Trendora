
const express = require('express');
const cors = require('cors');
const app = express();
app.use(cors());
app.use(express.json());
 
const mysql = require('mysql2');

// MySQL connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'trendora'
});

// Connect to DB
db.connect(err => {
    if (err) {
        console.error('Database connection failed: ', err);
        return;
    }
    console.log('Connected to MySQL database.');
});

app.get('/', (req, res) => {
    res.send('Server is running...');
});
 
app.listen(5000, () => {
    console.log('Server running on port 5000'); 
});
