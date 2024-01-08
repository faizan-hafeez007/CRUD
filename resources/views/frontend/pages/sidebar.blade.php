<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="row">
    <div class="btn-group">
        @foreach (getcategory() as $category)
            <a href="{{ route('products.filter', ['id' => $category->id]) }}"
                class="btn list_category category_{{ $category->id }}" data-category="{{ $category->id }}">
                <ul class="list-unstyled">
                    <li class="btn border-t-neutral-900 ">
                        {{ $category->name }}
                    </li>
                </ul>
            </a>
        @endforeach
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.btn-group a').click(function() {

            var categoryId = $(this).data('category');
            storeCategory(categoryId);
        });

        $('form').submit(function() {
            $('#category').val(getSelectedCategory());
        });
    });
    //store category
    function storeCategory(categoryId) {
        localStorage.setItem('selectedCategory', categoryId);
    }
    //get category
    function getSelectedCategory() {
        return localStorage.getItem('selectedCategory');
    }
    // Highlight the Selected Category
    $(".category_" + getSelectedCategory()).addClass('active');
</script>
