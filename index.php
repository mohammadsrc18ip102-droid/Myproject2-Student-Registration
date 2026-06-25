<?php include_once 'lang.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('title_reg'); ?></title>
    <link rel="stylesheet" href="index1.css">
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

    <center>
        <div class="heading" style=" padding: 10px 0; margin-top: 20px;"> 
            <h1 ><?php echo __('title_reg'); ?></h1>
        </div>
        
        <form action="test.php" method="POST" class="heading">
            <div class="header">
                <div class="student-name fr">
                    <label><?php echo __('student_name'); ?></label>
                    <input type="text" name="student_name" placeholder="<?php echo __('student_name'); ?>" id="student-name" required>
                </div>
                <div class="email-address fr">
                    <label><?php echo __('email'); ?></label>
                    <input type="email" name="email" placeholder="<?php echo __('email'); ?>" id="email" required>
                </div>
                <div class="student-number fr">
                    <label><?php echo __('student_number'); ?></label>
                    <input type="text" name="student_number" placeholder="<?php echo __('student_number'); ?>" id="student-number" required>
                </div>
                <div class="Year-study fr">
                    <label><?php echo __('year_study'); ?></label>
                    <input type="date" name="year_of_study" id="Year" required>
                </div>
                <div class="batch-name fr">
                    <label><?php echo __('batch_name'); ?></label>
                    <input type="text" name="batch_name" placeholder="<?php echo __('batch_name'); ?>" id="batch-name" required>
                </div>
                <div class="sbmit">
                    <input type="submit" value="<?php echo __('submit'); ?>">
                </div>
            </div>
        </form>
    </center>
</body>
</html>