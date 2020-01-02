$(document).ready(function(){
  $('.action').change(function(){
  if($(this).val() != '')
  {
   var major_area = $("#major_area").val();
   var city = $("#city").val();
   var zip_code = $("#zip_code").val();
   var YM = $("#YM").val();
   var trans = $("#trans").val();
   var color = $("#color").val();
   var other = $("#other").val();
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "major_area")
   {
    result = 'city';
   }
   else if (action == "city")
   {
    result = 'zip_code';
   }
   else if (action == "zip_code")
   {
    result = 'YM';
   }
   else if (action == "YM")
   {
    result = 'trans';
   }
   else if (action == "trans")
   {
    result = 'color';
   }
   else if (action == "color")
   {
    result = 'other';
   }
   else if (action == "other")
   {
    result = 'mv';
   }
   $.ajax({
    url:"get.php",
    method:"POST",
    data:{action:action, query:query,major_area:major_area,city:city,zip_code:zip_code,YM:YM,trans:trans,color:color,other:other},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});