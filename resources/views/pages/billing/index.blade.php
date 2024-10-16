<x-default-layout>

    @section('title')
    Billing
    @endsection

    <div class="card">
    @if (session('success'))
            <div class="row">
                <div class="alert alert-success text-center">{{session('success')}}</div>
            </div>
        @elseif (session('error'))
            <div class="row">
                <div class="alert alert-danger text-center">{{session('error')}}</div>
            </div>
        @endif
                                
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Plans-->
            <div class="d-flex flex-column">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h1 class="fs-2hx fw-bold mb-5">Choose Your Plan</h1>
                </div>
                <!--end::Heading-->
                <!--begin::Row-->
                    <div class="row g-10">
                        @foreach ($plans as $plan)
                            <!--begin::Col-->
                            <div class="col-xl-4">
                                <div class="d-flex h-100 align-items-center">
                                    <!--begin::Option-->
                                    <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                        <!--begin::Heading-->
                                        <div class="mb-7 text-center">
                                            <!--begin::Title-->
                                            <h1 class="text-gray-900 mb-5 fw-bolder">{{ $plan->name }}</h1>
                                            <!--end::Title-->
                                            <!--begin::Price-->
                                            <div class="text-center">
                                                <span class="mb-2 text-primary">$</span>
                                                <span class="fs-3x fw-bold text-primary">{{ $plan->price }}</span>
                                                <span class="fs-7 fw-semibold opacity-50">/ 
                                                <span data-kt-element="period">Mon</span></span>
                                            </div>
                                            <!--end::Price-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Select-->
                                        <a href="{{ route('subscription.StripeCheckout', ['plan' => $plan->stripe_plan]) }}" class="btn btn-sm btn-primary">Select</a>
                                        <!--end::Select-->
                                    </div>
                                    <!--end::Option-->
                                </div>
                            </div>
                            <!--end::Col-->
                        @endforeach
                    </div>
                    <!--end::Row-->

            </div>
            <!--end::Plans-->
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>