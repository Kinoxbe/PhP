//ajouter un log dans la console
//console.log('2 : coucou console');

//JQUERY = Librairies = boite a outils

$(document).ready(function () {
    console.log('1 : JQUERY READY');
    // var state = 0;
    base_url = 'http://localhost/mybuilding/';

    $('#register-btn').click(function() {
        console.log('BUTTON CLICK');
        $(this).hide();
        $('#log-form').hide();
        $('#reg-form').show();
    })

    //Form Connection
    $('#log-form').submit(function(event){
        event.preventDefault();
        console.log(base_url+'connect');
        $.post (base_url+'connect', {
            username : $('#log-uname').val(),
            password : $("#log-pwd").val()
            }
         )
            .done(function(datarsp) {
                console.log($('#log-uname'));
                console.log($('#log-pwd'));
                console.log(datarsp)
                datarsp = JSON.parse(datarsp);

                if (datarsp.connection && datarsp.role === "1") {
                    window.location = base_url + "user/syndic";
                } else if (datarsp.connection && datarsp.role === "2") {
                    window.location = base_url + "user/resident"; }
                  else if (!datarsp.connection){
                      window.location = base_url;
                      alert('Login/Password Fail')
                }
            })
    });

    //BUTTON

    $('#LOGOFF-btn').click(function(){
        window.location = base_url + "connect/disconnect"
    })

    $('#SynBuild-btn').click(function(){
        window.location = base_url + "building/syndic"
    })

    $('#SynCom-btn').click(function(){
        window.location = base_url + "communication/syndic"
    })

    $('#SynUser-btn').click(function(){
        window.location = base_url + "user/syndic"
    })

    $('#ResBuild-btn').click(function(){
        window.location = base_url + "building/resident"
    })

    $('#ResCom-btn').click(function(){
        window.location = base_url + "communication/resident"
    })

    $('#ResUser-btn').click(function(){
        window.location = base_url + "user/resident"
    })

    //Building

    $('.buildsave').on('click',function (event) {

        event.preventDefault();
        $(this).hide();
        $(this).closest('tr').find('.buildsavesave').hide();
        $(this).closest('tr').find('.cancel').hide();
        $(this).closest('tr').find('.editValues').show();

        //Building
        $(this).parents('tr').find('.editablebuildname').show();
        $(this).parents('tr').find('.editableBuildNameStyle').hide();
        var build_name = $(this).parents('tr').find('.editableBuildNameStyle').val();

        $(this).parents('tr').find('.editablebuildadress').show();
        $(this).parents('tr').find('.editableBuildAdressStyle').hide();
        var build_adress = $(this).parents('tr').find('.editableBuildAdressStyle').val();

        var buildpk = $(this).parents('tr').find('.editbuildpk').text();
        var CSRF = $(this).parents('tr').find('.CSRF').val();

        $.ajax({
            url: base_url + 'Views/templates/ajax.php',
            type: 'post',
            data: {
                editbuildpk: buildpk,
                building_name: build_name,
                adress: build_adress,
                CSRF: CSRF,
            },

            success: function (data) {
                console.log("Updated success");
                console.log(data);
            }
        })

    });

    //Communication
    $('.comsave').on('click',function (event) {

        event.preventDefault();
        $(this).hide();
        $(this).closest('tr').find('.comsave').hide();
        $(this).closest('tr').find('.cancel').hide();
        $(this).closest('tr').find('.editValues').show();

        $(this).parents('tr').find('.editablecomname').show();
        $(this).parents('tr').find('.editableComNameStyle').hide();
        var communication = $(this).parents('tr').find('.editableComNameStyle').val();

        var editcompk = $(this).parents('tr').find('.editcompk').text();
        var CSRF = $(this).parents('tr').find('.CSRF').val();


        $.ajax({
            url: base_url + 'Views/templates/ajax.php',
            type: 'post',
            data: {
                editcompk: editcompk,
                communication : communication,
                CSRF: CSRF,
            },

            success: function (data) {
                console.log("Updated success");
                console.log(data);
            }
        })

    });

    //User

    $('.usersave').on('click',function (event) {

        event.preventDefault();
        $(this).hide();
        $(this).closest('tr').find('.usersave').hide();
        $(this).closest('tr').find('.cancel').hide();
        $(this).closest('tr').find('.editValues').show();

        $(this).parents('tr').find('.editablename').show();
        $(this).parents('tr').find('.editableNameStyle').hide();
        var username = $(this).parents('tr').find('.editableNameStyle').val() ;

        $(this).parents('tr').find('.editablepassword').show();
        $(this).parents('tr').find('.editablePasswordStyle').hide();
        var password = $(this).parents('tr').find('.editablePasswordStyle').val();

        $(this).parents('tr').find('.editablefirstname').show();
        $(this).parents('tr').find('.editableFirstnameStyle').hide(); //{
        var firstname = $(this).parents('tr').find('.editableFirstnameStyle').val();

        $(this).parents('tr').find('.editablelastname').show();
        $(this).parents('tr').find('.editableLastnameStyle').hide(); //{
        var  lastname = $(this).parents('tr').find('.editableLastnameStyle').val();

        $(this).parents('tr').find('.editablebox').show();
        $(this).parents('tr').find('.editableBoxStyle').hide(); //{
        var  box = $(this).parents('tr').find('.editableBoxStyle').val();

        $(this).parents('tr').find('.editablemail').show();
        $(this).parents('tr').find('.editableMailStyle').hide(); //{
        var mail = $(this).parents('tr').find('.editableMailStyle').val();

        $(this).parents('tr').find('.editablebuilding').show();
        $(this).parents('tr').find('.editableBuildingStyle').hide(); //{
        var building = $(this).parents('tr').find('.editableBuildingStyle').val();

        var userpk = $(this).parents('tr').find('.edituserpk').text();
        var CSRF = $(this).parents('tr').find('.CSRF').val();

        $.ajax({
            url: base_url+'Views/templates/ajax.php',
            type:'post',
            data  : {
                edituserpk : userpk,
                username : username ,
                password : password,
                firstname : firstname,
                lastname : lastname ,
                box : box,
                mail : mail ,
                CSRF : CSRF,
            },

            success:function(data){
                console.log("Updated success");
                console.log(data);
        }
        })
    });


    $('.editValues').on('click',function (event) {
        event.preventDefault();
        $(this).hide();
        $(this).closest('tr').find('.usersave').show();
        $(this).closest('tr').find('.buildsave').show();
        $(this).closest('tr').find('.comsave').show();
        $(this).closest('tr').find('.cancel').show();

        //Building
        $(this).parents('tr').find('.editablebuildname').hide();
        $($(this).parents('tr').find('.editableBuildNameStyle')).val($(this).parents('tr').find('.editablebuildname').text());
        $(this).parents('tr').find('.editableBuildNameStyle').show(); //{

        $(this).parents('tr').find('.editablebuildadress').hide();
        $($(this).parents('tr').find('.editableBuildAdressStyle')).val($(this).parents('tr').find('.editablebuildadress').text());
        $(this).parents('tr').find('.editableBuildAdressStyle').show(); //{



        //Communication
        $(this).parents('tr').find('.editablecomname').hide();
        $($(this).parents('tr').find('.editableComNameStyle')).val($(this).parents('tr').find('.editablecomname').text());
        $(this).parents('tr').find('.editableComNameStyle').show(); //{


        //User
        $(this).parents('tr').find('.editablename').hide();
        $($(this).parents('tr').find('.editableNameStyle')).val($(this).parents('tr').find('.editablename').text());
        $(this).parents('tr').find('.editableNameStyle').show(); //{

        $(this).parents('tr').find('.editablepassword').hide();
        $($(this).parents('tr').find('.editablePasswordStyle')).val($(this).parents('tr').find('.editablepassword').text());
        $(this).parents('tr').find('.editablePasswordStyle').show(); //{

        $(this).parents('tr').find('.editablefirstname').hide();
        $($(this).parents('tr').find('.editableFirstnameStyle')).val($(this).parents('tr').find('.editablefirstname').text());
        $(this).parents('tr').find('.editableFirstnameStyle').show(); //{

        $(this).parents('tr').find('.editablelastname').hide();
        $($(this).parents('tr').find('.editableLastnameStyle')).val($(this).parents('tr').find('.editablelastname').text());
        $(this).parents('tr').find('.editableLastnameStyle').show(); //

        $(this).parents('tr').find('.editablebox').hide();
        $($(this).parents('tr').find('.editableBoxStyle')).val($(this).parents('tr').find('.editablebox').text());
        $(this).parents('tr').find('.editableBoxStyle').show(); //{

        $(this).parents('tr').find('.editablemail').hide();
        $($(this).parents('tr').find('.editableMailStyle')).val($(this).parents('tr').find('.editablemail').text());
        $(this).parents('tr').find('.editableMailStyle').show(); //{

        $(this).parents('tr').find('.editablebuilding').hide();
        $($(this).parents('tr').find('.editableBuildingStyle')).val($(this).parents('tr').find('.editablebuilding').text());
        $(this).parents('tr').find('.editableBuildingStyle').show(); //{

        });


    $('.cancel').on('click',function (event) {
        event.preventDefault();
        $(this).hide();
        $(this).closest('tr').find('.usersave').hide();
        $(this).closest('tr').find('.buildsave').hide();
        $(this).closest('tr').find('.comsave').hide();
        $(this).closest('tr').find('.editValues').show();

        //Communication
        $(this).parents('tr').find('.editablecomname').show();
        $(this).parents('tr').find('.editableComNameStyle').hide();

        //Building
        $(this).parents('tr').find('.editablebuildname').show();
        $(this).parents('tr').find('.editableBuildNameStyle').hide();

        $(this).parents('tr').find('.editablebuildadress').show();
        $(this).parents('tr').find('.editableBuildAdressStyle').hide();

        //User
        $(this).parents('tr').find('.editablename').show();
        $(this).parents('tr').find('.editableNameStyle').hide();

        $(this).parents('tr').find('.editablepassword').show();
        $(this).parents('tr').find('.editablePasswordStyle').hide();

        $(this).parents('tr').find('.editablefirstname').show();
        $(this).parents('tr').find('.editableFirstnameStyle').hide(); //{

        $(this).parents('tr').find('.editablelastname').show();
        $(this).parents('tr').find('.editableLastnameStyle').hide(); //

        $(this).parents('tr').find('.editablebox').show();
        $(this).parents('tr').find('.editableBoxStyle').hide(); //{

        $(this).parents('tr').find('.editablemail').show();
        $(this).parents('tr').find('.editableMailStyle').hide(); //{

        $(this).parents('tr').find('.editablebuilding').show();
        $(this).parents('tr').find('.editableBuildingStyle').hide(); //{


    });

});
