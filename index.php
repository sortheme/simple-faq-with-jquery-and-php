<?php 
$faqs = 'quesion1^answer1|question2^answer2|question3^answer3';
require 'connection.php';
$query = "SELECT * from faqs WHERE page_id = 12";
$result = mysqli_query($con, $query);
$faqs = array();
while ($row = mysqli_fetch_array($result)){
    $faqs = $row;
    $faqs = array_map('trim', explode('|', $faqs['faqs']));
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>simple faq</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-3.70.js"></script>
    
</head>
<body>
    <div class="container">
        <div id="faqs">
            <?php 
            foreach($faqs as $faq) { 
                $faq = array_map('trim', explode('^', $faq));
            ?>
            <div class="faq_row">
                <!-- question -->
                <div class="faq_question">
                    عنوان سوال<input type="text" name="" id="" value="<?php echo($faq[0]); ?>">
                </div>
                <!-- answer -->
                <div class="faq_answer">
                    پاسخ سوال<input type="text" name="" id="" value="<?php echo($faq[1]); ?>">
                </div>
                <!-- edit buttons -->
                <div class="edit">
                    <button class="remove">-</button>
                </div>
            </div>
             <?php } ?>
        </div>
        
        <!-- new faq with jquery -->
        <div id="new_faq_wrap">
            <button id="new_faq_btn">افزودن faq جديد</button>
        </div>
        
        <!-- save faqs in database with ajax -->
        <div id="new_faq_wrap">
            <button id="faq_save_to_db">ذخيره</button>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
</body>
</html>
