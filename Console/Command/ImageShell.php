<?php
class ImageShell extends Shell {

//////////////////////////////////////////////////

	public $uses = array('Video');

//////////////////////////////////////////////////

	private function image_type_to_extension($imagetype) {
		if(empty($imagetype)) {
			return false;
		}
		switch($imagetype) {
			case IMAGETYPE_GIF      : return 'gif';
			case IMAGETYPE_JPEG     : return 'jpg';
			case IMAGETYPE_PNG      : return 'png';
			case IMAGETYPE_SWF      : return 'swf';
			case IMAGETYPE_PSD      : return 'psd';
			case IMAGETYPE_BMP      : return 'bmp';
			case IMAGETYPE_TIFF_II  : return 'tiff';
			case IMAGETYPE_TIFF_MM  : return 'tiff';
			case IMAGETYPE_JPC      : return 'jpc';
			case IMAGETYPE_JP2      : return 'jp2';
			case IMAGETYPE_JPX      : return 'jpf';
			case IMAGETYPE_JB2      : return 'jb2';
			case IMAGETYPE_SWC      : return 'swc';
			case IMAGETYPE_IFF      : return 'aiff';
			case IMAGETYPE_WBMP     : return 'wbmp';
			case IMAGETYPE_XBM      : return 'xbm';
			default                 : return false;
		}
	}

//////////////////////////////////////////////////

	public function resample($src, $dst, $width = '', $height = '', $square = false) {

		if(is_file($dst)) {
			// return;
			unlink($dst);
		}

		list($oldWidth, $oldHeight, $type) = getimagesize($src);
	    $ext = $this->image_type_to_extension($type);
		

		$size = getimagesize($src);
		if (!$size[0] || !$size[1]) {
			return;
		}

		$scale = min($width / $size[0], $height / $size[1]);

		// echo $scale;

		if ($scale == 1) {
			// return;
		}

		$newwidth = (int) ($size[0] * $scale);
		$newheight = (int) ($size[1] * $scale);

		if($square) {
			$xpos = (int) (($width - $newwidth) / 2);
			$ypos = (int) (($height - $newheight) / 2);
		} else {
			$width = $newwidth;
			$height = $newheight;
			$xpos = 0;
			$ypos = 0;
		}

		$destImg = ImageCreateTrueColor($width, $height);
		$backColor=ImageColorAllocate($destImg, 255, 255, 255);
		ImageFilledRectangle($destImg, 0, 0, $width, $height, $backColor);
		
		
		// $sourceImg = ImageCreateFromJPEG ($src);
		
		switch($ext) {
	      case 'gif' :
	        $sourceImg = imagecreatefromgif($src);
	        break;
	      case 'png' :
	        $sourceImg = imagecreatefrompng($src);
	        break;
	      case 'jpg' :
	      case 'jpeg' :
	        $sourceImg = imagecreatefromjpeg($src);
	        break;
	      default :
	        return false;
	        break;
	    }
		
		ImageCopyResampled($destImg, $sourceImg, $xpos, $ypos, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
		imagejpeg($destImg, $dst, 75);

		$data['width'] = $width;
		$data['height'] = $height;

		return $data;
	}

//////////////////////////////////////////////////

	public function main() {
		$videos = $this->Video->find('all', array(
			'fields' => array(
				'Video.id',
				'Video.vid',
				'Video.slug',
			),
			'limit' => 100000,
		));
		$i = 0;
		foreach($videos as $video)  {
			$image = $video['Video']['slug'] . '.jpg';
			if(!file_exists(WWW_ROOT . '/images/' . $image)) {
				$imageurl = 'http://i.ytimg.com/vi/' . $video['Video']['vid'] . '/hqdefault.jpg';
				$l = file_get_contents($imageurl);
				$lp  = fopen(WWW_ROOT . '/images-full/' . $image, 'w+');
				fputs($lp, $l);
				fclose($lp);
				unset($l);
				$localimage = $this->resample(WWW_ROOT . '/images-full/' . $image, WWW_ROOT . '/images/' . $image, 150, 120, 1);
				@unlink(WWW_ROOT . '/images-full/' . $image);
				$i++;
				$this->out($i . ' - ' . $image);
			}
		}
	}

//////////////////////////////////////////////////

}
