<?php
session_start();
require '../config/database.php';
require '../app/models/BmiModel.php';
require '../app/models/UserModel.php';
require '../app/controllers/BmiController.php';
require '../app/controllers/AuthController.php';

$userModel = new UserModel($db);
$authController = new AuthController($userModel);
$model = new BmiModel($db);
$controller = new BmiController($model);

// معالجة طلبات المصادقة
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($authController->login($_POST['username'], $_POST['password'])) {
                    header("Location: index.php");
                    exit;
                } else {
                    $authError = "اسم المستخدم أو كلمة المرور غير صحيحة";
                }
            }
            require '../app/views/auth/login.php';
            exit;
            
        case 'logout':
            $authController->logout();
            header("Location: index.php");
            exit;
            
        case 'register':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($authController->register($_POST['username'], $_POST['password'])) {
                    header("Location: index.php?action=login");
                    exit;
                } else {
                    $registerError = "فشل في التسجيل. قد يكون اسم المستخدم موجودًا مسبقًا.";
                }
            }
            require '../app/views/auth/register.php';
            exit;
    }
}

// إذا لم يكن المستخدم مسجل الدخول، قم بتوجيهه إلى صفحة تسجيل الدخول
if (!$authController->isLoggedIn()) {
    header("Location: index.php?action=login");
    exit;
}

// معالجة طلبات حاسبة BMI
$errors = [];
$result = null;
$history = $controller->getHistory($_SESSION['user_id'], $authController->isAdmin());

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = $_POST['name'] ?? '';
    $weight = $_POST['weight'] ?? 0;
    $height = $_POST['height'] ?? 0;
    
    $response = $controller->calculateBmi($_SESSION['user_id'], $name, $weight, $height);
    
    if (isset($response['errors'])) {
        $errors = $response['errors'];
    } else {
        $result = $response;
        $history = $controller->getHistory($_SESSION['user_id'], $authController->isAdmin());
    }
}

require '../app/views/bmi_form.php';
?>