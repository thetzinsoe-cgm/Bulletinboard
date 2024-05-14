<div class="form-group">
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Post Title"
        value="{{ isset($post) ? $post->title : old('title') }}">
    @error('title')
        <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="8"
        placeholder="Post Description">{{ isset($post) ? $post->description : old('description') }}</textarea>
    @error('description')
        <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flag" id="exampleRadios1" value="true"
            <?php if (isset($post) && $post->flag == true) {
                echo 'checked';
            } ?>>
        <label class="form-check-label" for="exampleRadios1">
            Public
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flag" id="exampleRadios2" value="false"
            <?php if (isset($post) && $post->flag == false) {
                echo 'checked';
            } ?>>
        <label class="form-check-label" for="exampleRadios2">
            Private
        </label>
    </div>
    @error('flag')
        <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
