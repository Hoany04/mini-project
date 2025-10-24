@extends('layouts.ClientLayout')

@section('content')
<div class="container py-5">
    <h3>Thanh toán đơn hàng #{{ $order->id }}</h3>
    <p>Tổng tiền: <strong>{{ number_format($order->total_amount) }} ₫</strong></p>

    <form action="{{ route('client.pages.payment.store', $order->id) }}" method="POST" id="payment-form">
        @csrf
        <label for="postal_code">Mã bưu chính</label>
        <input id="postal_code" name="postal_code" type="text" class="form-control" value="70000">
        {{-- <input type="hidden" name="stripeToken" id="stripeToken"> --}}
        <div id="card-element" class="mb-3"></div>
        <button class="btn btn-primary" id="submit">Thanh toán ngay</button>
    </form>
</div>

@endsection

@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config("services.stripe.key") }}');
    const elements = stripe.elements();
    const style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4"
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
        }
    };

    const cardElement = elements.create('card', {
        style: style,
        hidePostalCode: false 
    });

    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const {token, error} = await stripe.createToken(cardElement, {
            address_zip: document.getElementById('postal_code').value // 👈 gửi postal code thủ công
        });
        
        if (error) {
            alert(error.message);
        } else {
            const hidden = document.createElement('input');
            hidden.setAttribute('type', 'hidden');
            hidden.setAttribute('name', 'stripeToken');
            hidden.setAttribute('value', token.id);
            form.appendChild(hidden);
            console.log('form', form)
            HTMLFormElement.prototype.submit.call(form);
        }
    });
</script>
@endsection
