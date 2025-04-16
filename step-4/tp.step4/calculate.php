<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "bmi_clc";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من استلام البيانات
// var_dump($_POST);
if (isset($_POST['name'], $_POST['weight'], $_POST['height'])) {
    $name = htmlspecialchars($_POST['name']);
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']);

    // التحقق من صحة البيانات المدخلة
    if ($weight <= 2|| $weight > 130|| $height <= 0.8|| $height >= 3) {
        echo json_encode(["success" => false, "message" => "Invalid input values. Weight must be > 0 and <= 300, Height must be > 0 and < 3."]);
        exit;
    }

    // حساب BMI
    $bmi = $weight / ($height * $height);
    if ($bmi <18.5) {
        $interpretation = "Underweight";
    } elseif ($bmi <25 ) {
        $interpretation = "Normal weight";
    } elseif ($bmi < 30) {
        $interpretation = "Overweight";
    } else {
        $interpretation = "Obesity";
    }

    // إدخال البيانات في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO bmi_records (name, weight, height, bmi, interpretation) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sddds", $name, $weight, $height, $bmi, $interpretation);
    
    if ($stmt->execute()) {
        // استرجاع البيانات لتحديث الصفحة
        echo json_encode(["success" => true, "bmi" => $bmi, "message" => "Hello, $name. Your BMI is " . number_format($bmi, 2) . " ($interpretation)."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error saving data to database."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Data not received."]);
}

$conn->close();
?>