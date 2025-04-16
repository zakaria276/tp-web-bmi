<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حاسبة مؤشر كتلة الجسم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php if (!empty($history)): ?>
    <div class="mt-5">
        <h2 class="text-center">تطور مؤشر كتلة الجسم</h2>
        <canvas id="bmiChart"></canvas>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('bmiChart').getContext('2d');
        const dates = <?= json_encode(array_column($history, 'timestamp')) ?>;
        const bmiValues = <?= json_encode(array_column($history, 'bmi')) ?>;
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'مؤشر كتلة الجسم',
                    data: bmiValues,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>
<?php endif; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">حاسبة مؤشر كتلة الجسم</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="weight" class="form-label">الوزن (كجم)</label>
                <input type="number" step="0.01" class="form-control" id="weight" name="weight" required>
            </div>
            <div class="col-md-6">
                <label for="height" class="form-label">الطول (متر)</label>
                <input type="number" step="0.01" class="form-control" id="height" name="height" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">حساب</button>
            </div>
        </form>
        
        <?php if (isset($result)): ?>
            <div class="mt-5">
                <h2 class="text-center">النتيجة</h2>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text"><strong>الاسم:</strong> <?= $result['name'] ?></p>
                        <p class="card-text"><strong>الوزن:</strong> <?= $result['weight'] ?> كجم</p>
                        <p class="card-text"><strong>الطول:</strong> <?= $result['height'] ?> متر</p>
                        <p class="card-text"><strong>مؤشر كتلة الجسم:</strong> <?= $result['bmi'] ?></p>
                        <p class="card-text"><strong>الحالة:</strong> <?= $result['status'] ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- عرض السجل التاريخي -->
        <?php if (!empty($history)): ?>
            <div class="mt-5">
                <h2 class="text-center">السجل التاريخي</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>الاسم</th>
                            <th>الوزن</th>
                            <th>الطول</th>
                            <th>م.ك.ج</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($history as $record): ?>
                            <tr>
                                <td><?= $record['timestamp'] ?></td>
                                <td><?= $record['name'] ?></td>
                                <td><?= $record['weight'] ?></td>
                                <td><?= $record['height'] ?></td>
                                <td><?= number_format($record['bmi'], 2) ?></td>
                                <td><?= $record['status'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>