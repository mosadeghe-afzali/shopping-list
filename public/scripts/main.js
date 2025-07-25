$(document).ready(function () {
    getItems();
});

function getItems() {
    $('#name').val("");
    $('#price').val("");
    $('#description').val("");
    $('#id').val("");
    $.ajax({
        url: "../routes/index.php?method=items",
        type: "GET",
        dataType: 'json',
        data: { "_token": "{{ csrf_token() }}" },
        success: function (response) {
            var card = $('.order-card')
            if (response.status == "success") {
                console.log(response.response)
                $.each(response.response, function (key, value) {
                    console.log(key, value)
                    card.append(
                        "<div class=' flex flex-col sm:grid sm:grid-cols-[10%_90%] gap 4 border border-gray-300 rounded-lg overflow-hidden mb-10 shadow-sm'>" 
                            +
                                "<div class='flex items-center justify-center bg-green-200 p-4'>" 
                                + "<input class='w-5 h-5' type='checkbox' name='items[]' data-id = "+ value.id + " value=" + value.id + ">"
                            + "</div>"
                            + "<div class='flex flex-col justify-center bg-green-100 p-4 pr-6'>" 
                                + "<div class='mb-4 space-y-1'>"
                                    +"<div class='text-base font-semibold'>" + value.name + "</div>"
                                    +"<div class='text-sm text-gray-700'>" + value.price + "<span> تومان</span></div>"
                                    +"<div class='text-sm text-gray-600'>" + value.description + "</div>"
                                + "</div>"
                                + "<div class='flex gap-2'>"
                                    + '<a  data-id=' + value.id  
                                    + ' data-name =  "'+ value.name+'" '
                                    + ' data-price = "'+value.price+'" '
                                    + ' data-description =  "'+value.description+'" '
                                    + ' onclick="showUpdateItme(this)">'
                                    + "<svg class='w-5 h-5'>" 
                                    + "<use xlink:href='#pencil'></use>" 
                                    + "</svg>" + "</a>"

                                    + '<a  data-id=' + value.id  + ' onclick="deleteItem(this)">'
                                    + "<svg class='w-5 h-5'>" 
                                    + "<use xlink:href='#trash'></use>" 
                                    + "</svg>" + "</a>"
                                + "</div>"
                            + "</div>"
                            +
                        "</div>"
                    )
                });
            }
        },
        error: function (error) {
            console.log(error, 'err')
            if (error.status == 419) {
                // console.log(AlertTokenMismatch);
            }
        }
    });
}


function showItemPopup() {

    $("#insert-item").removeClass("hidden");
    $("#insert-item").addClass("flex");

}

function closeItemPopup() {

    $("#insert-item").addClass("hidden");
    $("#insert-item").removeClass("flex");
    $('#name').val("");
    $('#price').val("");
    $('#description').val("");
    $('#id').val("");
}

function hiddenItemPopup(event) {
    if (event.target == $('#insert-item')) {

        $("#insert-item").addClass("hidden");
        $("#insert-item").removeClass("flex");
    }
}


function submitItemFrom() {

    var id = $('#id').val(); 
    var name = $('#name').val();
    var price = $('#price').val();
    var description = $('#description').val();
    $('#insert_button').prop('disabled', true);

    if (checkEmpty(name)) {
        $('#insert_button').prop('disabled', false);
        $('#message_form').html("نام را وارد کنید.");
        return true;
    }
    if (checkEmpty(price)) {
        console.log(price)
        $('#insert_button').prop('disabled', false);
        $('#message_form').html("قیمت را وارد کنید.");
        return true;
    }

    if(checkNumeric(price)) {
        $('#insert_button').prop('disabled', false);
        $('#message_form').html("قیمت را عدد وارد کنید.");
        return true;
    }
    
    if (checkEmpty(description)) {
        $('#insert_button').prop('disabled', false);
        $('#message_form').html("توضیحات را وارد کنید.");
        return true;
    }

    console.log(id);

    if(id) {
        updateItem(); 
    }else {
        insertItem(); 
    }
}

function insertItem() {
    console.log('in insert')
    var name = $('#name').val();
    var price = $('#price').val();
    var description = $('#description').val();

    $.ajax({
        url: "../routes/index.php?method=insertItem",
        type: "POST",
        dataType: 'json',
        data: { 
            name: name,
            price: price,
            description: description
        },
        success: function (response) {
            console.log(response); 
            if(response.status == 'error') {
                $('#message_form').html(response.message)
                $('#insert_button').prop('disabled', false);
                return
            }
      
            $('#message_form').html(response.message)
            setTimeout(function () {
                $('#message_form').html("")
                $('#name').val("");
                $('#price').val("");
                $('#description').val("");
                location.reload();

            }, 2000);
            $('#insert_button').prop('disabled', false);
            
        },
        error: function (error) {
            console.log(error, 'err')
            $('#message_form').html("خطای سرور")
            $('#insert_button').prop('disabled', false);
            setTimeout(function () {
                $('#message_form').html("")

            }, 2000);
        }
    });

}

function showUpdateItme(e) {
    var id = $(e).data('id'); 
    var name = $(e).data('name'); 
    var price = $(e).data('price'); 
    var description = $(e).data('description'); 

    $('#id').val(id); 
    $('#name').val(name); 
    $('#price').val(price); 
    $('#description').val(description); 
    showItemPopup(); 
}

