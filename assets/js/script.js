jQuery('document').ready(function($){
    /**
     * add new faq
     */
    $('#new_faq_wrap').on('click', function(e){
        // get current faqs
        const faqs = $('#faqs');
        // const faqs_count = $(faqs).find('.faq_row').length;
        // const new_number = faqs_count ? parseInt(faqs_count) + 1 : 1 ;
        const new_row = `
        <div class="faq_row">
            <!-- question -->
            <div class="faq_question">
                عنوان سوال<input type="text" name="" id="">
            </div>
            <!-- answer -->
            <div class="faq_answer">
                پاسخ سوال<input type="text" name="" id="">
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
        console.log('jfs');
        $(this).closest('.faq_row').remove();
    });

});