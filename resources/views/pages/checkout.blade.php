@extends('layouts.checkout')
@section('title','Checkout')


@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                Travel Packet
                            </li>
                            <li class="breadcrumb-item">
                                Details
                            </li>
                            <li class="breadcrumb-item active">
                                Checkout
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <h1 style="font-weight: bold;">Who is going?</h1>
                        <p>
                            Trip to {{ $item->travel_package->title }},  {{ $item->travel_package->location }}
                        </p>
                        <div class="attendee">
                            <table class="table table-responsive-sm text-center">
                                <thead>
                                    <tr>
                                        <td>Picture</td>
                                        <td>Name</td>
                                        <td>Nationality</td>
                                        <td>Visa</td>
                                        <td>Passport</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item->details as $detail)
                                    <tr>
                                        <td>
                                            <img src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                                             height="60">
                                        </td>
                                         <td class="align-middle">
                                             {{ $detail->username }}
                                         </td>
                                         <td class="align-middle">
                                             {{ $detail->nationality }}
                                         </td>
                                         <td class="align-middle">
                                            {{ $detail->is_visa ? '30 Days' : 'N/A' }}
                                        </td>
                                         <td class="align-middle">
                                             {{ \Carbon\Carbon::createFromDate($detail->doe_passport)>
                                             \Carbon\Carbon::now() ? 'Active' : 'Inactive' }}
                                         </td>
                                         <td class="align-middle">
                                             <a href="{{ route('checkout_remove', $detail->id) }}">
                                                 <img src="{{ url('frontend/images/remove.jpg') }}" alt="">
                                             </a>
                                         </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Visitor</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="member mt-3">
                            <h2 style="font-weight: bold;">Add Member</h2>
                            <form action="{{ route('checkout_create' , $item->id) }}" class="form-inline" method="POST">
                                @csrf
                                <label for="username" class="sr-only">Name</label>
                                <input type="text" 
                                class="form-control mb-2 mr-sm-2" 
                                name="username"
                                id="username"
                                placeholder="Username">

                                <label for="nationality" class="sr-only">Name</label>
                                <input type="text" 
                                style="width: 50px"
                                required
                                class="form-control mb-2 mr-sm-2" 
                                name="nationality"
                                id="nationality"
                                placeholder="Nationality">

                                <label for="is_visa" class="sr-only">Visa</label>
                                <select name="is_visa" id="is_visa" class="custom-select mb-2 mr-sm-2" required>
                                    <option value="VISA">VISA</option>
                                    <option value="1">30 Days</option>
                                    <option value="0" selected>N/A</option>
                                </select>

                                <label for="doe_passport" class="sr-only">DOE Passport</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="text" class="form-control datepicker" style="width:130px" id="doePassport" name="doe_passport" placeholder="DOE Passport">
                                </div>
                                <button type="submit" class="btn btn-add-now mb-2 px-4">
                                    Add Now
                                </button>
                            </form>
                            <h3 class=" mt-2 mb-0" style="font-weight: 600; font-size: 14px;
                            color: #071c4d;">Note</h3>
                            <p class=" mb-0" style="font-size: 14px;">You are only able to invite member that registered in Dino.</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 my-2 my-lg-0" >
                    <div class="card card-details card-right">
                        <h2>Checkout Information</h2>
                        <hr>
                        <table class="trip-informations">
                            <tr>
                                <th width="50%">
                                   Members
                                </th>
                                <td width="50%" class="text-right">{{ $item->details->count() }}</td>
                            </tr>
                            <tr>
                                <th width="50%">
                                   Additional VISA
                                </th>
                                <td width="50%" class="text-right">Rp {{ $item->additional_visa }}</td>
                            </tr>
                            <tr>
                                <th width="50%">
                                    Trip Price
                                </th>
                                <td width="50%" class="text-right"> @money($item->travel_package->price) </td>
                            </tr>
                            <tr>
                                <th width="50%">
                                    Sub Total
                                </th>
                                <td width="50%" class="text-right"> @money($item->transaction_total) </td>
                            </tr>
                            <tr>
                                <th width="50%">
                                    Total (+Unique)
                                </th>
                                <td width="50%" class="text-right">
                                    <span class="text-orange ">@money($item->transaction_total+=mt_rand(3,999)) </span>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <h2>Payment Instructions</h2>
                        <hr>
                        <p class="payment-instructions">Please complete your payment before to continue
                            the wonderful trip.
                        </p>
                        <div class="bank">
                            <div class="bank-item pb-3">
                                <img src="{{ url('frontend/images/Bank.png') }}" class="bank-image">
                                <div class="description">
                                    <h3>PT Dino ID</h3>
                                    <p>8881 8833 9900 2030 <br>
                                    Mandiri</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="bank-item pb-3">
                                <img src="{{ url('frontend/images/Bank.png') }}" class="bank-image">
                                <div class="description">
                                    <h3>PT Dino ID</h3>
                                    <p>8822 8855 9900 2030 <br>
                                    BCA</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="join-container">
                        <a href="{{ route('checkout_success', $item->id) }}" class="btn btn-block btn-join-now mt-3 py-2">
                            I have my payment
                        </a>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('detail',$item->travel_package->slug) }}" class="text-muted">Cancel Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</main>
    
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}">
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        uiLibrary : 'bootstrap4',
        icons : {
            rightIcon : '<img src="{{ url('frontend/images/date.jpg') }}"/>'
        }
    });
    });
</script>
@endpush