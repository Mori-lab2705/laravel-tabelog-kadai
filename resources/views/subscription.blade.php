@extends('layouts.app')

@section('content')


   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    サブスクリプション
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white border-b border-gray-200">
        <h2>サブスクリプション</h2>
        <form　id="setup-form">
            <div id="card-element"></div>
            <button id="card-button">
                サブスクリプション
            </button>
        </form>
    </div>

    



    <script src="https://js.stripe.com/v3/"></script>
      <script>

        const stripe = Stripe('your_private_key');

        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        console.log(cardHolderName.value)
        });

        stripe
        .confirmCardSetup('{SETUP_INTENT_CLIENT_SECRET}', {
            payment_method: {
            card: cardElement,
            billing_details: {
                name: 'Jenny Rosen',
            },
            },
        })
        .then(function(result) {
            // Handle result.error or result.setupIntent
        });
      </script>

      

      

@endsection