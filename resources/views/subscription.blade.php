@extends('layouts.app')

@section('content')


   
<div class="container">
    <h2>あなたは{{ $isSubscribed ? "有料" : "無料" }}会員です。</h2>

    @if ($isSubscribed)
        契約のキャンセルはこちらから
        <form method="POST" action="{{route('stripe.cancel') }}">
            @csrf
            <button class="btn btn-success mt-2">キャンセルする</button>
        </form>
    @else
    <div class="p-4 bg-white border-b border-gray-200">
        <h2>サブスクリプション</h2>
        <form id="setup-form" action="{{ route('subscribe.post') }}" method="post">
            @csrf
            <input id="card-holder-name" type="text" placeholder="カード名義人">
            <div id="card-element"></div>
            <button id="card-button" data-secret="{{ $intent->client_secret }}">
                サブスクリプション
            </button>
        </form>
    </div>
    @endif

</div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('pk_test_51PlsqRGRKUFslzadxOVYnYBuDxFgS0iJ4xyighkEFWxppEVSyI1uVTqYBfVXlocqxD3klPrbVP2n8sMamTvN2BvT00EiTaC5xT');
          
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardButton.addEventListener('click', async (e) => {
                e.preventDefault();
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    // Display "error.message" to the user...
                    console.log(error);
                } else {
                    // The card has been verified successfully...
                    stripePaymentIdHandler(setupIntent.payment_method);
                }
            });

            function stripePaymentIdHandler(paymentMethodId) {
                // Insert the paymentMethodId into the form so it gets submitted to the server
                const form = document.getElementById('setup-form');

                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethodId');
                hiddenInput.setAttribute('value', paymentMethodId);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        </script>
    @endpush
@endsection