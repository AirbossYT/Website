<div class="row">
	<div class="col-xs-12">

		<div class="form-group">
			<label for="youtube">
				Youtube
				<i class="fa fa-question-circle" data-toggle="tooltip" title="No embed code needed, just paste the link to your youtube movie."></i>
			</label>

			<input id="youtube" class="form-control" name="youtube" type="text" placeholder="Youtube"
			       value="{{ Request::old('youtube') }}">
		</div>

		<div class="form-group">
			<label for="name">Thumbnail</label>

			<div class="row">
				<div class="col-md-4">
					<div class="thumbnail text-center">
						<span>Original thumbnail of asset</span>
						<img src="data:image/png;base64,{{ base64_encode($resource->getImage()->getRaw()) }}" width="100%"/>
					</div>
				</div>
				<div class="col-md-4">

					<div class="alert alert-info">
						By default, the image on the left will be used as thumbnail for your asset. But
						wouldn't it
						be
						better if you could provide a screenshot? <b>This image will also be included in
							your album.</b>
					</div>
					PNG or JPEG, max 5MB
					<input id="preview-image" name="image" type="file" accept="image/png,image/jpeg">

					<div class="checkbox">
						<input id="reset-image" name="reset-preview" type="checkbox"
						       @if(Request::old('reset-preview', 'off') == 'on') checked @endif>
						<label for="reset-image">
							Reset the
							thumbnail to the original asset's one.
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="name">Album</label>

			<div class="row">
				<div class="col-md-4">
					<label>
						Add image,
						PNG or JPEG, max 5MB
						<input id="album-image" name="album[]" type="file" multiple
						       accept="image/png,image/jpeg">
					</label>
				</div>
				<div class="col-md-8">
					<div class="alert alert-info">
						You can use album images to show the awesomeness of your ride/park even further.
						Maximum of 8
						images are allowed. <b>You can select multiple files with shift and control (or
							command on
							OSX)</b>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
