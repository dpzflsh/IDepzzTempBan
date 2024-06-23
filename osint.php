<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSINT CHECKER BY IDepzz4You</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            text-align: center;
            background: white;
            padding: 3em 2em;
            border-radius: 10px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }
        input[type="text"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 1.5em;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        button {
            padding: 15px 30px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        button:hover {
            background-color: #218838;
        }
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 80px;
            height: 80px;
            animation: spin 2s linear infinite;
            margin: 20px auto;
            display: none;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .message {
            margin-top: 1em;
            font-size: 1em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>OSINT CHECKER</h1>
        <h5>Dev : @PresidentSoekarno ( IDepzz4You )</h5>
        <input type="text" id="query" placeholder="Masukkan query...">
        <button onclick="cekOsint()">CHECK</button>
        <div id="loader" class="loader"></div>
        <div id="message" class="message"></div>
    </div>

    <script>
        async function cekOsint() {
            const query = document.getElementById('query').value;
            const loader = document.getElementById('loader');
            const message = document.getElementById('message');

            if (!query) {
                alert('Masukkan query.');
                return;
            }

            const data = {
                token: "6518510029:PorzFSdO",
                request: query,
                limit: 1000,
                lang: "id"
            };

            loader.style.display = 'block';
            message.innerText = '';
            try {
                const response = await fetch('https://server.leakosint.com/', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    const result = await response.json();
                    localStorage.setItem('osintResult', JSON.stringify(result, null, 4));
                    window.location.href = 'result.html';
                } else {
                    message.innerText = `Permintaan gagal dengan status code: ${response.status}`;
                }
            } catch (error) {
                message.innerText = 'Terjadi kesalahan saat memproses permintaan.';
                console.error('Error:', error);
            } finally {
                loader.style.display = 'none';
            }
        }
    </script>
</body>
</html>
