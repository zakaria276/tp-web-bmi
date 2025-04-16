<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتيجة مؤشر كتلة الجسم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">نتيجة مؤشر كتلة الجسم</h2>
            </div>
            <div class="card-body">
                <p class="card-text"><strong>الاسم:</strong> <?= $result['name'] ?></p>
                <p class="card-text"><strong>الوزن:</strong> <?= $result['weight'] ?> كجم</p>
                <p class="card-text"><strong>الطول:</strong> <?= $result['height'] ?> متر</p>
                <p class="card-text"><strong>مؤشر كتلة الجسم:</strong> <?= $result['bmi'] ?></p>
                <p class="card-text"><strong>الحالة:</strong> <?= $result['status'] ?></p>
            </div>
            <div class="card-footer">
                <a href="index.php" class="btn btn-primary">العودة إلى الحاسبة</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>