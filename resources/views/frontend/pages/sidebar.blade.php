<div class="row">
    <button>
        @foreach (getcategory() as $category)
            <a href="{{ route('products.filter', $category->id) }}">
                <ul class="list-unstyled">
                    <li>{{ $category->name }}</li>
                </ul>
            </a>
        @endforeach
    </button>
</div>
