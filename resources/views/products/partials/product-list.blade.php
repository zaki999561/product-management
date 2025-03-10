@foreach ($products as $product)
<tr data-id="{{ $product->id }}">
                <td>{{ $product->id }}</td>
                <td>
                    <img src="{{ asset('images/' . $product->img_path) }}" alt="{{ $product->product_name }}" style="width: 100px; height: auto;">
                </td>
                <td>{{ $product->product_name }}</td>
                <td style="text-align:right">{{ $product->price }}円</td>
                <td style="text-align:right">{{ $product->stock }}</td>
                <td>{{ $product->company->company_name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('products.show', $product->id) }}">詳細</a>
                    <form class="delete-form" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-button" data-id="{{ $product->id }}">削除</button>
                    </form>
                </td>
            </tr>
@endforeach
