document.observe('dom:loaded', function() {

    switchFields($('widget_type').getValue());

    Event.observe($('widget_type'),'change', function(){
        switchFields(this.getValue());
    });

    function switchFields(val){
        var img_width  = $('image_width');
        var img_height = $('image_height');
        if(val == 1){
            img_width.removeClassName('required-entry');
            img_width.removeClassName('required-entry');
            img_width.up('tr').hide();
            img_height.up('tr').show();
        }else{
            if(val == 2){
                img_height.removeClassName('required-entry');
                img_height.removeClassName('required-entry');
                img_width.up('tr').show();
                img_height.up('tr').hide();
            }else{
                img_height.addClassName('required-entry');
                img_height.up('tr').show();
                img_width.addClassName('required-entry');
                img_width.up('tr').show();
            }

        }
    }

});
