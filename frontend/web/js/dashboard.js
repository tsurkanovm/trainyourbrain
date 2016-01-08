$(document).ready(function(){
    // get the click of the create button
    $(document).on('click','#modalButton', function (){
        $('#modal').modal('show')
            .find('#modalContent')
            .load( document.location.origin + $(this).attr('value') );
    });

})