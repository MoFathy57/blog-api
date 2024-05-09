// add or update user request
function subscriberAction(url){
    var formData = new FormData(document.getElementById('subscriberForm'));
    $.ajax({
        type: 'POST',
        url: url,
        data : formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            $("#subscriberModal").modal('hide');
            $("#subscriberForm").trigger("reset");
            $('#subscriberTable').DataTable().draw(false);
        },
        error: function(data){ alert(data.responseJSON.message);},
    })
}

// get user data
function subscriberData(url){
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            console.log(data);
            $("#subscriberModal").modal('show');
            $("#name").val(data.name);
            $("#username").val(data.username);
            $("#subscriberid").val(data.id);
        },
        error: function(data){ alert(data.responseJSON.message);},
    })
}

// delete user
function deleteSubscriber(url){
    if(confirm("delete record?") == true){
        $.ajax({
            type: 'Delete',
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#subscriberTable').DataTable().draw(false);
            },
            error: function(data){ alert(data.responseJSON.message);},
        })
    }
}

$(function(){
    $('#subscriberTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'status', name: 'status'},
            {data: 'actions', name: 'actions', orderable: false},
        ],
        order: [[0, 'desc']]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    })
})