function updateItem() {
    console.log('in update')
    var name = $('#name').val();
    var price = $('#price').val();
    var description = $('#description').val();
    var id = $('#id').val(); 
    $('#id').val(""); 

    $.ajax({
        url: "../routes/index.php?method=updateItem",
        type: "POST",
        dataType: 'json',
        data: { 
            id: id,
            name: name,
            price: price,
            description: description
        },
        success: function (response) {
            console.log(response); 

            if(response.status == 'error') {
                $('#message_form').html(response.message)
                $('#insert_button').prop('disabled', false);
                return
            }
            $('#message_form').html(response.message)
            setTimeout(function () {
                $('#message_form').html("")
                $('#name').val("");
                $('#price').val("");
                $('#description').val("");
                $('#id').val("");
                location.reload();

            }, 2000);
            $('#insert_button').prop('disabled', false);
            
        },
        error: function (error) {
            console.log(error, 'err')
            $('#message_form').html("خطای سرور")
            $('#insert_button').prop('disabled', false);
            setTimeout(function () {
                $('#message_form').html("")

            }, 2000);
        }
    });
}

function deleteItem(e) {
    var  id = $(e).data('id'); 

    console.log(e, id)
     console.log(id); 
     $.ajax({
         url: "../routes/index.php?method=deleteItem",
         type: "POST",
         dataType: 'json',
         data: { 
             item_id: id,
         },
         success: function (response) {
             console.log(response); 
            $('#message_form_delete').html(response.message)
             setTimeout(function () {
                $('#message_form_delete').html("")
                 location.reload();
 
             }, 1000);
             
         },
         error: function (error) {
            $('#message_form_delete').html(response.message)
             console.log(error, 'err')
         }
     });
 }

function showDeleteopup() {
    $("#delete-item").removeClass("hidden");
    $("#delete-item").addClass("flex");
}

function closeConfirmDeletePopup() {
    $("#delete-item").addClass("hidden");
    $("#delete-item").removeClass("flex");
}

function hiddenConfirmDeletePopup(event) {
    if (event.target == $('#delete-item')) {

        $("#delete-item").addClass("hidden");
        $("#delete-item").removeClass("flex");
    }
}

function submitDeleteItem() {
    console.log('innn')
    console.log(selectedItems = $('input[name="items[]"]:checked').length)
    if($('input[name="items[]"]:checked').length == 0) {
           $('#message_form_delete').html('موردی انتخاب نشده است.')
             setTimeout(function () {
                $('#message_form_delete').html("")
                 location.reload();
 
             }, 1000);
        return; 
    }

    var selectedItems = $('input[name="items[]"]:checked').map(function() {
       deleteItem(this)
    }).get()
}

function checkEmpty(item) {
    if (item === "" || item === undefined || item === null)
        return true;
    return false;
}

function checkNumeric(item) {
    item = parseFloat(item)

    if(typeof(item) != 'number') {
        return true
    }
    return false
}

function login(e) {

    var  username = $('#username').val(); 
    var password = $('#password').val(); 

    if (checkEmpty(username)) {
        $('#login_button').prop('disabled', false);
        $('#message_form_login').html("نام کاربری را وارد کنید.");
        return true;
    }
    if (checkEmpty(password)) {
        $('#login_button').prop('disabled', false);
        $('#message_form_login').html("کلمع عبور را وارد کنید.");
        return true;
    }

    $.ajax({
         url: "../routes/index.php?method=login",
         type: "POST",
         dataType: 'json',
         data: { 
             username: username,
             password: password
         },
         success: function (response) {
            
            $('#message_form_login').html(response.message)
            if(response.status == 'success') {
                setTimeout(function () {
                $('#message_form_login').html("")
                window.location = "../public";
 
             }, 1000);
            }
         
         },
         error: function (error) {
            $('#message_form_login').html(response.message)
             console.log(error, 'err')
         }
    });
 }

function signup(e) {
    console.log('innnnnnnnnn')
    var  name = $('#name').val(); 
    var  username = $('#username').val(); 
    var  password = $('#password').val(); 
    var  password_repeat = $('#password-repeat').val(); 
    $('#signup_button').prop('disabled', true);


    if (checkEmpty(username)) {
        $('#signup_button').prop('disabled', false);
        $('#message_form_signup').html("نام را وارد کنید.");
        return true;
    }

    if (checkEmpty(username)) {
        $('#signup_button').prop('disabled', false);
        $('#message_form_signup').html("نام کاربری را وارد کنید.");
        return true;
    }
    if (checkEmpty(password)) {
        $('#signup_button').prop('disabled', false);
        $('#message_form_signup').html("کلمع عبور را وارد کنید.");
        return true;
    }

    if(password != password_repeat) {
        $('#signup_button').prop('disabled', false);
        $('#message_form_signup').html("کلمه عبور با تکرار آن مطابقت ندارد.");
        return true;
    }
    $.ajax({
         url: "../routes/index.php?method=register",
         type: "POST",
         dataType: 'json',
         data: { 
             username: username,
             password: password,
             name: name,
             password_repeat: password_repeat
         },
         success: function (response) {
  
            if(response.status == 'errro') {
                $('#message_form_signup').html(response.message)
                $('#signup_button').prop('disabled', false);

            }

            setTimeout(function () {
                $('#message_form_signup').html("")
                window.location = "../public";
                $('#signup_button').prop('disabled', false);
             }, 1000);
         
         },
         error: function (error) {
            $('#message_form_signup').html(response.message)
            $('#signup_button').prop('disabled', false);

             console.log(error, 'err')
         }
    });
 }

 function logout() {
      $.ajax({
         url: "../routes/index.php?method=logout",
         type: "POST",
         dataType: 'json',
         success: function (response) {
            
            if(response.status == 'success') {
                setTimeout(function () {
                location.reload();
 
             }, 1000);
            }
         
         },
         error: function (error) {
            $('#message_form_login').html(response.message)
             console.log(error, 'err')
         }
    });
 }



