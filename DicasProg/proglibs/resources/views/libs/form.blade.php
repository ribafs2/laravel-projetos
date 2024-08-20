<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($lib->title) ? $lib->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    <label for="subject" class="control-label">{{ 'Subject' }}</label>
    <select name="subject" class="form-control" id="subject" >
    @foreach (json_decode('{"": "Select","laravel": "Laravel", "cakephp": "CakePHP", "joomla": "Joomla", "wp": "Wordpress", "php": "PHP", "frontend": "Front-end", "mysql": "MySQL", "devops": "DevOps", "linux": "Linux", "outro": "Outro"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($lib->subject) && $lib->subject == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea" id="content" >{{ isset($lib->content) ? $lib->content : ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
