<h5>Categories</h5>
<hr>
<ul class="list-group">
    @foreach($categories as $category)
        <a href="{{ route('welcome') }}?category={{ $category->name }}" class="link-underline-primary">
            <li role="button" class="text-light list-group-item mb-2 bg-primary">
                {{ $category->name }}
            </li>
        </a>
    @endforeach
</ul>