<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($product->name) ? $product->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('inventory_min') ? 'has-error' : ''}}">
    <label for="inventory_min" class="control-label">{{ 'Inventory Min' }}</label>
    <input class="form-control" name="inventory_min" type="number" id="inventory_min" value="{{ isset($product->inventory_min) ? $product->inventory_min : ''}}" >
    {!! $errors->first('inventory_min', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('inventory_max') ? 'has-error' : ''}}">
    <label for="inventory_max" class="control-label">{{ 'Inventory Max' }}</label>
    <input class="form-control" name="inventory_max" type="number" id="inventory_max" value="{{ isset($product->inventory_max) ? $product->inventory_max : ''}}" >
    {!! $errors->first('inventory_max', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
