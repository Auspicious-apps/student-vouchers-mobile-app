@extends('admin/layouts/app')

@section('content')
<section class="add-ctegory-main-block">
   <div class="subs-heading">
              @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif

         </div>
         <div class="heading">
          <div class="left-block">
            <h3>Category List</h3>
           </div>
           <div class="right-block">
       <a href="add-category">Add Category </a>
         </div>
         </div>
           <div class="table-block" >
           <div class="table-block" >
            <table id="myTable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Action</th>
               
                </tr>
              </thead>
              <tbody>
                <?php $index='1'; ?>
                @foreach($Category as $Categories)
                <tr>
                 <td><?php echo $index++; ?></td>
                    <td><img src="{{ asset('category/'.$Categories->image) }}" width="70px" height="70px" alt="Image">
                    </td>
                     <td>{{$Categories->name}}</td>
                    <td class="edit-btn">
                     
                      <a href="{{ url('edit-category/'.$Categories->id)}}" ><i class='fas fa-edit'></i></a>
                   
                  <!--   <button id="editBtn" data-id = "{{ $Categories->id }}" type="button"><i class='fas fa-edit'></i></button> -->
                       <form action="{{ url('delete-category/'.$Categories->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class='fas fa-trash-alt'></i></button>
                        </form>
                      
                    </td>
                </tr>
               @endforeach
              </tbody>
               <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Action</th>
               
                </tr>
              </thead>
            </table>
           
</div>
 
</section>
@endsection