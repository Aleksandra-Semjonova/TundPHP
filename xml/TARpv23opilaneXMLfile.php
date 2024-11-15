<?php
// Загружаем XML файл с данными о пользователях
$users = simplexml_load_file("TARpv23opilane.xml");

if ($users === false) {
    die('Ошибка при загрузке XML файла');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        /* styleopilane.css */

        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 30px;
        }

        .user-box {
            display: inline-block;
            width: 200px; /* фиксированная ширина */
            height: 200px; /* фиксированная высота */
            margin: 10px;
            padding: 20px;
            border: 2px solid #007BFF;
            border-radius: 10px; /* скругленные углы */
            cursor: pointer;
            transition: all 0.3s;
            background-color: #f0f8ff;
            color: #007BFF;
            font-weight: bold;
            font-size: 0.8em; /* увеличенный размер шрифта */
            text-decoration: none;
            text-align: center;
            line-height: 160px; /* выравнивание текста по центру по вертикали */
            box-sizing: border-box; /* учитываем padding в размере блока */
        }

        .user-box:hover {
            background-color: #007BFF;
            color: white;
            transform: scale(1.05);
        }

    </style>
</head>
<body>

<h1>TARpv23 rühm</h1>

<?php foreach ($users as $user): ?>
    <a href="<?php echo htmlspecialchars($user->website); ?>" class="user-box">
        <?php echo htmlspecialchars($user->name); ?>
    </a>
<?php endforeach; ?>

</body>
</html>
