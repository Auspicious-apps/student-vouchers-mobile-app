@extends('admin/layouts/app')

@section('content')
<body class="main-body ">
    <main class="bg-main">
       <section class="add-ctegory-main-block">
         <div class="subs-heading">
              @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif
            <h2>Add Vendor</h2>
         </div>

         <div class="add-ctegory-formouter">
            <div class="add-ctegory-form form-feild-outer" >
               <form action="{{ url('/add-vendor-data')}}" method="Post">
                @csrf
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
                      <input type="text" id="category-name" name="amount" placeholder="Amount Earned" hidden>
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