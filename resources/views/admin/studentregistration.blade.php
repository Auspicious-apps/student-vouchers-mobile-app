@extends('admin/layouts/app')

@section('content')

<section class="add-ctegory-main-block">
         <div class="heading">
          <div class="left-block">
            <h3>Student Registration List</h3>
           </div>
          <!--  <div class="right-block">
           <a >Add Student</a>
         </div> -->
         </div>
           <div class="table-block" >
            <table  id="myTable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Student-Id</th>
                  <th scope="col">University Id</th>
                   <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php $index='1'; ?>
                 @foreach($students as $student)
                <tr>
                   <td><?php echo $index++; ?></td>
                   <?php if($student->image==null){?>
                   <td> <img src="{{ asset('images/im.jpg') }}" width="70px" height="70px" alt="Image"></td>
                   <?php }else{?>
               <td> <img src="{{ asset('category/'.$student->image) }}" width="70px" height="70px" alt="Image"></td>
               <?php  } ?>
                    <td>{{$student->first_name}} {{$student->last_name}}</td> 
                        <td>{{$student->student_id}}</td> 
                          <td><img src="{{ asset('category/'.$student->university_id_photo) }}" width="70px" height="70px" alt="Image"></td>    
                    <td class="edit-btn">
                        <a href="{{url('approvedstudent/'.$student->user_id)}}" class="btn btn-danger">Approve</a>
                        <a href="{{url('rejectstudent/'.$student->user_id)}}" style="color: red;" class="btn btn-light">Reject</a>    
                    </td>
                </tr>
               @endforeach
              </tbody>
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Student-Id</th>
                  <th scope="col">Email Id</th>
                   <th scope="col">Action</th>
                </tr>
              </thead>
            </table>
</div>
</section>
@endsection