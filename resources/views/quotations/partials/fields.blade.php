@csrf
        <div class="form-group">
            <label for="name">Quotations</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $model->name) }}">
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $model->quantity) }}">
        </div>

        
        </div>

<div class="form-group">
    <input type="submit" class="btn btn-default" value="submit">
</div>

