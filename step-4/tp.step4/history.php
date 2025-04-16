<?php
// إنشاء اتصال بقاعدة البيانات
$con = new mysqli("localhost", "root", "", "bmi_clc");

// التحقق من وجود خطأ في الاتصال
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// تنفيذ الاستعلام
$query = "SELECT * FROM bmi_records ORDER BY created_at DESC";
$result = $con->query($query);

// التحقق مما إذا تم تنفيذ الاستعلام بنجاح
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . $row['weight'] . "</td>";
            echo "<td>" . $row['height'] . "</td>";
            echo "<td>" . number_format($row['bmi'], 2) . "</td>";
            echo "<td>" . $row['interpretation'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>لا توجد بيانات</td></tr>";
    }
} else {
    // طباعة الخطأ عند فشل الاستعلام
    echo "<tr><td colspan='6'>خطأ في الاستعلام: " . $con->error . "</td></tr>";
}
?>