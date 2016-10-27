<?php
	/* Create thumbnail */
	function make_thumb($src,$dest,$desired_width) {
		/* read the source image */
		$source_image = imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		// calculating the part of the image to use for thumbnail
		if ($width > $height) {
		  $y = 0;
		  $x = ($width - $height) / 2;
		  $smallestSide = $height;
		} else {
		  $x = 0;
		  $y = ($height - $width) / 2;
		  $smallestSide = $width;
		}
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height*($desired_width/$width));	
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width,$desired_width);
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image,$source_image,0,0,$x,$y,$desired_width,$desired_width,$smallestSide,$smallestSide);
		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image,$dest, 80);
	}

	/* Return gallery directories */
	function get_dirs($galleries_dir) {
		$index = 0;
		$dirs = array();
		foreach(glob($galleries_dir."*", GLOB_ONLYDIR) as $dir) {
	    	$dir = str_replace($galleries_dir, '', $dir);
	    	array_push($dirs, $dir);
		}

		return $dirs;
	}

	/* Return files from directory */
	function get_pics($dir, $exts = array("jpg", "jpeg")) {
		$files = array();

		if($handle = opendir($dir)) {
			while(false !== ($file = readdir($handle))) {
				$ext = strtolower(get_extension($file));
				if($ext && in_array($ext, $exts)) {
				$files[] = $file;
				}
			}
			closedir($handle);
		}
		return $files;
	}
	

	/* Return file extension name */
	function get_extension($file) {
		return substr(strrchr($file,'.'),1);
	}
?>