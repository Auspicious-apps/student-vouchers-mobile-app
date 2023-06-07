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
              <th scope="col">Name</th>
              <th scope="col">Student-ID</th>
              <th scope="col">Email-ID</th>
              <th scope="col">University Email</th>
              <th scope="col">University Id</th>
             <!--  <th scope="col">Expire Date</th>
              <th scope="col">No. of Offer & Dist Reedemed</th> -->
               <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              <?php $index='1'; ?>
          
               @foreach($students as $student)
                 <tr>
                   <td><?php echo $index++; ?></td> 
                   <td>{{$student->first_name}} {{$student->last_name}}</td>
                    <td>{{$student->student_id}}</td> 
                      <td>{{$student->email}}</td> 
                      
                    <td>{{$student->university_email}}</td>
                         <?php if($student->university_id_photo==null){?>
                   <td></td>
                   <?php }else{?>
               <td><img src="{{ asset('category/'.$student->university_id_photo) }}" width="70px" height="70px" alt=""></td> 
               <?php  } ?>
              
              <td class="edit-btn">
                <?php if($student->is_blocked == 1){?>
               <a href="{{url('blockedstudent/'.$student->user_id)}}" ><i class='fas fa-ban blocked'></i><a>
              <?php  }else{ ?>
                 <a href="{{url('blockedstudent/'.$student->user_id)}}" ><i class='fas fa-ban'></i><a>
                 <?php } ?>
                 <!--  <a href="{{url('qr/'.$student->user_id)}}" >scan<a> -->
                
               <!--<i class='fas fa-trash-alt'></i></td>-->
            
            </tr>
           @endforeach
           
          </tbody>
           <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Student-ID</th>
              <th scope="col">Email-ID</th>
              <th scope="col">University Email</th>
               <th scope="col">University Id</th>
              <!-- <th scope="col">Expire Date</th>
              <th scope="col">No. of Offer & Dist Reedemed</th> -->
               <th scope="col">Action</th>
            </tr>
          </thead>
        </table>
</div>
</section>
@endsection