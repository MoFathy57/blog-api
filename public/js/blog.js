function blogAction(url){
    var formData = new FormData(document.getElementById('blogForm'));
    $.ajax({
        type: 'POST',
        url: url,
        data : formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            $("#blogModal").modal('hide');
            $("#blogForm").trigger("reset");
            $('#blogTable').DataTable().draw(false);
        },
        error: function(data){ alert(data.responseJSON.message);},
    })
}

function blogData(url){
    var formData = new FormData(document.getElementById('blogForm'));
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            console.log(data);
            $("#blogModal").modal('show');
            $("#title").val(data.title);
            $("#body").val(data.body);
            $("#publish-date").val(data.publish_date);
            $("#blogid").val(data.id);
        },
        error: function(data){ alert(data.responseJSON.message);},
    })
}

function deleteBlog(url){
    if(confirm("delete record?") == true){
        $.ajax({
            type: 'Delete',
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#blogTable').DataTable().draw(false);
            },
            error: function(data){ alert(data.responseJSON.message);},
        })
    }
}

$(function(){
    $('#blogTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'title', name: 'title'},
            {data: 'body', name: 'body'},
            {data: 'publish_date', name: 'publish_date'},
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
