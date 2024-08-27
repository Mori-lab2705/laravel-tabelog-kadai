<div class="container">
    <form action="{{ route('shops.index') }}" method="GET">
        <div class="form-group">
            <label for="category"></label>
            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                <option value="">カテゴリーを選択</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>