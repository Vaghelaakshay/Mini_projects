<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Generating QR Codes </h1>
    
    <form method="post" action="generate.php">
        <label for="gr">name of your QR code</label>
        <input type="text" name="qr" id="">
        <label for="text">Text</label>
        <textarea id="text" name="text"></textarea>
        <button>Generate</button>
       
    </form>
</body>
</html>