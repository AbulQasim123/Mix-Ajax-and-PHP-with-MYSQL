<script type="text/javascript" src="jquery\jquery.js"></script>
<?php
    
?>
<script>
        // PHP Ajax insert data in mysql by using Bootstrap Modal
    $(document).ready(function(){
        $('#insert_form').on('submit', function(event){
            event.preventDefault();
            // alert('hello');
            let modal_name = "";
            let modal_address = "";
            let modal_gender = "";
            let modal_designation = "";
            let modal_age = "";
            $('.error_field').html('');
            
            modal_name = $('#modal_name').val();
            modal_address = $('#modal_address').val();
            modal_gender = $('#modal_gender').val();
            modal_designation = $('#modal_designation').val();
            modal_age = $('#modal_age').val();

            if ((modal_name) == "") {
                $('#modal_name_err').html('Employee name is required ?');
            }else if((modal_address) == ""){
                $('#modal_address_err').html('Employee address is required ?');
            }else if((modal_gender) == ""){
                $('#modal_gender_err').html('Employee gender is required');
            }else if((modal_designation) == ""){
                $('#modal_designation_err').html('Employee designation is required ?');
            }else if((modal_age) == ""){
                $('#modal_age_err').html('Employee age is required ?');
            }else{
                $.ajax({
                    url : "modal_insert.php",
                    method : "POST",
                    data : $('#insert_form').serialize(),
                    beforeSend: function(){
                        $('#insert').val('Inserting');
                    },
                    success: function(modal_result){
                        $('#insert_form')[0].reset();
                        $('#employee_data').html(modal_result);
                        $('#add_data_modal').modal('hide');
                        $('#insert').val('Insert');
                    }
                })
            }
        })
            // View Detail modal
        $(document).on('click', '.view_modal', function(){
            var employee_id = $(this).attr('id');
            // console.log(employee_id);
            $.ajax({
                url: "fetch_view.php",
                method: "POST",
                data: {employee_id:employee_id},
                success: function(fetch_data){
                    $('#employee_details').html(fetch_data);
                    $('#data_modal').modal('show');
                }
            })
        })
            // Fetch Data for Edit
        $(document).on('click','.icon-edit', function () { 
            var employee_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "edit.php",
                data: {employee_id:employee_id},
                success: function (response) {
                    $('#edit_data_modal').modal('show');
                    var data = $.parseJSON(response);
                    console.log(data);
                    $('#edit_id').val(data.Id);
                    $('#edit_modal_name').val(data.Name);
                    $('#edit_modal_address').val(data.Address);
                    $('#edit_modal_gender').val(data.Gender);
                    $('#edit_modal_age').val(data.Age);
                    $('#edit_modal_designation').val(data.Designation);
                }
            });
        })

        $('#edit_form').on('submit', function(event){
            event.preventDefault();
            // alert('hello');
            let modal_name = "";
            let modal_address = "";
            let modal_gender = "";
            let modal_designation = "";
            let modal_age = "";
            $('.error_field').html('');
            
            modal_name = $('#edit_modal_name').val();
            modal_address = $('#edit_modal_address').val();
            modal_gender = $('#edit_modal_gender').val();
            modal_designation = $('#edit_modal_designation').val();
            modal_age = $('#edit_modal_age').val();

            if ((modal_name) == "") {
                $('#modal_name_err').html('Employee name is required ?');
            }else if((modal_address) == ""){
                $('#modal_address_err').html('Employee address is required ?');
            }else if((modal_gender) == ""){
                $('#modal_gender_err').html('Employee gender is required');
            }else if((modal_designation) == ""){
                $('#modal_designation_err').html('Employee designation is required ?');
            }else if((modal_age) == ""){
                $('#modal_age_err').html('Employee age is required ?');
            }else{
                $.ajax({
                    url : "update.php",
                    method : "POST",
                    data : $('#edit_form').serialize(),
                    beforeSend: function(){
                        $('#insert').val('Inserting');
                    },
                    success: function(modal_result){
                        $('#edit_form')[0].reset();
                        $('#employee_data').html(modal_result);
                        $('#edit_data_modal').modal('hide');
                        $('#update').val('Save');
                    }
                })
            }
        })
            // Delete Data
        $(document).on('click','.icon-remove', function () { 
            var employee_id = $(this).attr('id');
            if (confirm("Are you sure to delete this?")) {
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: {employee_id:employee_id},
                    success: function (response) {
                        $('#employee_data').html(response);
                        setTimeout(() => {
                            location.reload(); 
                        }, 1000);
                    }
                });
            }
        })
    })
    
        // Make login form by using bootstrap modal with php ajax jquery
    $(document).ready(function(){
        $('#login_btn').click(function(){
            let modal_username = $('#modal_username').val();
            let modal_password =  $('#modal_password').val();
            if (modal_username != "" && modal_password != "") {
                $.ajax({
                    url : "modal_login.php",
                    method : "POST",
                    data: {modal_username: modal_username, modal_password: modal_password},
                    success: function(modal_result){
                        // alert(modal_login);
                        if (modal_result == 'No') {
                            alert("Invalid credential");
                        }else{
                            $('#login_modal').hide();
                            location.reload();
                        }
                    }
                })

            }else{
                alert('Both field are required ?');
            }
        })

        $('#modal_logout').click(function(){
            let action = "modal_logout";
            $.ajax({
                url: "modal_login.php",
                method: "POST",
                data: {action:action},
                success: function(){
                    location.reload();
                }
            })
        })
    })
        // Make login form by using Bootstrap collapse with php ajax and jquery
    $(document).ready(function(){
        $('#collapse_login').click(function(){
            let collapse_username = $('#collapse_username').val();
            let collapse_password = $('#collapse_password').val();
            if (collapse_username != "" && collapse_password != "") {
                $.ajax({
                    url : "collapse_login.php",
                    method: "POST",
                    data: {collapse_username:collapse_username, collapse_password:collapse_password},
                    success: function(collapse_result){
                        if (collapse_result == "No") {
                            alert('Wrong credential');
                        }else{
                            location.reload();
                        }
                    }
                })
            }else{
                alert('Both field are required ?');
            }
        })

        $('#collapse').click(function(){
            let action = "logout";
            $.ajax({
                url : "collapse_login.php",
                method: "POST",
                data: {action:action},
                success: function(){
                    location.reload();
                }
            })
        })
    })

        // Dynamic menu with dynamic content in php using ajax jquery
    $(document).ready(function(){
        function load_page_detail(id){
            $.ajax({
                url: "dynamic_menu.php",
                method: "POST",
                data: {id:id},
                success: function(dynamic_result){
                    $('#page_details').html(dynamic_result);
                }
            })
        }
        load_page_detail(1);

        $('.nav li').click(function(){
            var page_id = $(this).attr('id');
            load_page_detail(page_id);
        })
    })

        // Multiple inline insert into mysql using ajax jquey in php
    $(document).ready(function(){
        var count = 1;
        $('#Add').click(function(){
            count = count + 1;
            var html_code = "<tr id='row"+count+"'>";
            html_code += "<td contenteditable='true' class='item_name'></td>";
            html_code += "<td contenteditable='true' class='item_desc'></td>";
            html_code += "<td contenteditable='true' class='item_price'></td>";
            html_code += "<td><button type='button' name='remove' id='' data-row='row"+count+"' class='btn btn-danger btn-sm remove icon-remove'></button></td>";
            html_code += "</tr>";
            $('#crud_table').append(html_code);
        })
        $(document).on('click', '.remove', function(){
            var delete_row = $(this).data('row');
            $('#'+delete_row).remove();
        })
        $('#save').click(function(){
            var item_name = [];
            var item_code = [];
            var item_desc = [];
            var item_price = [];

            $('.item_name').each(function () {
                item_name.push($(this).text());
            });
            $('.item_desc').each(function () {
                item_desc.push($(this).text());
            });
            $('.item_price').each(function () {
                item_price.push($(this).text());
            });

            $.ajax({
                url: "multi_insert.php",
                method: "POST",
                data: {item_name:item_name,item_desc:item_desc, item_price:item_price},
                success: function(multi_data){
                    $('#alert_msg').html(multi_data);
                    $("td[contentEditable = 'true'] ").text("");
                    for (var i = 2; i <= count; i++) {
                        $('tr#'+i+'').remove();
                    }
                    fetch_item_data();
                }
            })
        })

        function fetch_item_data(){
            $.ajax({
                url: "multi_fetch.php",
                method: "POST",
                success: function(multi_result){
                    $('#inserted_data_item').html(multi_result);
                }
            })
        }
        fetch_item_data();
    })  

        // Load content while scrolling with jquery ajax and php
    $(document).ready(function(){
        var limit = 5;
        var start = 0;
        var action = 'inactive'
        function load_scrolling_data(){
            $.ajax({
                url: "scroll_fetch.php",
                method: "POST",
                data: {limit:limit,start:start},
                cache: false,
                success: function(scroll_result){
                    $('#load_data').append(scroll_result);
                    if (scroll_result == "") {
                        $('#load_data_message').html('<button type="button" class="btn btn-primary btn-sm">No Data  found</button>');
                        action = 'active';
                    }else{
                        $('#load_data_message').html('<button type="button" class="btn btn-primary btn-sm">Please wait</button>');
                        action = 'inactive';
                    }
                }
            })
        }
        if (action == 'inactive') {
            action = 'active';
            load_scrolling_data(limit,start);
        }

        $(window).scroll(function(){
            if ($(window).scrollTop() + $(window).height() > $('#load_data').height() && action == "inactive") {
                action = 'active';
                start = start + limit;
                setTimeout(function(){
                    load_scrolling_data(limit,start);
                },2000)
            }
        });
    })

        // Jquery ajax call to php script with json return
    $(document).ready(function(){
        $('#search').click(function(){
            var id = $('#employee_list').val();
            // alert(id);
            if (id != "") {
                $.ajax({
                    url: "calljson_fetch.php",
                    method: "POST",
                    data: {id:id},
                    dataType: "JSON",
                    success: function(data){
                        $('#emp_details').css('display', 'block');
                        $('#err_msg').html('');
                        $('#emp_name').text(data.name);
                        $('#emp_address').text(data.address);
                        $('#emp_gender').text(data.gender);
                        $('#emp_designation').text(data.designation);
                        $('#emp_age').text(data.age);
                    }
                })
            }else{
                $('#err_msg').html('Please select employee name ?');
                $('#emp_details').css("display", "none");
            }
        })
    })

        // json data to html table using ajax jquery getJSON method.
    $(document).ready(function(){
        $.getJSON('employee.json', function(data){
            var employee_data = "";
            $.each(data, function(key,value){
                employee_data += '<tr>';
                employee_data += '<td>'+value.Name+'</td>';
                employee_data += '<td>'+value.Address+'</td>';
                employee_data += '<td>'+value.Gender+'</td>';
                employee_data += '<td>'+value.Designation+'</td>';
                employee_data += '<td>'+value.Age+'</td>';
                employee_data += '</tr>';
            })
            $('#employee_table').append(employee_data);
        })
    })
</script>