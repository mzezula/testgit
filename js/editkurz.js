var add_form = $('#edit-upload');
load_handler();

function load_handler() {
    var add_form = $('#edit-upload');
    var num_rows = document.getElementsByTagName("form").length;
    
    button_delete = $('button');
    button_update = $('form');
    const delete_btn= document.querySelector('.edit-delete');
    const edit_btn= document.querySelector('.edit-update');
    delete_btn.addEventListener('click',delete_row);
    edit_btn.addEventListener('click',edit_row);
   
    for (a = 1; a < (num_rows - 1); a++) {

        id_row_delete = button_delete[a].id;
        id_row_update = $(button_update[a]).attr('id');

        // ------------------------------update--------------------------//

        $('#' + id_row_update).on('submit', function (event) {
            event.preventDefault();
            $(this).slideUp(1000);
            var form = $(this);
            var req = $.ajax({
                url: form.attr('action'),
                type: 'GET',
                data: form.serialize()
            });
            req.done(function (data) {
                demo(data);
            });
            $(this).slideDown(1000);
        });
        // ---------------------------------delete-------------------------//
        $('#' + id_row_delete).on('click', function (e) {
            //  e.preventDefault();
            var id_delete = ($(this).attr("class")).replace('edit-delete delete-form','');
            console.log(id_delete);
            console.log("delete "+id_delete);
            $.ajax({
                type: "POST",
                url: "edit-delete.php/?id=" + id_delete,
                data: {
                    id: $(this).val(), // < note use of 'this' here
                    access_token: $("#access_token").val()
                },
                success: function (result) {
                    document.getElementById("demo").innerHTML = result;
                    console.log('delete'+id_delete+'hah');
                    $('.edit-update'+id_delete).animate({
                        color: "green",
                        backgroundColor: "rgb( 256, 0, 0 )"
                    }).hide(2000);
                    setTimeout(function(){$('.edit-update'+id_delete).remove()}, 2000);
                    

                },
                error: function (result) {
                    alert('error');
                }
            });
           
        });
        
    };
    console.log(a+'pocet riadkov');
    console.log(num_rows);
};
// ---------------------------------Upload-------------------------//
add_form.on('submit', function (event) {
    event.preventDefault();
    
    var form = $(this);
    var req = $.ajax({
        url: form.attr('action'),
        type: 'GET',
        data: form.serialize()
    });
    req.done(function (data) {
        
        if(data!='NO_success'){
            $.ajax({url: '../modules/editkurz.php'}).done(function (html) {
                var newItem = $(html).find('.edit-update' + data);
                demo("uspesne nahodene id:"+data);
                $(newItem).appendTo('#top-table')
                    .slideUp(0)
                    .css({backgroundColor: '#aabbcc'})
                    .slideDown(500)
                    .animate({backgroundColor: '#fff'});
                ;reload_timer()
            });
    
        }else{
            demo(data+" ' Niekde sa stala chyba '");
        };
    });
});
$('#edit-stadion').on('submit', function (html) {
    html.preventDefault();
    var form = $(this);
    var req = $.ajax({
        url: form.attr('action'),
        type: 'GET',
        data: form.serialize()
    });
    req.done(function (data) {
        var newItem = $(data);
        $('#top-table').slideUp(300);
        $('#top-table').html('');
        $('#top-table').html(newItem);
        $('#top-table').slideDown(500);
        reload_timer();
    })
});

function demo(text){
    document.getElementById("demo").innerHTML = "info"+text;
}

function reload_timer() {
    function c() {
        var n = $('.counter').attr('id');
        var c = n;
        $('.counter').text(c);

        setInterval(function () {
            c--;
            if (c >= 0) {
                $('.counter').text(c);
            }
            if (c == 0) {
                $('.counter').text(n);
                load_handler();

            }
        }, 1000);
    }

    // Start
    c();

    // Loop
    setInterval(function () {
        //  c();
    }, 5000);
};
function delete_row(){
    console.log('delete-btn'+$(this).attr("class"));
};
function edit_row(){   
    console.log('dedit-btn'+$(this).attr("class"));
};

/*
delete_btn= document.querySelectorAll('.edit-delete');
edit_btn= document.querySelectorAll('.edit-update');

Array.from(delete_btn).forEach(link => {
    link.addEventListener('click', function(event) {

            event.preventDefault();
            console.log('delete'+$(this).attr("class"));
            delete_row(this);
    });
});
function delete_row(e){
    console.log('delete-btn'+$(this).attr("class"));
};
function edit_row(){   
    console.log('edit-btn'+$(this).attr("id"));
};

//delete_btn.addEventListener('click',delete_row);
//edit_btn.addEventListener('click',edit_row);


*/