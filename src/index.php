<?php

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    if ($name && $message) {

        $stmt = $pdo->prepare("
            INSERT INTO messages(name, message)
            VALUES (?, ?)
        ");

        $stmt->execute([$name, $message]);
    }

    header("Location: index.php");
    exit;
}

$messages = $pdo->query("
    SELECT *
    FROM messages
    ORDER BY created_at DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Моята книга за гости</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class="container">

    <h1>Книга за гости</h1>

    <form method="POST">

        <input
            type="text"
            name="name"
            placeholder="Вашето име"
            required
        >

        <textarea
            name="message"
            placeholder="Вашето съобщение"
            required
        ></textarea>

        <button type="submit">
            Изпрати
        </button>

    </form>

    <div class="messages">

        <?php foreach($messages as $msg): ?>

            <div class="message">

                <strong>
                    <?= htmlspecialchars($msg['name']) ?>
                </strong>

                <p>
                    <?= htmlspecialchars($msg['message']) ?>
                </p>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>