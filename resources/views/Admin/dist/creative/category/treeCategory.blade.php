@if (count($category['childrenCategories']) > 0)
@foreach($category['childrenCategories'] as $category)
<option value="{{ $category['id']}}" name="category_parent">
@for ($i = 0; $i < $count; $i++)
{{"--"}}
@endfor
{{$category['category_name']}}</option>
    @include('Admin.dist.creative.category.treeCategory',['count'=>$count+2])
@endforeach

@endif
