@csrf
        <div class="form-group">
            <label for="name">Category</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $model->name) }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('name', $model->name) }}">
        </div>


<div class="form-group">
    <input type="submit" class="btn btn-default" value="submit">
</div>