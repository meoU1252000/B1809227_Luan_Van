//show modal assign role for user
$(document).ready(function (){
    $('.assign_role').click(function (e) {
        e.preventDefault();
        
        $.ajax({
            url : $(this).attr('href'),
            type : 'GET',
            success : function (data) {
                $('#view-assign-role').html(data);
                $('#view-assign-role').modal('show');
            }
        })
    })
});
//Show model assign permissions to role
$(document).ready(function (){
    $('.assign_permission').click(function (e) {
        e.preventDefault();
        
        $.ajax({
            url : $(this).attr('href'),
            type : 'GET',
            success : function (data) {
                $('#view-assign-permission').html(data);
                $('#view-assign-permission').modal('show');
            }
        })
    })
});
