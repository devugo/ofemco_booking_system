<section class="home-newsletter">
    <div class="container">
        <h3>Subscribe to our newsletter</h3>
        <form action="{{ route('subscriber.store') }}" method="POST">
            @csrf
            <input class="form-control newsletter-field" placeholder="Your Email" @error('email') is-invalid @enderror name="email" type="email" value="{{ old('email') }}" required />

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="submit" value="SUBSCRIBE" class="btn btn-subscribe" />
        </form>
    </div>
</section>