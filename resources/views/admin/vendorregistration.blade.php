@extends('admin/layouts/app')

@section('content')

<section class="add-ctegory-main-block">
         <div class="heading">
          <div class="left-block">
            <h3>Vendor Registration List</h3>
           </div>
           <div class="right-block">
           <a href="add-vendor">Add vendor</a>
         </div>
         </div>
           <div class="table-block" >
        <div class="table-block" >
         
          <table  id="myTable" class="table-width">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email-ID</th>
                <th scope="col">Phone-Number</th>
                <th scope="col">Voucher Added</th>
                <th scope="col">Voucher Sold</th>
                <th scope="col">Amount Earned</th>
                 <th scope="col">Voucher Available</th>
                 <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $index='1'; ?>
             @foreach($vendors as $vendor)
              <?php  $vou = App\Models\Voucher_aval::where('user_id',$vendor->id)->count();?>
                <tr>
                   <td><?php echo $index++; ?></td> 
                   <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
                    <td>{{$vendor->email}}</td> 
                      <td>{{$vendor->phone}}</td>
                    <td><?php echo $vou; ?></td>
                <td>0</td>
                <td>0</td>
                <td><?php echo $vou; ?></td>
                    <td class="edit-btn">
                         <a href="{{url('approved',$vendor->user_id)}}" class="btn btn-danger">Approve</a>
                        <a href="{{url('reject',$vendor->user_id)}}" style="color: red;" class="btn btn-light">Reject</a>       
                    </td>
                </tr>
               @endforeach

             
            </tbody>
             <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email-ID</th>
                <th scope="col">Phone-Number</th>
                <th scope="col">Voucher Added</th>
                <th scope="col">Voucher Sold</th>
                <th scope="col">Amount Earned</th>
                 <th scope="col">Voucher Available</th>
                 <th scope="col">Action</th>
              </tr>
            </thead>
          </table>
        </div>
</section>
@endsection