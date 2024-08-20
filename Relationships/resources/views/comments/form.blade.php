<div class="form-group {{ $errors->has('post_id') ? 'has-error' : ''}}">
    <label for="post_id" class="control-label">{{ 'Post' }}</label>
    <select name="post_id" class="form-control" id="post_id" >
		@foreach ($posts as $key => $post)
	<option value="{{ $post->id }}" {{ (isset($comment->post_id) && $comment->post_id == $post->id) ? 'selected' : ''}}>{{ $post->name }}</option>
		@endforeach
	</select>
    
    {!! $errors->first('post_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    <label for="comment" class="control-label">{{ 'Comment' }}</label>
    <textarea class="form-control" rows="5" name="comment" type="textarea" id="comment" >{{ isset($comment->comment) ? $comment->comment : ''}}</textarea>
    {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
