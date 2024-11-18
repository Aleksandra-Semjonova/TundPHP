<?php
if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>

<?php

// Загрузка XML файла с пользователями
$xmlFile = "TARpv23opilane.xml";
$users = simplexml_load_file($xmlFile);

if ($users === false) {
    die('Ошибка при загрузке XML файла');
}

// Filtreeri hobi järgi
$selectedHobby = isset($_POST['hobby']) ? $_POST['hobby'] : '';

// Обработка формы добавления нового пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $name = htmlspecialchars($_POST['name']);
    $hobby = htmlspecialchars($_POST['hobby']);
    $gender = htmlspecialchars($_POST['gender']);

    // Uue kasutaja lisamine XML-is
    $newUser = $users->addChild('user');
    $newUser->addChild('name', $name);
    $newUser->addChild('hobby', $hobby);
    $newUser->addChild('gender', $gender);

    // Сохранение изменений
    $users->asXML($xmlFile);

    // Перезагрузка страницы, чтобы отобразить нового пользователя
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Обработка удаления пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $deleteName = htmlspecialchars($_POST['delete_name']);

    // Поиск и удаление пользователя
    foreach ($users->user as $user) {
        if ((string)$user->name === $deleteName) {
            $dom = dom_import_simplexml($user);
            $dom->parentNode->removeChild($dom);
            break;
        }
    }

    // Сохранение изменений в XML
    $users->asXML($xmlFile);

    // Перезагрузка страницы, чтобы отобразить изменения
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="styleoplinae.css">
</head>
<body>

<h1>TARpv23 rühm</h1>

<!-- Форма для фильтрации по хобби -->
<div class="filter-form">
    <form method="post" action="">
        <label for="hobby">Valige hobi:</label>
        <select name="hobby" id="hobby">
            <option value="">Kõik hobid</option>
            <option value="Fotograafia" <?php echo ($selectedHobby == 'Fotograafia') ? 'selected' : ''; ?>>Fotograafia</option>
            <option value="Jalgrattasõit" <?php echo ($selectedHobby == 'Jalgrattasõit') ? 'selected' : ''; ?>>Jalgrattasõit</option>
            <option value="Lugemine" <?php echo ($selectedHobby == 'Lugemine') ? 'selected' : ''; ?>>Lugemine</option>
            <option value="Muusika" <?php echo ($selectedHobby == 'Muusika') ? 'selected' : ''; ?>>Muusika</option>
            <option value="Jooga" <?php echo ($selectedHobby == 'Jooga') ? 'selected' : ''; ?>>Jooga</option>
            <option value="Videomängud" <?php echo ($selectedHobby == 'Videomängud') ? 'selected' : ''; ?>>Videomängud</option>
            <option value="Programmeerimine" <?php echo ($selectedHobby == 'Programmeerimine') ? 'selected' : ''; ?>>Programmeerimine</option>
            <option value="Jooksmine" <?php echo ($selectedHobby == 'Jooksmine') ? 'selected' : ''; ?>>Jooksmine</option>
        </select>
        <input type="submit" value="Filter">
    </form>
</div>

<!-- Форма для добавления нового пользователя -->
<div class="add-user-form">
    <h2>Lisa uus kasutaja</h2>
    <form method="post" action="">
        <table>
            <tr>
                <th><label for="name">Nimi:</label></th>
                <td><input type="text" name="name" id="name" required></td>
            </tr>
            <tr>
                <th><label for="hobby">Hobi:</label></th>
                <td>
                    <select name="hobby" id="hobby" required>
                        <option value="Fotograafia">Fotograafia</option>
                        <option value="Jalgrattasõit">Jalgrattasõit</option>
                        <option value="Lugemine">Lugemine</option>
                        <option value="Muusika">Muusika</option>
                        <option value="Jooga">Jooga</option>
                        <option value="Videomängud">Videomängud</option>
                        <option value="Programmeerimine">Programmeerimine</option>
                        <option value="Jooksmine">Jooksmine</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="gender">Sugu:</label></th>
                <td>
                    <select name="gender" id="gender" required>
                        <option value="Mees">Mees</option>
                        <option value="Naine">Naine</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="hidden" name="add_user" value="1">
        <input type="submit" value="Lisa">
    </form>
</div>

<!-- Форма для удаления пользователя -->
<div class="delete-user-form">
    <h2>Kustuta kasutaja</h2>
    <form method="post" action="">
        <label for="delete_name">Kasutaja nimi:</label>
        <select name="delete_name" id="delete_name" required>
            <option value="">Valige kasutaja</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user->name); ?>"><?php echo htmlspecialchars($user->name); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="delete_user" value="1">
        <input type="submit" value="Kustuta">
    </form>
</div>

<?php
foreach ($users as $user) {
    if ($selectedHobby == '' || $user->hobby == $selectedHobby) {
        $gender = htmlspecialchars($user->gender); // Добавляем пол
        echo '<a href="' . htmlspecialchars($user->website) . '" class="user-box" data-gender="' . $gender . '">';
        echo htmlspecialchars($user->name);
        echo '</a>';
    }
}
?>

</body>
</html>
