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
            <h3>Discount Voucher List</h3>
           </div>
           <div class="right-block">
         <a href="add-discount">Add Discount </a>
         </div>
         </div>
        <div class="table-block" >
          <table  id="myTable">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Vendor Name</th>
                <th scope="col">Category</th>
                <th scope="col">Title</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                 <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
               <?php $index='1'; ?>
              @foreach($voucher_aval as $voucher)
              <tr>
                <td><?php echo $index++; ?></td>
                <td>{{ $voucher->first_name }} {{ $voucher->last_name }}</td>
                <td>{{ $voucher->name }}</td>
                <td>{{ $voucher->title }}</td>
                <td>{{ $voucher->start_date }}</td>
                <td>{{ $voucher->end_date }}</td>
                <td class="edit-btn">
                <a href="{{url('voucher-view/'.$voucher->id)}}"> <i class="fa fa-eye"></i></a>
                <a href="{{ url('editvoucher/'.$voucher->id)}}"><i class='fas fa-edit'></i></a>
                <!-- <a href="{{ url('deletevoucher/'.$voucher->id)}}"><i class='fas fa-trash-alt'></i></a> -->

                 <form action="{{ url('deletevoucher/'.$voucher->id)}}" method="post">
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
                <th scope="col">No.</th>
                <th scope="col">Vendor Name</th>
                <th scope="col">Category</th>
                <th scope="col">Title</th>
                 <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                 <th scope="col">Action</th>
              </tr>
            </thead>
          </table>
</div>

</section>
@endsection