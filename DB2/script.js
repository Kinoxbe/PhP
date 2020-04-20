//ajouter un log dans la console
//console.log('2 : coucou console');

//JQUERY = Librairies = boite a outils

$(document).ready(function () {
    $('.save,.cancel,.editableNameStyle,.editablePriceStyle,.editableQuantityStyle').hide();
    console.log('1 : JQUERY READY');
    var state = 0;

    $('#manager-btn').click(function() {
        console.log('BUTTON CLICK');
        if( $('#manager-btn').text()=='USER MANAGER')
            {
                $('#manager-btn').text("PRODUCT MANAGER");
                $('#table-list').hide();
                $('#user-list').show();
                $('#createproduct').hide();
                $('#createuser').show();
                $('#ajax-rsp').hide();
            }
        else
            {
                $('#manager-btn').text("USER MANAGER");
                $('#table-list').show();
                $('#user-list').hide();
                $('#createproduct').show();
                $('#createuser').hide();
                $('#ajax-rsp').show();
            }
    });

    // $('#manager-btn').click(function(){
    //     if (state===0)state=1;
    //     else state=0;
    //     $.post('ajax.php' , {state:state}
    //     )
    //         .done(function(data) {
    //             console.log(data);
    //             $('#ajax-rsp').html(data);
    //         })
    // });


    $('#search-form').on('submit', function(event){
        console.log('test');
        event.preventDefault();
        $.get('ajax.php' , {pk:$('#pk-search').val()}
        )
            .done(function(data) {
                $('#ajax-rsp').html(data);
            })
    });


    $('.editValues').on('click',function (event) {
        event.preventDefault();
        $(this).hide();
        $(this).closest('tr').find('.save').show();
        $(this).closest('tr').find('.cancel').show();

        $(this).parents('tr').find('.editablename').hide();
        $($(this).parents('tr').find('.editableNameStyle')).val($(this).parents('tr').find('.editablename').text());
        $(this).parents('tr').find('.editableNameStyle').show(); //{

        $(this).parents('tr').find('.editableprice').hide();
        $($(this).parents('tr').find('.editablePriceStyle')).val($(this).parents('tr').find('.editableprice').text());
        $(this).parents('tr').find('.editablePriceStyle').show(); //{

        $(this).parents('tr').find('.editablequantity').hide();
        $($(this).parents('tr').find('.editableQuantityStyle')).val($(this).parents('tr').find('.editablequantity').text());
        $(this).parents('tr').find('.editableQuantityStyle').show(); //{

        $(this).parents('tr').find('.editablevat').hide();
        $($(this).parents('tr').find('.editablevatStyle')).val($(this).parents('tr').find('.editablevat').text());
        $(this).parents('tr').find('.editablevatStyle').show(); //{

        });


    $('.cancel').on('click',function (event) {
        event.preventDefault();
        $(this).hide();
        $(this).closest('tr').find('.save').hide();
        $(this).closest('tr').find('.editValues').show();

        $(this).parents('tr').find('.editablename').show();
        $(this).parents('tr').find('.editableNameStyle').hide(); //{

        $(this).parents('tr').find('.editableprice').show();
        $(this).parents('tr').find('.editablePriceStyle').hide(); //{

        $(this).parents('tr').find('.editablequantity').show();
        $(this).parents('tr').find('.editableQuantityStyle').hide(); //{

        $(this).parents('tr').find('.editablevat').show();
        $(this).parents('tr').find('.editablevatStyle').hide(); //{


    });

});
