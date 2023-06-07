@extends('admin/layouts/app')

@section('content')
<body class="main-body ">
    <main class="bg-main">
       <section class="add-ctegory-main-block">
         <div class="subs-heading">
               @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif
            <h2>Add Category</h2>
           
         </div>
  
         <div class="add-ctegory-formouter">
            <div class="add-ctegory-form form-feild-outer" >
               <form action="{{ url('/add-category-data')}}" method="Post" enctype="multipart/form-data" >
                  @csrf
                  <div class="logoContainer">
                     <img src="images/Team-icon-placeholder.png">
                  </div>
                  <div class="fileContainer sprite">
                     <span>Choose image</span>
                     <input type="file"  name="image" value="Choose File">
                  </div>
                  <div class="form-feild">
                      <input type="text" name="name" placeholder="Category name">
                  </div> 
                  <div class="subscrition-form form-feild">
                     <div class="sub-category">
                     <h3>Sub category</h3>
                     <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                  </div>
                           <div class="row">
                                <div class="col-lg-12">
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                       
                                           
                                        </div>
                                    </div>

                                    <div id="newRow"></div>
                                 <!--    <button id="addRow" type="button" class="btn btn-info">Add Row</button> -->
                                </div>
                            </div>
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