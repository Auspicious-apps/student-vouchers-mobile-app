@extends('admin/layouts/app')

@section('content')
<body class="main-body ">
    <main class="bg-main">
       <section class="add-ctegory-main-block">
         <div class="subs-heading">
              @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif
            <h2>Edit Vendor</h2>
         </div>

         <div class="add-ctegory-formouter">
            <div class="add-ctegory-form form-feild-outer" >
               <form action="{{url('update-vendor/'.$vendor->id)}}" method="Post">
                @csrf
                @method('put')
                <div class="form-feild">
                    <input type="text"  name="first_name" placeholder="Vendor First Name" value="{{$vendor->first_name}}">
                </div>
                 <div class="form-feild">
                    <input type="text"  name="last_name" placeholder="Vendor Last Name" value="{{$vendor->last_name}}">
                </div>
                <div class="form-feild">
                    <input type="email"  name="email" placeholder="Vendor Email" value="{{$vendor->email}}" readonly>
                </div>    
                <div class="form-feild">
                    <input type="password"  name="password" placeholder="Password" value="{{$vendor->plane_password}}">
                </div>
                <div class="form-feild">
                    <input type="tel" name="phone" placeholder="Phone Number" value="{{$vendor->phone}}">
                </div>
                  <div class="form-feild">
                      <input type="text"  name="amount" placeholder="Amount Earned" value="{{$vendor->amount}}" hidden>
                  </div> 
                  
                  <div class="subscription-form-item-btn">
                        <button type="submit" value="Save">Save</button>
                    </div>
               </form>

            </div>
         </div>
       </section>

    </main>
    
 </body>
@endsection