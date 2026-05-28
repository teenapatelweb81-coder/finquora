$(document).ready(function () {
        
   $('#catfrm').submit(function (event){
   		
   		var category = $('#category').val(); 
   		var status = $('#status option:selected').val(); 
   		
   		if(category === '') {
   		    $('#category').css('border','1px solid red');
   		} else {
   		    $('#category').css('border','');
   		}
        if(status === '') {
   		    $('#status').css('border','1px solid red');
   		} else {
   		    $('#status').css('border','');
   		}
   		
   		if(category && status !==''){
            
          $.ajax({
              
             type:"POST",    
             url: "add-category",   
             data:$(this).serialize(),
             dataType:"json",
             beforeSend:function(){
                 $('#submit').attr('disabled', 'disabled');
                 }, 
                 success:function(res) {
                     if(res.error) {
                         alert(res.error);
                          if(data.categoryErr !== '') {
                          $('#categoryErr').html(data.categoryErr);
                          } else {
                             $('#categoryErr').html('');
                          }
                           if(data.statusErr !== '') {
                          $('#statusErr').html(data.statusErr);
                          } else {
                             $('#statusErr').html('');
                          }
                    }
                    if(res.success) {
                             alert(res.success);
                         $('#success_message').html(res.success);
                         $('#success_message').fadeOut(1500);
                         $('#categoryErr, #statusErr').html('');
                         $('#catfrm')[0].reset();
                    }
                 }
                      
        });    		    
    
   		}
   		$('#submit').attr('disabled', false);
   		event.preventDefault();
   });
   
   $('.cremove').on('click', function(){
       var id = $(this).attr('id');
          if(confirm('Are you sure to remove this category ?')) {
                  $.ajax({
                        url:"https://dndtestserver.com/kokoganna/develop/delete-category",
                        type:"post",
                        data:{id:id},
                        success:function(result){
                            window.location.reload();
                           $('#message').html(result);
                           $('#message').delay(2500).fadeOut(1500);
                        }
                    });
           }
   });
   
   $('#cat_id').on('change',function(){
        var catid = $(this).val();
         if(catid !=='') {
            $.ajax({
                url:'all-category',
                type:'post',
                data:{catid:catid},
                success:function(result){
                   $('#subcat_id').html(result);
                    console.log(result);
                } 
            });
         } else {
             $('#subcat_id').html('<option>Please Select Category First</option>');
         } 

    });
 
  });
  
  $('.orderAction').on('change',function () {
      var orderAction = $(this).val();
      var orderID = $(this).data('id');
      
      if(orderAction !== '') {
            $.ajax({
                url:'https://dndtestserver.com/kokoganna/develop/orderAction',
                type:'post',
                data:{orderAction:orderAction, orderID:orderID},
                success:function(result){
                   window.location.reload();
                } 
            });
      } else {
          alert('Please choose Order Action, thanks... ');
      }
      
  });
  
  //quoteFrm