<?php
echo $this->Form->input('waterpark_kot_items.restaurant_menu_id', ['options' => $menulist, 'empty' => 'Select Item','onChange'=>'getmenu_price(this.value)']);
?>
<script type="text/javascript">
function getmenu_price(id)
{

    $('#waterpark-kot-items-rate').parent().attr('id', "price_div")

    if(id!='')
    {
        $.ajax({
                url: "<?php echo DEFAULT_URL?>waterpark-kots/ajax_menu_price/"+id,
                type: "POST",
                success: function(data)
                {
    //              alert(data);
                    $('#price_div').html(data);

                    if($('#waterpark-kot-items-qty').val()!='')
                    {
                         cal_item_price();
                    }
                }
            });
    }
}
</script>