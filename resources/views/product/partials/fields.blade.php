@csrf
        <div class="form-group">
            <label for="name">Product</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $model->name) }}">
        </div>

        <div class="form-group">
            <label for="stock_quantity">Quantity</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $model->stock_quantity) }}">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="unit">Units</label>
            <select name="unit_id" id="unit" class="form-control">
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ old('unit') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->abbreviation }}
                    </option>
                @endforeach
            </select>
        </div>

<div class="form-group">
    <input type="submit" class="btn btn-default" value="submit">
</div>

