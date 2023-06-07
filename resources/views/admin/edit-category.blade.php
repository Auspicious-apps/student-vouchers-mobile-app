 
  @extends('admin/layouts/app')

@section('content')
       <section class="add-ctegory-main-block">
         <div class="subs-heading">
               @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif
            <h2>Edit Category</h2>
           
         </div>
  
        <div class="add-ctegory-formouter">
            <div class="add-ctegory-form form-feild-outer" >
               <form action="{{ url('update-category/'.$Category->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                 <!--  <input type="text" id="id"> -->
                  <div class="logoContainer">
                       <img src="{{ asset('category/'.$Category->image) }}" width="150px" height="100px" alt="Image">
                     </div>
                     <div class="fileContainer sprite">
                     <span>Choose image</span>                     
                     <input type="file"  name="image">
                  </div>
                  <div class="form-feild">
                      <input type="text" id="name" name="name" value="{{$Category->name}}">
                  </div> 
                
                
                               <div class="subscrition-form form-feild">
                                <div class="sub-category">
                     <h3>Sub category</h3>
                     <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                  </div>
                           <div class="row">
                                <div class="col-lg-12">
                                    <?php $index='0'; ?>
                                    @foreach($subcategory as $cat)
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" name="sub[<?php echo $index++; ?>][{{$cat->id}}]" class="form-control m-input form-feild" placeholder="Enter title" autocomplete="off" value="{{$cat->name}}">
                                            <div class="input-group-append">
                                                <button id="remove" class="removeRow" type="button" class="btn btn-danger">Remove</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                        @endforeach
                                   
                                </div>
                            </div>
                  </div>
                              <div class="subscrition-form form-feild">
                                
                           <div class="row">
                                <div class="col-lg-12">
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                         
                                        </div>
                                    </div>

                                    <div id="newRow"></div>
                                   <!--  <button id="add" type="button" class="btn btn-info">Add Row</button> -->
                                </div>
                            </div>
                  </div>
                  
                  <div class="subscription-form-item-btn"> 
                       <button type="submit" value="Save">Save</button>
                    </div>
               </form>

            </div>
       </section>

    
@endsection


























