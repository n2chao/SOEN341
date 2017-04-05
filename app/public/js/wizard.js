
$(document).ready(function(){
  //Hide all dash components: sidebar, annoucements
  $(".dash").hide();

  $(".wizard-next").click(function(){
    $("#wizard-form").submit();
  });
});
