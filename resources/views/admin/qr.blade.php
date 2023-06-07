
@extends('admin/layouts/app')

@section('content')
<section class="add-ctegory-main-block">
         <div class="heading">
          <div class="left-block">
            <h3>Student List</h3>
           </div>
           <div class="right-block">
         </div>
         </div>
           <div class="table-block" >
        <table  id="myTable">
          <thead>
            <tr>
              <th scope="col">#</th>
             <th scope="col">Student-ID</th>
              <th scope="col">University Email</th>
               <th scope="col">Qrcode</th>
            </tr>
          </thead>
          <tbody>
           <?php $index='1'; ?>
               @foreach($new_values as $qr)
                 <tr>
                   <td><?php echo $index++; ?></td> 
                    <td>{{$qr->student_id}}</td> 
                    <td>{{$qr->university_email}}</td>
                     <td><img src="{{ asset('/qrcode/'.$qr->image)}}"></td> 
            
            </tr>
           @endforeach
           
          </tbody>
           <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Student-ID</th>
               <th scope="col">University Email</th>
              <th scope="col">Qrcode</th>

            </tr>
          </thead>
        </table>
</div>
</section>
@endsection
