<div class="form-group {{ $errors->has('dia') ? 'has-error' : ''}}">
    <label for="dia" class="control-label">{{ 'Dia' }}</label>
    <input class="form-control" name="dia" type="date" id="dia" value="{{ isset($diario->dia) ? $diario->dia : date('Y-m-d')}}" >
    {!! $errors->first('dia', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('texto') ? 'has-error' : ''}}">
    <label for="texto" class="control-label">{{ 'Texto' }}</label>
    <textarea class="form-control" rows="5" name="texto" type="textarea" id="texto" >{{ isset($diario->texto) ? $diario->texto : ''}}</textarea>
    {!! $errors->first('texto', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
