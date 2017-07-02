/**
 * Created by Ernesto on 29/10/2016.
 */

$('#btn-save-password').click(function(){
    var form = $('#form-password');
    var url = $('#url-password').val();
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        url : url,
        data : form.serialize(),
        success : function(data){
            var time = 2000;
            console.log(data);
            if(data.error){
                swal({
                    title: "Error",
                    text: data.message,
                    type: "warning",
                    timer: time,
                    //showConfirmButton: false
                });
            }else{
                swal({
                    title: "Listo",
                    text: data.message,
                    type: "success",
                    timer: time,
                    //showConfirmButton: false
                });
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
});
$('#btn-save-profile').click(function(){
    var form = $('#form-profile');
    var url = $('#url-profile').val();
    var id = $('#profile-a02_id').val();
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        url : url+'?id='+id,
        data : form.serialize(),
        success : function(data){
            var time = 2000;
            console.log(data);
            if(data.error){
                swal({
                    title: "Error",
                    text: data.message,
                    type: "warning",
                    timer: time,
                    //showConfirmButton: false
                });
            }else{
                profile = data.profile;
                state_country = data.state_country;
                user = data.user;
                $('#complete_name').html(profile.a02_name+' '+profile.a02_flastname);
                $('#location').html(state_country.state+', '+state_country.country+'.');
                swal({
                    title: "Listo",
                    text: data.message,
                    type: "success",
                    timer: time,
                    //showConfirmButton: false
                });
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
});
