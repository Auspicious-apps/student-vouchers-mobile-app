<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

<!-- new -->
 <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
 

  
    <link rel="stylesheet" href="{{asset('css/style.css')}}">   

    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
   <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
  
  
 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('admin/layouts/sidebar')
    @include('admin/layouts/header')
    <div class="content-wrapper">
         <main class="bg-main">

         @yield('content')
         
     </main>
        </div>
    
    @include('admin/layouts/footer')
</div>
</body>
</html>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" defer></script>

   <script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('js/adminlte.js')}}"></script>


<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="subcategory[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow"  class="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
<script type="text/javascript">
    // add row
    $("#add").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="subcategory[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow"  class="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#remove', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
<script>
    $(document).ready(function()
{
    $("#category").change(function()
    {
        var id=$(this).val();
         var sub_id=$('#sub_id').val();
        var dataString = 'id='+ id;
        //alert(id);
         $.ajax({
             url: "{{ url('subcategory/') }}" , 
             type: "GET",  
             data:{id:id},
             success:function(data)
                {
                  
                    var sub = data.subcategory;
                    var ids = data.ids;
                    var voucher_aval = data.voucher_aval;
                   // alert(voucher_aval);
                    $('#subcategories').show();

                    $('#subcategories').html('');
                    for(var i = 0; i < sub.length; i++)
                    {
                        if(ids[i]== sub_id){
                        var option = '<option value="'+ids[i]+'" selected>'+sub[i]+'</option>';
                        $('#subcategories').append(option);
                    }
                    else{
                         var option = '<option value="'+ids[i]+'">'+sub[i]+'</option>';
                        $('#subcategories').append(option);
                    }

                    }
                   
                    //var sub_cat = json_decode(sub);

                    // $.each(sub, function(key, value) {
    
                    // });
              },
          error: function (data) {
                console.log(data);
             }

        });  
    });
    var id=$('#category').val();
        var dataString = 'id='+ id;
         var sub_id=$('#sub_id').val();
         $.ajax({
             url: "{{ url('subcategory/') }}" , 
             type: "GET",  
             data:{id:id},
             success:function(data)
                {
                  
                    var sub = data.subcategory;
                    var ids = data.ids;
                     var voucher_aval = data.voucher_aval;
                    //alert(voucher_aval);
                    $('#subcategories').html('');
                    for(var i = 0; i < sub.length; i++)
                    {

                       if(ids[i]== sub_id){
                        var option = '<option value="'+ids[i]+'" selected>'+sub[i]+'</option>';
                        $('#subcategories').append(option);
                    }
                    else{
                         var option = '<option value="'+ids[i]+'">'+sub[i]+'</option>';
                        $('#subcategories').append(option);
                    }

                    }
                   
                    //var sub_cat = json_decode(sub);

                    // $.each(sub, function(key, value) {
    
                    // });
              },
          error: function (data) {
                console.log(data);
             }

        }); 
});
</script>
<!-- <script>
 $(document).on('click', '#editBtn', function () {
      var id = $(this).attr('data-id');
      alert(id);
          $.ajax({
             url: "{{ url('/edit-category') }}" , 
             type: "GET",  
             data:{id:id},
             success:function(data)
                {
                  

              },
          error: function (data) {
                console.log(data);
             }

        }); 
});
</script> -->


