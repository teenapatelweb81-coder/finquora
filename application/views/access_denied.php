<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title : 'Access Denied'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #4b79a1, #283e51);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .card {
            width: 90%;
            max-width: 550px;
            background: rgba(255, 255, 255, 0.12);
            padding: 40px;
            border-radius: 16px;
            backdrop-filter: blur(14px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.25);
            text-align: center;
            color: #fff;
        }

        .icon {
            font-size: 70px;
            margin-bottom: 15px;
            color: #ff6b6b;
            text-shadow: 0 4px 15px rgba(255,0,0,0.4);
        }

        h1 {
            font-size: 32px;
            margin: 0 0 10px;
            font-weight: bold;
        }

        p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon">⛔</div>
        <h1>Access Denied</h1>

        <p>
            <?php echo isset($message) ? $message : 
            'The website you are trying to access is currently unavailable or not authorized for use.'; ?>
        </p>

    </div>
</body>
</html>
