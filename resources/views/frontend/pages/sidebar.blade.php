<div class="row">
    <div class="btn-group">
        @foreach (getcategory() as $category)
            <a href="{{ route('products.filter', ['id' => $category->id]) }}" class="btn">
                <ul class="list-unstyled">
                    <li class="btn border-t-neutral-900">
                        {{ $category->name }}
                    </li>
                </ul>
            </a>
        @endforeach
    </div>
</div>
