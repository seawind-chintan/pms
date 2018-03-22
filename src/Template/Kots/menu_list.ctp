<?php
echo $this->Form->input('kot_items.restaurant_menu_id', ['options' => $menulist, 'empty' => 'Select Item','onChange'=>'getmenu_price(this.value)']);
?>
<script type="text/javascript">
function getmenu_price(id)
{

    $('#kot-items-rate').parent().attr('id', "price_div")

    if(id!='')
    {
        $.ajax({
                url: "<?php echo DEFAULT_URL?>kots/ajax_menu_price/"+id,
                type: "POST",
                success: function(data)
                {
    //              alert(data);
                    $('#price_div').html(data);

                    if($('#kot-items-qty').val()!='')
                    {
                         cal_item_price();
                    }
                }
            });
    }
}
</script>