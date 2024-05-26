$(function(){

    $('.confirm').on('show.bs.modal', function (e) {
        var action = $(e.relatedTarget).attr('data-action');
        var datatype = $(e.relatedTarget).attr('data-type');
        
        $('.confirm').find('.modal-body').html(datatype);
        $('.btn-confirm').attr('href',action);
    });

    $('.confirm').click(function(e){
             var modalCancelId = $(this).data('id');
             var modalCancelLink = $(this).data('href');
             var modalCancelTitle = $(this).data('title');
             var modalCancelBody = $(this).data('body');

             $(".modal-title").html(modalCancelTitle);
             $(".modal-body").html(modalCancelBody);
             $(".delete-entry").attr("href", modalCancelLink);
             $('#confirm').modal('show');
    });

    $('#filters').on('submit',function(e){
    
    var value = $('.filterrules').filter(function () {
        return this.value != '';
    });

    if (value.length==0) {
        bootbox.alert('Please select atleast one filter.');
        e.preventDefault();
    } 
   });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            console.log(e.target.result);
          $('#need-preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#img-upload").change(function() {
      readURL(this);
    });

	 /* generalize function to change data */
    if($('.changestatus').length) {

        var field;

        $(document).on('change','.changestatus',function() {

            $this = $(this);
            field = $(this).data('name');
            $isCheck = $this.prop('checked');
            var toggle = $this.data('bs.toggle');
            var changeurl = $this.data('href');

            if($this.data('field'))
                field = $this.data('field');

            
            var values = { }; 
            values[field] = (+$isCheck);
            values["id"] = $this.data('id');
            
            $.ajax({
                type: "POST",
                url: changeurl,
                data: values,
                success: function( data ) {

                    if(data.status != 200) {
                        if ($isCheck){
                            toggle.off(true);
                        }
                        else{
                            toggle.on(true);
                        }

                        toastr.error(data.message, 'Error' , {timeOut: 5000});

                    } else {
                      toastr.success(data.message, 'Success' , {timeOut: 5000});
                        if ($isCheck){
                            $("#free_zone_settings").removeClass('show').addClass('hide');
                        }
                        else{
                            $("#free_zone_settings").removeClass('hide').addClass('show');
                        }
                    }
                }
            });
        });
    }

});
