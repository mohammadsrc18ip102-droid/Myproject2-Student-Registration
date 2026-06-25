<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// التحقق مما إذا كان المستخدم قد ضغط على رابط تغيير اللغة
if (isset($_GET['lang'])) {
    if ($_GET['lang'] == 'en' || $_GET['lang'] == 'ar') {
        $_SESSION['lang'] = $_GET['lang'];
    }
    // إعادة توجيه لتنظيف الرابط من المتغيرات (Query String)
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]";
    header("Location: " . $actual_link);
    exit();
}

// اللغة الافتراضية هي العربية
$lang = $_SESSION['lang'] ?? 'ar';
$dir = ($lang === 'ar') ? 'rtl' : 'ltr';

// مصفوفة الترجمة
$lang_data = [
    'ar' => [
        'title_reg' => 'تسجيل طالب جديد',
        'student_name' => 'اسم الطالب',
        'email' => 'البريد الإلكتروني',
        'student_number' => 'رقم الطالب',
        'year_study' => 'سنة الدراسة',
        'batch_name' => 'اسم الدفعة',
        'submit' => 'إرسال',
        'title_list' => 'قائمة الطلاب المسجلين',
        'err_email' => 'خطأ: البريد الإلكتروني مسجل مسبقاً!',
        'err_number' => 'خطأ: رقم الطالب مسجل مسبقاً!',
        'success' => 'تم تسجيل الطالب بنجاح.',
        'no_students' => 'لا يوجد طلاب مسجلين حالياً',
        'add_new' => 'إضافة طالب جديد'
    ],
    'en' => [
        'title_reg' => 'New Student Registration',
        'student_name' => 'Student Name',
        'email' => 'Email Address',
        'student_number' => 'Student Number',
        'year_study' => 'Year of Study',
        'batch_name' => 'Batch Name',
        'submit' => 'Submit',
        'title_list' => 'Registered Students List',
        'err_email' => 'Error: Email is already registered!',
        'err_number' => 'Error: Student Number is already registered!',
        'success' => 'Student registered successfully.',
        'no_students' => 'No students registered currently',
        'add_new' => 'Add New Student'
    ]
];

// دالة مساعدة لطباعة النصوص المترجمة بسهولة
function __($key) {
    global $lang_data, $lang;
    return $lang_data[$lang][$key] ?? $key;
}
?>