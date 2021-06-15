console.log('test2+1');
var add_form = $('#add-form');
var vsetkyform = document.getElementsByTagName("form");
new_id = $('table').find('tbody').find('form:last-child').attr('id').replace("druh-edit-form", "");// ----- najdi posledne id a vpis ho do uploadu
console.log(new_id);
$('#id_upload').val(new_id * 1 + 1);


for (let item of vsetkyform) {

    $("#delete-form" + (item.id).substr(12, 9)).click(function (e) { // najdi delete tlacitko a klik
        e.preventDefault();
        var id_delete = ($(this).attr("id")).substr(11, 10);
        var request = new XMLHttpRequest();
        request.open("GET", "stadion-delete.php?id=" + id_delete + "&test=test'");
        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("demo").innerHTML = this.responseText;
            }
        };
        request.send();
        $(this).parent().parent().hide(2000);
        reload_timer();
    });

    $("#edit-form" + (item.id).substr(12, 9)).click(function (e) { // najdi edit tlacitko a klik
        e.preventDefault();
        var id_update = ($(this).attr("id")).substr(9, 10);
        var stadion_onoff = document.getElementById("stadion_onoff" + id_update).checked;
        var request = new XMLHttpRequest();
        request.open("GET", "stadion-update.php/?stadi_id=" + id_update + "&stadion_onoff=" + stadion_onoff);
        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("demo").innerHTML = this.responseText;
            }
        };
        request.send();
        $(this).parent().parent().hide(1000).show(1000);
        reload_timer();
    });
}
;
var uploadstadion = $("#upload-stadion");
uploadstadion.on('submit', function (event) {
    event.preventDefault();
    var form = $(this);
    var req = $.ajax({
        url: form.attr('action'),
        type: 'GET',
        data: form.serialize()
    })
    req.done(function (data) {
        document.getElementById("demo").innerHTML = data;
        $.ajax({
            url: "../modules/editstadion.php",
            data: form.serialize()

        }).done(function (data) {
            datas = data;
            var newItem = $(datas).find('tbody').find('form:last-child');
            newItem.appendTo('#hlavnatabulka>tbody>tr>td').hide().show(1000);
            new_id = ($(datas).find('tbody').find('form:last-child').attr('id')).replace("edit-stadion", "")

            console.log(new_id);
            reload_timer();

            /*
            setTimeout(function(){  //------------------- 5 sekund do reloadu
                window.location.reload(1);
             }, 5000);
             $('#id_upload').val(new_id+1);
             */
        });


    });

});
add_form.on('submit', function (event) {
    event.preventDefault();
    var form = $(this);
    var req = $.ajax({
        url: form.attr('action'),
        type: 'GET',
        data: form.serialize()
    });
    req.done(function (data) {
        $.ajax({url: '../modules/editkurz.php'}).done(function (html) {
            var newItem = $(html);
            newItem2 = newItem.children('#top-table form:last-child');
            newItem2.appendTo('#top-table')
                .hide(0)
                .css({backgroundColor: '#aabbcc'})
                .delay(600)
                .slideDown(1000)
                .animate({backgroundColor: '#fff'});
            reload_timer();
        });
    });
});

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
                window.location.reload(1);
            }
        }, 1000);
    }

    // Start
    c();

    // Loop
    setInterval(function () {
        c();
    }, 5000);
};