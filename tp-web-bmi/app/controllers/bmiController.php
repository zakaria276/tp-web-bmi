<?php
class BmiController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function calculateBmi($user_id, $name, $weight, $height) {
        // التحقق من صحة المدخلات
        $errors = [];
        if (empty($name)) $errors[] = "الاسم مطلوب";
        if (!is_numeric($weight) || $weight <= 0) $errors[] = "الوزن يجب أن يكون رقمًا موجبًا";
        if (!is_numeric($height) || $height <= 0) $errors[] = "الطول يجب أن يكون رقمًا موجبًا";

        if (!empty($errors)) {
            return ['errors' => $errors];
        }

        // حساب مؤشر كتلة الجسم
        $bmi = $weight / ($height * $height);
        $status = $this->getBmiStatus($bmi);

        // حفظ النتيجة في قاعدة البيانات
        $this->model->saveBmiRecord($user_id, $name, $weight, $height, $bmi, $status);

        return [
            'name' => $name,
            'weight' => $weight,
            'height' => $height,
            'bmi' => number_format($bmi, 2),
            'status' => $status
        ];
    }

    private function getBmiStatus($bmi) {
        if ($bmi < 18.5) return "نقص في الوزن";
        elseif ($bmi >= 18.5 && $bmi < 25) return "وزن طبيعي";
        elseif ($bmi >= 25 && $bmi < 30) return "زيادة في الوزن";
        else return "سمنة";
    }

    public function getHistory($user_id, $is_admin = false) {
        return $is_admin ? $this->model->getAllBmiHistory() : $this->model->getBmiHistory($user_id);
    }
}
?>