<div class="row">
    <div class="col-12">
        <form action="{{ route('offer-adds-product.store') }}" method="POST">
            @csrf
            <input type="hidden" name="master_id" value="{{$OfferAdds->id}}" />
            @foreach($products as $product)
                <div class="form-check">
                    <input type="checkbox" name="products[]" class="form-check-input" value="{{ $product->id }}">
                    <label class="form-check-label">{{ $product->name }}</label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary mt-3">Add Selected Products</button>
        </form>
    </div>
</div>
