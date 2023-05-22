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
            <!-- question -->
            <div class="faq_question">
                عنوان سوال<input type="text" name="" id="" value="">
            </div>
            <!-- answer -->
            <div class="faq_answer">
                پاسخ سوال<input type="text" name="" id="" value="">
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
                faqs : faq_string
            },
        }).done((resp) => {
            console.log(resp);
            $('#result_text').html('<span class="green">عمليات با موفق انجام شد</span>').show();
        });
    });

});