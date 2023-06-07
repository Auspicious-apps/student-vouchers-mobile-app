@extends('admin/layouts/app')

@section('content')

       <section class="add-ctegory-main-block">
         <div class="subs-heading">
            <h2>Voucher</h2>
         </div>
         @foreach($voucher_aval as $voucher)
         <div class="add-ctegory-formouter Voucher-view"> 
            <div class="add-ctegory-form form-feild-outer" >
                <div class="voucher-hed">
                    <div class="voucher-hed-img">
                       <img src="{{ asset('category/'.$voucher->image) }}" width="150px" height="100px" alt="Image">
                    </div>
                    <div class="voucher-hed-text">
                       <h3>{{$voucher->first_name}} {{$voucher->last_name}}</h3>
                       <h5>{{$voucher->name}}</h5>
                       <h4>{{$voucher->title}}</h4>
                    </div>
                </div>
                <div class="voucher-dis">  
                    <p>{{$voucher->description}}</p>   
                </div>
                <div class="voucher-list">
                    <ul>
                        <li><label>Voucher quantity:</label><p>{{$voucher->vou_quantity}}</p></li>
                        <li><label>Voucher Value:</label><p>{{$voucher->vou_value}}</p></li>
                        <li><label>Offer Type:</label><p>{{$voucher->amount}}   {{$voucher->offer_type}}</p></li>
                        <li><label>Start date & End date:</label><p>{{$voucher->start_date}} to {{$voucher->end_date}}</p></li>
                        <li><label>URL of the Brand:</label><p>{{$voucher->brand_url}}</p></li>
                        <li><label>Voucher Code:</label><p>{{$voucher->vou_code}}</p></li>
                    </ul>
                </div>

            </div>
         </div>
         @endforeach
       </section>
@endsection