<?php 
// $faqs = 'quesion1^answer1|question2^answer2|question3^answer3';
/**
 * get  page_id
 */
$page_id='';
if(isset($_GET['page_id'])){
    $page_id = intval($_GET['page_id']);
}
require 'connection.php';
$query = "SELECT * from faqs WHERE page_id = '$page_id'";
$result = mysqli_query($con, $query);
$faqs = array();
while ($row = mysqli_fetch_array($result)){
    $faqs = $row;
    $faqs = array_map('trim', explode('|', $faqs['faqs']));
}
// echo('<pre style=direction:ltr;text-align:left>');var_dump($faqs);echo('</pre>');
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
            if(!empty($faqs)) :
            $faq_index =1;
            foreach($faqs as $faq) { 
                $faq = array_map('trim', explode('^', $faq));
            ?>
            <div class="faq_row">
                <!-- index number -->
                <div class="faq_index"><?php echo ($faq_index); ?></div>
                <!-- Question and Answer -->
                <div class="faq_question_answer">
                    <!-- question -->
                    <div class="faq_question">
                        <input type="text"  value="<?php echo($faq[0]); ?>" placeholder="Question">
                    </div>
                    <!-- answer -->
                    <div class="faq_answer">
                        <input type="text"  value="<?php echo($faq[1]); ?>" placeholder="Answer">
                    </div>
                </div>
                <!-- edit buttons -->
                <div class="edit">
                    <button class="remove">-</button>
                </div>
            </div>
             <?php
               $faq_index++;
             }
            endif;
            ?>
        </div>
        
        <!-- new faq with jquery -->
        <div id="new_faq_wrap">
            <button id="new_faq_btn">
                <?php if(!empty($faqs)){?>
                    + add another FAQ
                <?php }else{?>
                    + add new FAQ
                <?php }?>
            </button>
        </div>

        <div id="faq_page_id">
            <input type="text" name="page_id" id="page_id" placeholder="Page ID" value="<?php echo $page_id; ?>"><br>
        </div>
        
        <!-- save faqs in database with ajax -->
        <div id="save_faq_wrap">
            <button id="faq_save_to_db">SAVE</button>
            <p id="result_text"></p>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
</body>
</html>
