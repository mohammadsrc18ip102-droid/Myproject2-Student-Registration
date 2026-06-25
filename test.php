<?php
include_once 'lang.php';
include_once 'db.php'; // استدعاء ملف الاتصال بقاعدة البيانات

// 1. التقاط البيانات من النموذج
$student_name = htmlspecialchars(trim($_POST['student_name'] ?? ""));
$email = htmlspecialchars(trim($_POST['email'] ?? ""));
$student_number = htmlspecialchars(trim($_POST['student_number'] ?? ""));
$year = htmlspecialchars(trim($_POST['year_of_study'] ?? ""));
$batch_name = htmlspecialchars(trim($_POST['batch_name'] ?? ""));

$error_message = "";
$success_message = "";

// 2. التحقق والحفظ في قاعدة البيانات
if (!empty($student_name) && !empty($email) && !empty($student_number)) {
    try {
        // التحقق من تكرار البريد الإلكتروني
        $stmt = $pdo->prepare("SELECT id FROM students WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error_message = __('err_email');
        } else {
            // التحقق من تكرار رقم الطالب
            $stmt = $pdo->prepare("SELECT id FROM students WHERE student_number = ?");
            $stmt->execute([$student_number]);
            if ($stmt->fetch()) {
                $error_message = __('err_number');
            }
        }

        // إذا لم يكن هناك تكرار، يتم إدخال البيانات
        if (empty($error_message)) {
            $sql = "INSERT INTO students (student_name, email, student_number, year_of_study, batch_name) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_name, $email, $student_number, $year, $batch_name]);
            $success_message = __('success');
        }
    } catch (PDOException $e) {
        $error_message = "خطأ أثناء التعامل مع قاعدة البيانات: " . $e->getMessage();
    }
}

// 3. قراءة البيانات من قاعدة البيانات للعرض في الجدول
try {
    $stmt = $pdo->query("SELECT student_name, email, student_number, year_of_study, batch_name FROM students ORDER BY id DESC");
    $all_students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $all_students = [];
    $error_message = "فشل جلب البيانات: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('title_list'); ?></title>
    <link rel="stylesheet" href="test.css">
    <style>
        .lang-switcher {
            text-align: right;
            padding: 10px 20px;
            background: #f4f4f4;
            border-bottom: 1px solid #ddd;
        }
        [dir="rtl"] .lang-switcher { text-align: left; }
        .lang-switcher a {
            text-decoration: none;
            font-weight: bold;
            color: blueviolet;
            margin: 0 10px;
        }
    </style>
</head>
<body>

    <div class="lang-switcher">
        <a href="?lang=ar">العربية</a> | 
        <a href="?lang=en">English</a>
    </div>

    <div class="boding" style="display: block; padding: 20px;">
        <h2 style="text-align: center; margin-bottom: 20px;"><?php echo __('title_list'); ?></h2>

        <?php if ($error_message): ?>
            <p style="color: red; text-align: center; font-weight: bold;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p style="color: green; text-align: center; font-weight: bold;"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <table style="margin: 0 auto; border-collapse: collapse; width: 80%;">
            <thead>
                <tr>
                    <th style='padding: 10px; border: 1px solid #ddd; background: #f2f2f2;'><?php echo __('student_name'); ?></th>
                    <th style='padding: 10px; border: 1px solid #ddd; background: #f2f2f2;'><?php echo __('email'); ?></th>
                    <th style='padding: 10px; border: 1px solid #ddd; background: #f2f2f2;'><?php echo __('student_number'); ?></th>
                    <th style='padding: 10px; border: 1px solid #ddd; background: #f2f2f2;'><?php echo __('year_study'); ?></th>
                    <th style='padding: 10px; border: 1px solid #ddd; background: #f2f2f2;'><?php echo __('batch_name'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($all_students)): ?>
                    <?php foreach ($all_students as $student): ?>
                        <tr>
                            <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'><?php echo htmlspecialchars($student['student_name']); ?></td>
                            <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'><?php echo htmlspecialchars($student['email']); ?></td>
                            <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'><?php echo htmlspecialchars($student['student_number']); ?></td>
                            <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'><?php echo htmlspecialchars($student['year_of_study']); ?></td>
                            <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'><?php echo htmlspecialchars($student['batch_name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan='5' style='text-align: center; padding: 10px;'><?php echo __('no_students'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <div style="text-align: center;">
            <a href="index.php" style="color: blue; font-weight: bold; text-decoration: none;"><?php echo __('add_new'); ?></a>
        </div>
    </div>
</body>
</html>