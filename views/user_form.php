<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사용자 등록</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; box-sizing: border-box; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 15px; padding: 10px; background: #ffe0e0; }
        a { color: #007bff; }
    </style>
</head>
<body>
    <h1>사용자 등록</h1>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="/users">
        <div class="form-group">
            <label for="name">이름</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="email">이메일</label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '') ?>" required>
        </div>

        <button type="submit">등록</button>
    </form>

    <?php unset($_SESSION['old']); ?>

    <p><a href="/users">← 목록으로</a></p>
</body>
</html>