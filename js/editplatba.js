var button1 =$('#button1');
var num_rows=document.getElementsByTagName("form").length;
for (a=1; a<num_rows;a++){
    
    aa=(($(".delete-platba"+a)).attr("id")).replace("delete-platba", "");
    

    $('#platba-edit'+aa).on('submit', function(event){
        event.preventDefault();
        $(this).slideUp(1000);

        var form = $(this);
        var req = $.ajax({
          url:form.attr('action'),
          type: 'GET',
          data: form.serialize()
        });
        req.done(function(data){
        document.getElementById("demo").innerHTML = data;
        });
        $(this).slideDown(1000);
    });



$('.delete-platba'+a).click(function(e) {
       e.preventDefault();

     var class_delete =($(this).attr("class")).substr(12,11);
     var id_delete =($(this).attr("id")).replace("delete-platba", "");
  

     $.ajax({
           type: "POST",
           url: "platba-delete.php/?id="+id_delete+"",
           data: {
            //   id: $(this).val(), // < note use of 'this' here
            //   access_token: $("#access_token").val()
           },
           success: function(result) {
            //   alert('ok');
            //   $(this).hide(1000);
            document.getElementById("demo").innerHTML = result;
           },
           error: function(result) {
               alert('error');
           }
       });
       $(this).parent().parent().parent().parent().parent().animate({
           color: "green",
           backgroundColor: "rgb( 256, 0, 0 )"
         }).hide(3000);
       });
       
};
$('#upload-platba').on('submit', function(event){
    event.preventDefault();
    var form = $(this);
    var req = $.ajax({
      url:form.attr('action'),
      type: 'GET',
      data: form.serialize()
    });
    req.done(function(data){
    document.getElementById("demo").innerHTML = data;
    data_id=data;
    $.ajax({url:'../modules/editplatba.php'}).done(function(html){
        
        var newItem=$(html).find('#platba-edit'+data).parent().parent();
        newItem.appendTo('#hlavnatabulka').hide().show(1000);
        
        console.log('#platba-edit'+data+"             "+(newItem).html());
      });

    
    });
   
    
});
