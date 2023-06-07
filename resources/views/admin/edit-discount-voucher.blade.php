@extends('admin/layouts/app')

@section('content')

<!-- <body class="main-body ">
    <main class="bg-main"> -->
       <section class="add-ctegory-main-block">
         <div class="subs-heading">
              @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif

         </div>
         <div class="subs-heading">
            <h2>Edit Discount Voucher</h2>
         </div>

         <div class="add-ctegory-formouter">
            <div class="add-ctegory-form form-feild-outer" >
               <form action="{{ url('updatevoucher/'.$voucher_aval[0]->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 @method('put')
                <div class="form-feild">
                     @foreach($subcategory as $cats)
                    <input type="hidden" name="sub_id" id="sub_id" value="{{ $cats->id}}">
                    @endforeach
                   <select id="name" name="vendor_id" class="form-control input-sm">
                        <option>Select vendor<option>
                          
                            <option value="{{ $voucher_aval[0]->user_id}}" selected>{{ $voucher_aval[0]->first_name }} {{ $voucher_aval[0]->last_name }}<option>
                             @foreach($vendor as $vend)
                             <?php if($vend->id == $voucher_aval[0]->user_id ){?>
                            <option value="{{ $vend->id}}" hidden>{{ $vend->first_name }} {{ $vend->last_name }}<option>
                           <?php }else 
                           {?>
                             <option value="{{ $vend->id}}" >{{ $vend->first_name }} {{ $vend->last_name }}<option>
                          <?php }
                           ?>
                            @endforeach
                    </select>
                </div>

        
                <div class="form-feild">
                      <select id="category" name="category_id" class="form-control input-sm">
                         <option>Select category<option>
                        
                            <option value="{{ $voucher_aval[0]->category_id}}" selected>{{ $voucher_aval[0]->name }}<option>
                                 @foreach($category as $cats)
                                  <?php if($cats->id == $voucher_aval[0]->category_id ){?>
                            <option value="{{ $cats->id}}" hidden>{{ $cats->name }}<option>
                                 <?php }else 
                           {?>
                             <option value="{{ $cats->id}}">{{ $cats->name }}<option>
                                <?php }
                           ?>
                                 @endforeach
                         
                    </select>
                </div>
                <div class="form-feild">
                <select id="subcategories" name="subcategories_id">
                 @foreach($subcategory as $cats)
                   <option value="{{ $cats->id}}">{{ $cats->name }}<option>
                    @endforeach                    
                </select>
                </div>
                <div class="form-feild">
                    <input type="text" placeholder="Title" name="title" value="{{$voucher_aval[0]->title}}">
                </div>
                <div class="form-feild">
                    <label for="description">Description</label>
                    <input id="w3review"  rows="3" cols="50" placeholder="Description" name="description" value="{{$voucher_aval[0]->description}}"></input>
                </div>
                 <div class="form-feild">
                    <label for="terms_conditions">Terms & Conditions</label>
                      <input type="text"  name="terms_conditions" placeholder="Terms and Conditions" value="{{$voucher_aval[0]->terms_conditions}}">
                  </div> 

                <div class="from-feild-grid">
                    <div class="form-feild">
                        <label>Voucher Quantity</label>
                        <input type="number" name="vou_quantity" placeholder="0" value="{{$voucher_aval[0]->vou_quantity}}">
                    </div>
                    <div class="form-feild">
                        <label>Voucher Value</label>
                        <input type="number" name="vou_value" placeholder="0" value="{{$voucher_aval[0]->vou_value}}">
                    </div>
                </div>
                <div class="from-feild-grid percent-grid">
                    <div class="form-feild">
                
                     <span class="js-order-discount-percent order-total-toggle-on input-group-addon addon-icon order-total-toggle-on" data-form-toggle-group="orderDiscount" data-form-toggle="#orderDiscountPercent" data-form-toggle-selected="true">Percentage</span>
                      <span class="js-order-discount-fixed order-total-toggle-off input-group-addon addon-icon order-total-toggle-off" data-form-toggle-group="orderDiscount" data-form-toggle="#orderDiscountFixed">Fixed Amount</span>
                    </div>
                    <div class="form-feild ">
                          @if($voucher_aval[0]->offer_type == "percentage")
                        <input type="text" id="orderDiscountPercent" name="orderDiscountPercent" class=" text-right" value="{{$voucher_aval[0]->amount}}"  placeholder="1">
                        <div class="orderDiscountPercent">%</div>
                        @elseif($voucher_aval[0]->offer_type == "fixed")
                      <input type="text" id="orderDiscountFixed" name="orderDiscountFixed" class="text-left" value="{{$voucher_aval[0]->amount}}"  placeholder="0.00" selected>
                      <div class="orderDiscountFixed">$</div>
                      @endif
                     
                     
                    </div>
                </div>

                <div class="from-feild-grid date-feild">
                    <div class="form-feild">
                        <label for="startDate">Start Date</label>
                        <input id="startDate" name="start_date" type="date" value="{{$voucher_aval[0]->start_date}}" />
                        <!-- <div class="calender-img"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.0281 2H13V3.27187C13 3.975 12.275 4.5 11.525 4.5C10.775 4.5 10 3.975 10 3.27187V2H6V3.27187C6 3.975 5.25 4.5 4.5 4.5C3.75 4.5 3 3.975 3 3.27187V2H1.97187C1.43437 2 1 2.41563 1 2.91875V14.0906C1 14.5938 1.43437 15 1.97187 15H14.0281C14.5656 15 15 14.5938 15 14.0875V2.91875C15 2.41563 14.5656 2 14.0281 2ZM13.5 13.1219C13.5 13.3281 13.3188 13.4969 13.1 13.4969L2.89687 13.5C2.67812 13.4906 2.5 13.325 2.5 13.1187V5.88438C2.5 5.66875 2.68438 5.5 2.91563 5.5H13.0875C13.3156 5.5 13.5 5.66563 13.5 5.87813V13.1219Z" fill="black"/>
                            <path d="M5.5 3C5.5 3.55312 5.05313 4 4.5 4C3.94687 4 3.5 3.55312 3.5 3V2C3.5 1.44687 3.94687 1 4.5 1C5.05313 1 5.5 1.44687 5.5 2V3Z" fill="black"/>
                            <path d="M12.5 3C12.5 3.55312 12.0531 4 11.5 4C10.9469 4 10.5 3.55312 10.5 3V2C10.5 1.44687 10.9469 1 11.5 1C12.0531 1 12.5 1.44687 12.5 2V3Z" fill="black"/>
                            </svg>
                            </div> -->
                    </div>
                    <div class="form-feild">
                        <label for="endDate">End Date</label>
                        <input id="endDate" name="end_date" type="date"  value="{{$voucher_aval[0]->end_date}}"/>
                       <!--  <div class="calender-img"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.0281 2H13V3.27187C13 3.975 12.275 4.5 11.525 4.5C10.775 4.5 10 3.975 10 3.27187V2H6V3.27187C6 3.975 5.25 4.5 4.5 4.5C3.75 4.5 3 3.975 3 3.27187V2H1.97187C1.43437 2 1 2.41563 1 2.91875V14.0906C1 14.5938 1.43437 15 1.97187 15H14.0281C14.5656 15 15 14.5938 15 14.0875V2.91875C15 2.41563 14.5656 2 14.0281 2ZM13.5 13.1219C13.5 13.3281 13.3188 13.4969 13.1 13.4969L2.89687 13.5C2.67812 13.4906 2.5 13.325 2.5 13.1187V5.88438C2.5 5.66875 2.68438 5.5 2.91563 5.5H13.0875C13.3156 5.5 13.5 5.66563 13.5 5.87813V13.1219Z" fill="black"/>
                            <path d="M5.5 3C5.5 3.55312 5.05313 4 4.5 4C3.94687 4 3.5 3.55312 3.5 3V2C3.5 1.44687 3.94687 1 4.5 1C5.05313 1 5.5 1.44687 5.5 2V3Z" fill="black"/>
                            <path d="M12.5 3C12.5 3.55312 12.0531 4 11.5 4C10.9469 4 10.5 3.55312 10.5 3V2C10.5 1.44687 10.9469 1 11.5 1C12.0531 1 12.5 1.44687 12.5 2V3Z" fill="black"/>
                            </svg>
                            </div> -->
                    </div>
                </div>
                 
                 <div class="form-feild">
                      <label for="brand">Brand</label>
                      <input type="text" id="category-name" name="brand" placeholder="Brand Name"  value="{{$voucher_aval[0]->brand}}">
                  </div> 
                  <div class="form-feild">
                    <label for="brand_url">Brand Url</label>
                      <input type="text" id="category-name" name="brand_url" placeholder="URL of the Brand" value="{{$voucher_aval[0]->brand_url}}">
                  </div> 

                  <div class="form-feild">
                    
                    <label for="vouchercode">Voucher Code</label>
                    <input type="text" id="category-name" name="vou_code" placeholder="Voucher Code" value="{{$voucher_aval[0]->vou_code}}">
    
                </div> 
                <div class="form-feild">
                <label for="cimage">Upload Category Image</label>
                <img src="{{ asset('category/'.$voucher_aval[0]->image) }}" width="70px" height="70px" alt="Image">
                <input type="file" id="img" name="image" accept="image/*">
            </div>

            <div class="form-feild">
                 <label for="limage">Upload Logo Image</label>
                 <img src="{{ asset('category/'.$voucher_aval[0]->logo_image) }}" width="70px" height="70px" alt="Image">
                <input type="file" id="img" name="logo_image" accept="image/*">
            </div>

              <div class="form-feild">
                <label for="is_explore"><input type="checkbox" id="is_explore" name="is_explore" value="is_explore" class="text-left" checked>Is-Explore</label>     
              </div> 

               <div class="form-feild">
                <label for="category-index">Category Index</label>
                      <input type="text" id="category-index" name="category_index" placeholder="Category Index" value="{{$voucher_aval[0]->category_index}}">
              </div> 

               <div class="form-feild">
                    <label for="explore-Index">Explore Index</label>
                      <input type="text" id="explore-Index" name="explore_index" placeholder="Explore Index" value="{{$voucher_aval[0]->explore_index}}">
              </div> 

             
                  <div class="subscription-form-item-btn">
                      <button type="submit" value="Save">Save</button>
                    </div>
               </form>

            </div>
         </div>


       </section>
@endsection
    <!-- </main> -->

    <!-- </body> -->


   


