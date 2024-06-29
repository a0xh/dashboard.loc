<tr>
    <th scope="row">
        <span class="badge bg-primary">
            @isset($childCategory->id)
                @if ($childCategory->id <= 9)
                    0{{ $childCategory->id }}
                @else
                    {{ $childCategory->id }}
                @endif
            @endisset
        </span>
    </th>

    <td>
        <span class="fw-bold ms-1">
            {{ $childCategory->title ?? null }}
        </span>
    </td>

    <td>{{ $childCategory->slug ?? null }}</td>

    <td>
        @isset ($childCategory->category_id)
            <span class="fw-bold ms-1">
                {{ $category->title ?? null }}
            </span>
        @else
            <span class="badge bg-warning">✖</span>
        @endisset
    </td>

    <td>{{ $childCategory->user->first_name ?? null }} {{ $childCategory->user->last_name ?? null }}</td>

    <td>
        @if ($childCategory->status->value)
            <span class="badge bg-success">
                {{ __('Опубликовано') }}
            </span>
        @else
            <span class="badge bg-danger">
                {{ __('Не опубликовано') }}
            </span>
        @endif
    </td>

    <td>{{ $childCategory->created_at ?? null }}</td>

    <td>
        <div class="btn-group" role="group" aria-label="childCategories">
            <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-outline-secondary">
                <i class="icofont-edit text-success"></i>
            </a>
            
            <form onsubmit="if (confirm('Вы действительно хотите удалить данную запись из таблицы?')) {return true} else {return false}" action="{{ route('admin.category.delete', $category) }}" method="post">

                @method('DELETE')
                @csrf
                
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="icofont-ui-delete text-danger"></i>
                </button>
            </form>
        </div>
    </td>
</tr>

@if ($childCategory->categories)
    @foreach ($childCategory->categories as $childCategory)
        @include('category.partials._parent', ['childCategory' => $childCategory])
    @endforeach
@endif
