console.log('test2');
new_id=$('table').find('tbody').find('form:last-child').attr('id').replace("druh-edit-form","");// ----- najdi posledne id a vpis ho do uploadu
 $('#id_upload').val(new_id*1+1);
function loadhanlder(){ //------------tato ofunkcia prichyti butony v javascripte
    var num_rows=document.getElementsByTagName("form").length;
    for (a=1; a<num_rows; a++){
        b=$('.druh-delete'+a).parents("form")
        console.log(b);

        
        $('.druh-delete'+a).on('click', function(event){
            event.preventDefault();
            console.log($(this).attr('id'));
            var form = $(this);
            $.ajax({
                url:"../modules/druh-delete.php/?id="+$(this).attr('id').replace("druh-delete",""),
            //   type: 'GET',
                data: form.serialize()
            }).done(function(data){
                document.getElementById("demo").innerHTML = data;
            });$(this).parents("form").hide(1000);

        });

        $('.druh-edit'+a).on('click', function(event){
            event.preventDefault();
         
            var form = $(this).parents("form");
            console.log($(this).attr('action'));
                var req = $.ajax({
                    url:form.attr('action'),
                    type: 'GET',
                    data: form.serialize()
            });
            req.done(function(data){
              
                document.getElementById("demo").innerHTML = data;
            });$(this).parents("form").hide(1000).show(1000);

        });
    };
};
loadhanlder();

$('#druh-upload').on('submit', function(event){
    event.preventDefault();
    var form = $(this);
    var req = $.ajax({
      url:form.attr('action'),
      type: 'GET',
      data: form.serialize()
    });
    req.done(function(data){
        document.getElementById("demo").innerHTML = data;
        $.ajax({
        url: "../modules/editdruh.php",
        //  context: document.body
        }).done(function(data) {
            datas=data;
            var newItem = $(datas).find('tbody').find('form:last-child');
            newItem.appendTo('#hlavnatabulka>tr>td').hide().show(1000);
            loadhanlder();
        });

    });
});


