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
                <!--<th scope="col">Voucher ID</th>-->
                <th scope="col">Student ID</th>
                 <th scope="col">Amount</th>
                <!--<th scope="col">End Date</th>
                 <th scope="col">Action</th> -->
              </tr>
            </thead>
            <tbody>
               <?php $index='1'; ?>
              @foreach($vouchersolds as $voucher_sold)
              <tr>
                <?php $vendor = App\User::where('id',$voucher_sold->user_id)->first();?>
                <td><?php echo $index++; ?></td>
                <td><?php echo $vendor->first_name; echo " "; echo $vendor->last_name;  ?></td>
                <!--<td>{{ $voucher_sold->voucher_id }}</td>-->
                <td>{{ $voucher_sold->student_id }}</td>
                <td>{{ $voucher_sold->amount }}</td>
             </tr>
             @endforeach
            </tbody>
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Vendor Name</th>
                <!--<th scope="col">Voucher ID</th>-->
                <th scope="col">Student ID</th>
                 <th scope="col">Amount</th>
                <!--<th scope="col">End Date</th>
                 <th scope="col">Action</th> -->
              </tr>
            </thead>
          </table>
</div>

</section>
@endsection