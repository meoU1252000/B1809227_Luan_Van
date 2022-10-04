@if (count($category['childrenCategories']) > 0)
<ul class="dropdown-menu dropdown-submenu">
@foreach($category['childrenCategories'] as $category)
    @if (count($category['childrenCategories']) > 0)
    <li>
      <a class="dropdown-item" href="#">{{$category->category_name}} &raquo;</a>
      @include('clients.treeCategory')
    
   
    @else
    <li>
      <a class="dropdown-item" href="#">{{$category->category_name}}</a>
    </li>
    @endif
@endforeach
</ul>
</li>
@endif