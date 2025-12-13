<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사용자 목록</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f5f5f5; }
        .success { color: green; margin-bottom: 15px; padding: 10px; background: #e0ffe0; }
        a { color: #007bff; }
        .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; margin-bottom: 20px; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>사용자 목록</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="success">사용자가 등록되었습니다!</div>
    <?php endif; ?>

    <a href="/users/create" class="btn">+ 새 사용자 등록</a>

    <?php if (empty($users)): ?>
        <p>등록된 사용자가 없습니다.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>이름</th>
                    <th>이메일</th>
                    <th>등록일</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user->getId()) ?></td>
                        <td><?= htmlspecialchars($user->getName()) ?></td>
                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                        <td><?= htmlspecialchars($user->getCreatedAt()) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>