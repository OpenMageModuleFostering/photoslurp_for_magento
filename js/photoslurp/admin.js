document.observe('dom:loaded', function() {

    Event.observe($('widget_type'),'change', function(){
        var widget_type = this.getValue();
        switchFields(widget_type);
        switchAutoscrollLimit(widget_type);
        switchEmptyThreshold(widget_type)
    });

    Event.observe($('allow_empty'),'change', function(){
        switchAddPhotosImage(this.getValue());
    });

    Event.observe($('show_submit'),'change', function(){
        switchSubmitText(this.getValue());
    });

    Event.observe($('page_type'),'change', function(){
        switchPosition(this.getValue());
    });

    function switchSubmitText (show_submit){
        if (show_submit == 1) {
            $$('.submit_text').each(function(el) {
                el.up('tr').show();
            })
        }
        else if (show_submit == 0) {
            $$('.submit_text').each(function(el) {
                el.up('tr').hide();
            })
        }
    }

    function switchAddPhotosImage (allow_empty){
        if (allow_empty == 1) {
            $('add_photos_img').up('tr').show()
        }
        else if (allow_empty == 0) {
            $('add_photos_img').up('tr').hide()
        }
    }

    function switchFields(val){

        var img_width            = $('image_width');
        var img_height           = $('image_height');
        var varying_thumb_sizes  = $('varying_thumb_sizes');
        var auto_scroll_carousel = $('auto_scroll_carousel');
        var one_photo_per_line   = $('one_photo_per_line');

        if(val == 1){//carousel mode
            img_width.removeClassName('required-entry');
            img_width.up('tr').hide();
            if(!img_height.hasClassName('required-entry')){
                img_height.addClassName('required-entry');
            }
            img_height.up('tr').show();
            varying_thumb_sizes.up('tr').hide();
            auto_scroll_carousel.up('tr').show();
            one_photo_per_line.up('tr').hide();
        }else{
            if(!img_width.hasClassName('required-entry')){
                img_width.addClassName('required-entry');
            }
            img_width.up('tr').show();
            img_height.removeClassName('required-entry');
            img_height.up('tr').hide();
            varying_thumb_sizes.up('tr').show();
            auto_scroll_carousel.up('tr').hide();
            one_photo_per_line.up('tr').show();
        }
    }

    function switchPosition(val){
        if(val == 2){
            $('position').up('tr').show()
        }else{
            $('position').up('tr').hide()
        }
    }

    function switchAutoscrollLimit (widget_type){
        if (widget_type == 2) {//type gallery
            $('autoscroll_limit').up('tr').show()
        }
        else {
            $('autoscroll_limit').up('tr').hide()
        }
    }

    function switchEmptyThreshold (widget_type){
        var empty_threshold_el = $('empty_threshold');
        if (widget_type == 1) {//type gallery
            empty_threshold_el.up('tr').show()
        }
        else {
            empty_threshold_el.setValue(0);
            empty_threshold_el.up('tr').hide()
        }
    }

    switchFields($('widget_type').getValue());
    switchAddPhotosImage($('allow_empty').getValue());
    switchSubmitText($('show_submit').getValue());
    switchPosition($('page_type').getValue());
    switchAutoscrollLimit ($('widget_type').getValue());
    switchEmptyThreshold ($('widget_type').getValue())

});
