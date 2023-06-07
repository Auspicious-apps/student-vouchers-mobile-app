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
                  <h3>Vendor List</h3>
               </div>
               <div class="right-block">
              <a href="add-vendor">Add Vendor </a>
             </div>
         </div>
        <div class="table-block" >
        
          <table  id="myTable">
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
            <?php  $vou = App\Voucher_aval::where('user_id',$vendor->id)->count();
            $vou_sold = App\Voucher_sold::where('user_id',$vendor->id)->count();
            $vou_aval = $vou - $vou_sold; 
            $amount = App\Voucher_sold::where('user_id',$vendor->id)->sum('amount') ?>
              <tr>
               <td> <?php echo $index++; ?></td> 
                   <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
                    <td>{{$vendor->email}}</td> 
                <td>{{$vendor->phone}}</td>

                <td><?php echo $vou; ?></td>
                <td><?php echo $vou_sold; ?></td>
                <td><?php echo $amount; ?></td>
                <td><?php echo $vou_aval; ?></td>
                <td class="edit-btn">
                   <a href="{{url('edit-vendor/'.$vendor->id)}}"><i class='fas fa-edit'></i></a>
                    <?php if($vendor->is_blocked == 1){?>
               <a href="{{url('blockedvendor/'.$vendor->id)}}" ><i class='fas fa-ban blocked'></i><a>
              <?php  }else{ ?>
                 <a href="{{url('blockedvendor/'.$vendor->id)}}" ><i class='fas fa-ban'></i><a>
                 <?php } ?>
                 
                 
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
        <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Vendor</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
  
        <div class="add-ctegory-formouter">
            <div class="add-ctegory-form form-feild-outer" >
               <form>
                 <div class="form-feild">
                    <input type="text" id="category-name" name="first_name" placeholder="Vendor First Name">
                </div>
                 <div class="form-feild">
                    <input type="text" id="category-name" name="last_name" placeholder="Vendor Last Name">
                </div>
                <div class="form-feild">
                    <input type="email" id="category-name" name="email" placeholder="Vendor Email">
                </div>    
                <div class="form-feild">
                    <input type="password" id="category-name" name="password" placeholder="Password">
                </div>
                <div class="form-feild">
                    <input type="tel" id="category-name" name="phone" placeholder="Phone Number">
                </div>
                  <div class="form-feild">
                      <input type="text" id="category-name" name="amount" placeholder="Amount Earned">
                  </div>  
                  
                 <!--  <div class="subscription-form-item-btn">
                      <button type="submit" value="Save">Save</button>
                    </div>
               </form> -->

            </div>
         </div>
        </div>
        <div class="modal-footer">
        
          <div class="subscription-form-item-btn"> 
                       <button type="submit" value="Save">Save</button>
                    </div>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
        </div>
      </div>
    </div>
  </div>
 
</section>
@endsection