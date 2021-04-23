$(document).ready(function(){

    // console.log(baseUrl);

    $('.inclusion').on('change', function(){
        // alert('Hello');
        var val = [];
          $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
          });
          var level_id = $('#functional_level_id').val();
        var baseurl = $('#baseurl').val();
        if(val != '')
        {
          if(val.length == 1)
          {
            $.ajax({
              type: "POST",
              url: baseurl+"vacancy/inclusionamount/"+level_id,
              data: {val:val},
              success: function (response) {
                var normal_amount = jQuery.parseJSON(response);
                $('#inclusion_amount').val(normal_amount.NORMAL_AMOUNT);
              }
            });
          }else
          {
            $.ajax({
              type: "POST",
              url: baseurl+"vacancy/inclusionamount/"+level_id,
              data: {val:val},
              success: function (response) {
                var amount = jQuery.parseJSON(response);
                var total = parseInt(amount.NORMAL_AMOUNT)+parseInt(amount.INCLUSION_AMOUNT)*(val.length-1);
                $('#inclusion_amount').val(total);
              }
            });
          }        
        }else
        {
          $('#inclusion_amount').val('');
        }
        
      });

    


});

