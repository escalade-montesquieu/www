<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;
use Image;
use ImageOptimizer;
use Illuminate\Support\Facades\File;

class Photo extends Model
{
    protected $table = 'photos';

	protected $fillable = [
		'slug',
		'gallery',
		'gallery_name',
		'background',
		'src',
		'name',
		'date',
		'text',
		'exposed',
	];

	public $image_resize = 1024;
	public $preview_resize = 300;


	public function scopeExposed($query) {
		return $query->where('exposed', 1);
	}
	public function getGalleryObjAttribute() {
		return gallery::firstWhere('slug', $this->gallery);
	}

	public function getPreviewAttribute() {
		return '/preview'.$this->src;
	}

	public function deleteImage() {
		$imageName = explode('?v=', $this->src)[0];
		File::delete(public_path().$imageName);
	}

	public function saveOptimizedImage($imgFromRequest) {
        $imageName = $this->slug.'.'.$imgFromRequest->getClientOriginalExtension();
		$imageDestinationPath = public_path('img');
		$previewDestinationPath = public_path('preview/img');

		$img = Image::make($imgFromRequest->getRealPath());
		$img->resize($this->image_resize, $this->image_resize, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		})->save($imageDestinationPath.'/'.$imageName);

		// make a preview
		$img->resize($this->preview_resize, $this->preview_resize, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		})->save($previewDestinationPath.'/'.$imageName);

		$this->src = '/img/'.$imageName.'?v='.time();
	}


}
