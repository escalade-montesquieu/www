<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use Illuminate\Support\Facades\File;

class Gallery extends Model
{
    protected $table = 'gallery';

	protected $fillable = [
		'name',
		'slug',
		'preview',
		'text'
	];

	public $preview_resize = 300;

	public function deletePreview() {
		$imageName = explode('?v=', $this->preview)[0];
		File::delete(public_path().$imageName);
	}

	public function saveOptimizedPreview($imgFromRequest) {
		$imageName = $this->slug.'.'.$imgFromRequest->getClientOriginalExtension();
		$destinationPath = public_path('preview');

		$img = Image::make($imgFromRequest->getRealPath());
		$img->resize($this->preview_resize, $this->preview_resize, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		})->save($destinationPath.'/'.$imageName);

		$this->preview = '/preview/'.$imageName.'?v='.time();
	}
}
