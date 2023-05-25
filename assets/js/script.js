jQuery('document').ready(function($){
    const faqs = $('#faqs');
    /**
     * add new faq
     */
    $('#new_faq_wrap').on('click', function(e){
        
        // const faqs_count = $(faqs).find('.faq_row').length;
        // const new_number = faqs_count ? parseInt(faqs_count) + 1 : 1 ;
        const new_row = `
         <div class="faq_row">
            <!-- index number -->
            <div class="faq_index">##</div>
            <!-- Question and Answer -->
            <div class="faq_question_answer">
                <!-- question -->
                <div class="faq_question">
                    <input type="text" placeholder="Question">
                </div>
                <!-- answer -->
                <div class="faq_answer">
                    <input type="text" placeholder="Answer">
                </div>
            </div>
            <!-- edit buttons -->
            <div class="edit">
                <button class="remove">-</button>
            </div>
        </div>
        `;
        $(faqs).append(new_row);
    });

    /**
     * remove current faq
     */
    $('body').on('click', '.remove', function(e){
        $(this).closest('.faq_row').remove();
    });

    /**
     * ajax call
     */
    $('#faq_save_to_db').click(function(e){
        let faq_string = '';
        let faq_rows = $(faqs).find('.faq_row');
        const page_id = $('#page_id').val() ? $('#page_id').val() : 0;
        $.each($(faq_rows), function(index, faq){
            let q = $(faq).find('.faq_question input').val();
            let v = $(faq).find('.faq_answer input').val();
            if(!q && !v){
                return;
            }
            faq_string += q + '^' + v;
            if(index < faq_rows.length - 1){
                faq_string += '|';
            }
        }); 
        $.ajax({
            url: 'ajax.php',
            type: 'post',
            data: {
                faqs : faq_string,
                page_id: page_id
            },
        }).done((resp) => {
            console.log(resp);
            if(resp == 'page_id_error'){
                $('#result_text').html('<span class="red">error in page ID</span>').show();
            }else{
                $('#result_text').html('<span class="green">operation was successful. please wait...</span>').show();
            }
            setTimeout(()=>{
                //location.reload();
                window.location.href = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page_id='+ page_id;
            }, 700);
        });
    });

});